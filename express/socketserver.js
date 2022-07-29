const WebSocketServer = require('ws');
const constants = require('./constants');

class SocketServer {
    constructor(app) {
        this.app = app;
        this.WebSocketServer = require('ws');
        this.wss = new WebSocketServer.Server({ port: 8080 });
        this.clients = {};
        this.active_users = [];
        let self = this;
        this.initSocketServer(self);
    }

    initSocketServer(self) {
        
        self.wss.on("connection", (ws, req) => {
            var socket_id = req.headers['sec-websocket-key'];
            var user_id = 0;
            var type = 0;//user:0, admin:1
            var page_type = 0;//main:0, sub:1
            self.clients[socket_id] = {user_id, type, page_type, ws};
            // sending message
            console.log("new client connected");
            ws.on('message', function(message) {
                console.log('Received: ' + message);
                self.Process(ws, socket_id, JSON.parse(message));
              });
            ws.on("close", () => {
                console.log("the client has disconnected");
                delete self.clients[req.headers['sec-websocket-key']];
            });
            ws.onerror = function () {
                console.log("Some Error occurred")
                delete self.clients[req.headers['sec-websocket-key']];
            }
            //ws.send('You successfully connected to the websocket.');
        });
        
        self.wss.broadcast = function broadcast(msg) {
          //console.log(msg);
            self.wss.clients.forEach(function each(client) {
              client.send(msg);
           });
        };

        self.wss.broadcastToAdmin = function broadcastToAdmin(msg) {
            for (const property in self.clients) {
                if(self.clients[property].type == 1)
                    self.clients[property].send(msg);
            }
        };
        self.wss.broadcastToUserMainPage = function broadcastToUser(msg) {
            
            for (const property in self.clients) {
                if(self.clients[property].type == 0 && self.clients[property].page_type == 0)
                    self.clients[property].ws.send(msg);
            }
        };

        setInterval(() => self.wss.broadcastToUserMainPage(JSON.stringify({m_strPacket : self.app.scrap_data, m_nCmd : constants.PKT_USER_COIN_DATA})), 500);
    }

    sendMessageByKey(key, message){
        this.clients[key].ws.send(message);
    }

    sendMessageByUserId(user_id, message){
        console.log(this.clients);
        for (const key in this.clients) {
            if (this.clients[key].user_id == user_id){
                this.clients[key].ws.send(message);
                console.log('sendMessageByUserId')
                console.log(user_id);
            }
        }
    }

    sendLoggedInUserInfo(data){
        
        for (const key in this.active_users) {
            if (data.user_id != 0 && this.active_users[key].user_id != data.user_id){
                
            }
        }
    }

    Process(ws, socket_id, packet){
        
        if(packet.m_nCmd == constants.PKT_ADMIN_ACT_MAIN_AUTH)
        {
            var data = JSON.parse(packet.strValue);
            for (const property in this.clients) {
                if(property == socket_id && this.clients[property].user_id == 0){
                    this.clients[property].user_id = data.user_id;
                    this.clients[property].type = 1;
                    
                }
            }
        }else if(packet.m_nCmd == constants.PKT_ADMIN_ACT_CHILD_AUTH)
        {
            var data = JSON.parse(packet.strValue);
            for (const property in this.clients) {
                if(property == socket_id && this.clients[property].user_id == 0){
                    this.clients[property].user_id = data.user_id;
                    this.clients[property].type = 1;
                    this.clients[property].page_type = 1;
                }
            }
        }else if(packet.m_nCmd == constants.PKT_ADMIN_WITHDRAW_CONFIRM){
            this.app.cashProcess.admWithdrawConfirm(ws, packet.strValue);
        }else if(packet.m_nCmd == constants.PKT_ADMIN_WITHDRAW_CHECK){
            this.app.cashProcess.admWithdrawCheck(ws, packet.strValue);
        }else if(packet.m_nCmd == constants.PKT_ADMIN_WITHDRAW_CANCEL){
            this.app.cashProcess.admWithdrawCancel(ws, packet.strValue);
        }else if(packet.m_nCmd == constants.PKT_ADMIN_DEPOSIT_CONFIRM){
            this.app.cashProcess.admDepositConfirm(ws, packet.strValue);
        }else if(packet.m_nCmd == constants.PKT_ADMIN_DEPOSIT_CHECK){
            this.app.cashProcess.admDepositCheck(ws, packet.strValue);
        }else if(packet.m_nCmd == constants.PKT_ADMIN_DEPOSIT_CANCEL){
            this.app.cashProcess.admDepositCancel(ws, packet.strValue);
        }else if(packet.m_nCmd == constants.PKT_ADMIN_CHANGE_COIN_STATE){
            this.app.coinProcess.changeCoinInfo(ws, packet.strValue);
        }
        ///User
        else if(packet.m_nCmd == constants.PKT_USER_ACT_MAIN_AUTH){
            var data = JSON.parse(packet.strValue);
            for (const property in this.clients) {
                if(property == socket_id && this.clients[property].user_id == 0){
                    this.clients[property].user_id = data.user_id;
                    this.sendLoggedInUserInfo(data);
                    break;
                }
            }
        }
        else if(packet.m_nCmd == constants.PKT_USER_ACT_SUB_AUTH){
            var data = JSON.parse(packet.strValue);
            for (const property in this.clients) {
                if(property == socket_id && this.clients[property].user_id == 0){
                    this.clients[property].user_id = data.user_id;
                    this.clients[property].page_type = 1;
                    this.sendLoggedInUserInfo(data);
                    break;
                }
            }
        }
        else if(packet.m_nCmd == constants.PKT_USER_COIN_BUY)
        {
            //ws.send('코인구매시작')
            this.app.coinProcess.buyCoin(ws, packet.strValue);
        }
        else if(packet.m_nCmd == constants.PKT_USER_COIN_RESULT)
        {
            //ws.send('배당금지급시작')
            this.app.coinProcess.Coin(ws, packet.strValue);
        }
        else if(packet.m_nCmd == constants.PKT_USER_DEPOSIT_MONEY)
        {
            //ws.send('입금처리시작')
            this.app.cashProcess.depositMoney(ws, packet.strValue);
        }
        else if(packet.m_nCmd == constants.PKT_USER_WITHDRAW_MONEY)
        {
            //ws.send('입금처리시작')
            this.app.cashProcess.withdrawMoney(ws, packet.strValue);
        }
        
    }
    
}

module.exports = SocketServer;
