const constants = require('../constants');
class CoinProcess {
    constructor(app) {
        this.app = app;
        let self = this;
        this.init(self);
    }

    init(self) {
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

    async depositMoney(ws, strValue){
        console.log(strValue);
        var packet = JSON.parse(strValue);

        var sql =  `SELECT * from users where id = ${packet.user_id} and password = '${packet.user_password}' LIMIT 1`;
        console.log(sql);
        let user_info = await this.exeQuery(sql);
        console.log(user_info)
        if(user_info.length == 0){
            var m_nCmd = constants.PKT_USER_DEPOSIT_MONEY;
            var packet = {
                "status"           :   1,
                "error_code"       :   1001,
                "message"          :   "회원정보가 정확치 않습니다."
            }
            ws.send(JSON.stringify({m_nCmd, strValue: JSON.stringify(packet)}));
        }

        sql = `INSERT INTO exchange_list (user_id, amount, type) 
            VALUES (${packet.user_id}, '${packet.amount}', 0);`;
        await this.exeQuery(sql);
        
        // var query = `UPDATE users SET money = money-${packet.order_amount} WHERE id = ${packet.user_id};`;
        // await this.exeQuery(query);

        var m_nCmd = constants.PKT_USER_DEPOSIT_MONEY;
        var packet = {
            "status"           :   1,
            "error_code"       :   0,
            "message"          :   "입금신청이 완료되였습니다."
        }
        ws.send(JSON.stringify({m_nCmd, m_strPacket: JSON.stringify(packet)}));
    }

    async withdrawMoney(ws, strValue){
        var packet = JSON.parse(strValue);

        var sql =  `SELECT * from users where id = ${packet.user_id} and password = '${packet.user_password}' LIMIT 1`;
        console.log(sql);
        let user_info = await this.exeQuery(sql);
        console.log(user_info)
        if(user_info.length == 0){
            console.log("회원정보가 정확치 않습니다.");
            ws.send("회원정보가 정확치 않습니다.");
            return;
        }

        if(user_info[0].money < packet.amount){
            console.log("보유머니가 충분하지 않습니다.");
            ws.send("보유머니가 충분하지 않습니다.");
            return;
        }

        sql = `INSERT INTO exchange_list (user_id, amount, type) 
            VALUES (${packet.user_id}, '${packet.amount}', 1);`;
        await this.exeQuery(sql);
        
        var query = `UPDATE users SET money = money-${packet.amount} WHERE id = ${packet.user_id};`;
        await this.exeQuery(query);
        console.log("환전신청이 완료되였습니다.");
        var m_nCmd = constants.PKT_USER_WITHDRAW_MONEY;
        var packet = {
            "status"           :   1,
            "error_code"       :   0,
            "message"          :   "환전신청이 완료되였습니다."
        }
        ws.send(JSON.stringify({m_nCmd, m_strPacket: JSON.stringify(packet)}));
    }

    //admin
    async admWithdrawConfirm(ws, strValue){
        var packet = JSON.parse(strValue);

        var sql =  `SELECT * from users where id = ${packet.user_id} and password = '${packet.user_password}' LIMIT 1`;
        console.log(sql);
        let user_info = await this.exeQuery(sql);
        console.log(user_info)
        if(user_info.length == 0){
            console.log("회원정보가 정확치 않습니다.");
            ws.send("회원정보가 정확치 않습니다.");
            return;
        }

        sql =  `SELECT * from exchange_list where id = ${packet.id} LIMIT 1`;
        console.log(sql);
        let exchange_info = await this.exeQuery(sql);

        var query = `UPDATE exchange_list SET state = 1, accepted_date = now() WHERE id = ${packet.id};`;
        await this.exeQuery(query);
        
        query = `UPDATE users SET withdraw_sum=withdraw_sum+${exchange_info[0].amount} WHERE id = ${exchange_info[0].user_id};`;
        console.log(query)
        await this.exeQuery(query);

        console.log("환전신청이 승인되였습니다.");
        //관리자에 전송
        var m_nCmd = constants.PKT_ADMIN_DEPOSIT_CONFIRM;
        var packet = {
            "status"           :   1,
            "error_code"       :   0,
            "message"          :   "환전신청이 승인되였습니다."
        }
        ws.send(JSON.stringify({m_nCmd: constants.PKT_ADMIN_WITHDRAW_CONFIRM, m_strPacket:JSON.stringify(packet)}));
        //유저에게 알림
        this.app.socketServer.sendMessageByUserId(exchange_info[0].user_id, JSON.stringify({m_nCmd: constants.PKT_USER_WITHDRAW_CONFIRM, m_strPacket:JSON.stringify(packet)}));

    }

    //admin
    async admWithdrawCancel(ws, strValue){
        var packet = JSON.parse(strValue);

        var sql =  `SELECT * from users where id = ${packet.user_id} and password = '${packet.user_password}' LIMIT 1`;
        console.log(sql);
        let user_info = await this.exeQuery(sql);
        console.log(user_info)
        if(user_info.length == 0){
            console.log("회원정보가 정확치 않습니다.");
            ws.send("회원정보가 정확치 않습니다.");
            return;
        }

        sql =  `SELECT * from exchange_list where id = ${packet.id} LIMIT 1`;
        console.log(sql);
        let exchange_info = await this.exeQuery(sql);

        var query = `UPDATE exchange_list SET state = 2, accepted_date = now() WHERE id = ${packet.id};`;
        await this.exeQuery(query);

        var query = `UPDATE users SET money = money+${exchange_info[0].amount} WHERE id = ${packet.user_id};`;
        await this.exeQuery(query);

        //관리자에 전송
        var m_nCmd = constants.PKT_ADMIN_WITHDRAW_CANCEL;
        var packet = {
            "status"           :   1,
            "error_code"       :   0,
            "message"          :   "환전신청이 취소되였습니다."
        }

        ws.send(JSON.stringify({m_nCmd: constants.PKT_ADMIN_WITHDRAW_CANCEL, m_strPacket:JSON.stringify(packet)}));
        //유저에게 전송
        this.app.socketServer.sendMessageByUserId(exchange_info[0].user_id, JSON.stringify({m_nCmd: constants.PKT_USER_WITHDRAW_CANCEL, m_strPacket:JSON.stringify(packet)}));
    }
    //admin
    async admDepositConfirm(ws, strValue){
        var packet = JSON.parse(strValue);

        var sql =  `SELECT * from users where id = ${packet.user_id} and password = '${packet.user_password}' LIMIT 1`;
        
        let user_info = await this.exeQuery(sql);
        console.log(user_info)
        if(user_info.length == 0){
            console.log("회원정보가 정확치 않습니다.");
            ws.send("회원정보가 정확치 않습니다.");
            return;
        }

        sql =  `SELECT * from exchange_list where id = ${packet.id} LIMIT 1`;
        
        let exchange_info = await this.exeQuery(sql);

        var query = `UPDATE exchange_list SET state = 1, accepted_date = now() WHERE id = ${packet.id};`;
        await this.exeQuery(query);

        query = `UPDATE users SET money = money+${exchange_info[0].amount}, deposit_sum=deposit_sum+${exchange_info[0].amount} WHERE id = ${exchange_info[0].user_id};`;
        console.log(query)
        await this.exeQuery(query);
        console.log("입금신청이 승인되였습니다.");
        //ws.send("입금신청이 승인되였습니다.");
        //관리자에 전송
        var m_nCmd = constants.PKT_ADMIN_DEPOSIT_CONFIRM;
        var packet = {
            "status"           :   1,
            "error_code"       :   0,
            "message"          :   "입금신청이 승인되였습니다."
        }
        ws.send(JSON.stringify({m_nCmd, strValue: JSON.stringify(packet)}));
        //유저에게 알림
        this.app.socketServer.sendMessageByUserId(exchange_info[0].user_id, JSON.stringify({m_nCmd: constants.PKT_USER_DEPOSIT_CONFIRM, m_strPacket:JSON.stringify(packet)}));
    }
    //admin
    async admDepositCancel(ws, strValue){
        var packet = JSON.parse(strValue);
        var sql =  `SELECT * from users where id = ${packet.user_id} and password = '${packet.user_password}' LIMIT 1`;
        let user_info = await this.exeQuery(sql);
        console.log(user_info)
        if(user_info.length == 0){
            console.log("회원정보가 정확치 않습니다.");
            ws.send("회원정보가 정확치 않습니다.");
            return;
        }

        sql =  `SELECT * from exchange_list where id = ${packet.id} LIMIT 1`;
        console.log(sql);
        let exchange_info = await this.exeQuery(sql);

        var query = `UPDATE exchange_list SET state = 2, accepted_date = now() WHERE id = ${packet.id};`;
        await this.exeQuery(query);

        // var query = `UPDATE users SET money = money+${packet.amount} WHERE id = ${packet.user_id};`;
        // await this.exeQuery(query);
        
        
        //관리자에 전송
        var m_nCmd = constants.PKT_ADMIN_DEPOSIT_CANCEL;
        var packet = {
            "status"           :   1,
            "error_code"       :   0,
            "message"          :   "입금신청이 취소되였습니다."
        }
        ws.send(JSON.stringify({m_nCmd, strValue: JSON.stringify(packet)}));
        //유저에게 알림
        this.app.socketServer.sendMessageByUserId(exchange_info[0].user_id, JSON.stringify({m_nCmd: constants.PKT_USER_DEPOSIT_CANCEL, m_strPacket:JSON.stringify(packet)}));
    }
}

module.exports = CoinProcess;
