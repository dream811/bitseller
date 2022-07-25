
const momet = require('moment');
const constants = require('../constants');
class CashProcess {
    

    constructor(app) {
        this.app = app;
        let self = this;
        this.init(self);
    }

    init(self) {
    }
    trading(){
        setInterval(this.calculateProcess, 600000, this);
    }
    async calculateProcess(self){
        var dt = new Date();
        // const result = self.app.schedule_list.filter(schedule => schedule.is_use == 1 && Math.abs(new Date(dt.getFullYear()+"-"+(dt.getMonth()+1)+"-"+("0" + dt.getDate()).slice(-2)+" "+schedule.calculate_time) - new Date()) < 1200000 );
        var sql = "select * from trading_schedule where is_use=1 && is_del=0 and ABS(TIME(calculate_time) - TIME('"+ dt.toLocaleTimeString() +"')) > 1200000";
        console.log(sql);
        var result = await self.exeQuery(sql);
        result.forEach(async(value, index) =>{
            //if(value.calculate_time)
            var sql = "select * from coin_trade_list where state=0 && is_del=0 and TIME(created_at) > TIME('"+ value.start_time +"') and TIME(created_at) < TIME('" + value.end_time +"')";
            console.log(sql);
            var trade_list = await self.exeQuery(sql);
            trade_list.forEach(async (val, idx)=>{
                console.log(val.created_at)
                var query = `UPDATE users SET money = money+${val.payout_amount}, profit_sum=profit_sum+${val.add_amount} WHERE id = ${val.user_id};`;
                await self.exeQuery(query);
                var query = `UPDATE coin_trade_list SET state=1 WHERE id = ${val.id};`;
                await self.exeQuery(query);
            })
        });
        
    }
    async buyCoin(ws, strValue){
        var packet = JSON.parse(strValue);

        var sql =  `SELECT * from users left join user_level on users.level=user_level.level where users.id = ${packet.user_id} and password = '${packet.user_password}' LIMIT 1`;
        console.log(sql);
        let user_info = await this.exeQuery(sql);
        console.log(user_info)
        if(user_info.length == 0){
            var m_nCmd = constants.PKT_USER_COIN_BUY;
            var data = {
                "status"           :   0,
                "error_code"       :   1,
                "message"          :   "회원정보가 정확치 않습니다."
            }
            ws.send(JSON.stringify({m_nCmd, m_strPacket: JSON.stringify(data)}));
            return;
        }

        if(user_info[0].money < packet.order_amount){
            var m_nCmd = constants.PKT_USER_COIN_BUY;
            var data = {
                "status"           :   0,
                "error_code"       :   2,
                "message"          :   "보유머니가 충분하지 않습니다."
            }
            ws.send(JSON.stringify({m_nCmd, m_strPacket: JSON.stringify(data)}));
            return;
        }

        sql =  `SELECT * from coin_list`;
        console.log(sql);
        this.app.coin_list = await this.exeQuery(sql);
        var sell_limit = 0;
        if(this.app.coin_list){
            for (const value of this.app.coin_list) {
                if(value.key == packet.coin_type){
                    if(value.is_use == 0){
                        // ws.send("구매불가능한 코인입니다.");
                        var m_nCmd = constants.PKT_USER_COIN_BUY;
                        var data = {
                            "status"           :   0,
                            "error_code"       :   3,
                            "message"          :   "구매불가능한 코인입니다."
                        }
                        ws.send(JSON.stringify({m_nCmd, m_strPacket: JSON.stringify(data)}));
                        return false;
                    }else{
                        sell_limit = value.sell_limit;
                    }
                }
            }            
        }
       
        this.app.scrap_data.forEach(async (value, index, self) => {
            if(value.ne == packet.coin_type){
                if(sell_limit > value.kp1){
                    //코인구매제한 값보다 낮은 경우
                    var m_nCmd = constants.PKT_USER_COIN_BUY;
                    var data = {
                        "status"           :   0,
                        "error_code"       :   4,
                        "message"          :   "현재시가에서 코인구매가 불가능합니다."
                    }
                    ws.send(JSON.stringify({m_nCmd, m_strPacket: JSON.stringify(data)}));
                }else{
                    var coin_quantity = parseFloat(packet.order_amount / value.c11).toFixed(6);
                    var query = `UPDATE users SET money = money-${packet.order_amount}, buy_sum=buy_sum+${packet.order_amount} WHERE id = ${packet.user_id};`;
                    await this.exeQuery(query);
                    
                    var add_amount = Math.floor(packet.order_amount * user_info[0].pay_percent / 100);
                    var payout_amount = packet.order_amount + add_amount;
                    query = `INSERT INTO coin_trade_list (user_id, coin_type, cur_price, coin_quantity, order_amount, payout_rate, add_amount, payout_amount) 
                        VALUES (${packet.user_id}, '${packet.coin_type}', ${value.c11}, ${coin_quantity}, ${packet.order_amount}, ${user_info[0].pay_percent}, ${add_amount}, ${payout_amount});`;
                    await this.exeQuery(query);
                    //코인구매성공
                    var m_nCmd = constants.PKT_USER_COIN_BUY;
                    var data = {
                        "status"           :   1,
                        "error_code"       :   0,
                        "message"          :   "코인을 구매했습니다."
                    }
                    ws.send(JSON.stringify({m_nCmd, m_strPacket: JSON.stringify(data)}));

                    return false;
                }
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
