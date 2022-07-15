
const momet = require('moment');

class CashProcess {
    

    constructor(app) {
        this.app = app;
        let self = this;
        this.init(self);
    }

    init(self) {
    }
    trading(){
        setInterval(this.calculateProcess, 1000, this);
    }
    async calculateProcess(self){
        var dt = new Date();
        const result = self.app.schedule_list.filter(schedule => schedule.is_use == 1 && new Date(dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+("0" + dt.getDate()).slice(-2)+" "+schedule.calculate_time) - new Date() < 20000 );
        result.forEach(async(value, index) =>{
            //if(value.calculate_time)
            var start_time = dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+("0" + dt.getDate()).slice(-2)+" "+value.start_time;
            var end_time = dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+("0" + dt.getDate()).slice(-2)+" "+value.end_time;

            var sql = "select * from coin_trade_list where is_del=0 and created_at > '"+ start_time +"' and created_at < '" + end_time +"'";
            var trade_list = await self.exeQuery(sql);
            trade_list.forEach(async (value, index)=>{
                var query = `UPDATE users SET money = money+${value.payout_amount}, profit_sum=profit_sum+${value.add_amount} WHERE id = ${packet.user_id};`;
                await this.exeQuery(query);
                var query = `UPDATE coin_trade_list SET state=1 WHERE id = ${value.id};`;
                await this.exeQuery(query);
            })
        });
        
    }
    async buyCoin(ws, strValue){
        console.log(strValue);
        var packet = JSON.parse(strValue);

        var sql =  `SELECT * from users left join user_level on users.level=user_level.level where users.id = ${packet.user_id} and password = '${packet.user_password}' LIMIT 1`;
        console.log(sql);
        let user_info = await this.exeQuery(sql);
        console.log(user_info)
        if(user_info.length == 0){
            ws.send("회원정보가 정확치 않습니다.");
        }

        if(user_info[0].money < packet.order_amount){
            ws.send("보유머니가 충분하지 않습니다.");
            return;
        }

        
        if(this.app.coin_list){
            this.app.coin_list.forEach((value, index)=>{
                console.log('work');
                if(value.key == packet.coin_type && value.use == 0){
                    ws.send("구매불가능한 코인입니다.");
                    return false;
                }
            })
            //return;
        }
        
        this.app.scrap_data.forEach(async (value, index, self) => {
            if(value.ne == packet.coin_type){
                var coin_quantity = parseFloat(packet.order_amount / value.c11).toFixed(6);
                var query = `UPDATE users SET money = money-${packet.order_amount}, buy_sum=buy_sum+${packet.order_amount} WHERE id = ${packet.user_id};`;
                await this.exeQuery(query);
                
                var add_amount = Math.floor(packet.order_amount * user_info[0].pay_percent / 100);
                var payout_amount = packet.order_amount + add_amount;
                query = `INSERT INTO coin_trade_list (user_id, coin_type, cur_price, coin_quantity, order_amount, payout_rate, add_amount, payout_amount) 
                    VALUES (${packet.user_id}, '${packet.coin_type}', ${value.c11}, ${coin_quantity}, ${packet.order_amount}, ${user_info[0].pay_percent}, ${add_amount}, ${payout_amount});`;
                await this.exeQuery(query);
                return false;
            }
        });
    }

    exeQuery(query) {
        let sql = query;
        return new Promise((resolve, reject) => {
            this.app.db.query(sql, (err, result) => {
            if (err) {
              reject(err);
            }
            else {
              resolve(result);
            }
          });
        });
    }
}

module.exports = CashProcess;