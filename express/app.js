const mysql = require('mysql');


const Scrapper = require('./scrapper');
const db_config = require('./db_config');
const SocketServer = require('./socketserver');
const CoinProcess = require('./process/coinprocess');
const CashProcess = require('./process/cashprocess');
// const SportsAction = require('./action/sportsAction');


// const Calculation = require('./calculation');


class App {
    constructor() {
      	process.env.TZ = "Asia/Seoul";
        console.log('create app');

        this.db = null;
        let self = this;
        
        //디비 접속
        this.handleDisconnect(self);
        
        //웹소켓
        this.socketServer = new SocketServer(self);
        //스크레핑
        this.coin_list = {};
        this.schedule_list = null;
        this.scrap_data = null;
        
        //트레이딩
        this.coinProcess = new CoinProcess(self);
        //캐쉬관리
        this.cashProcess = new CashProcess(self);
        //디비로딩
        this.loadDB(self);

        this.scrapper = new Scrapper(self);
    }

    async loadDB(self) {
        var db_data = await this.coinProcess.exeQuery('select * from coin_list ');
        db_data.forEach((value) =>{
          self.coin_list[value.key] = {id:value.id, name:value.name, key:value.key, sell_limit:value.sell_limit, is_use:value.is_use};
        });

        self.schedule_list = await this.coinProcess.exeQuery('select * from trading_schedule');
        /**
         * 배렬 조합
         */
        let arr1 = [
            { id: "abdc4051", date: "2017-01-24" },
            { id: "abdc4052", date: "2017-01-22" },
            { id: "abdc4053", date: "2017-01-23" }
        ];
        
        let arr2 = [
            { id: "abdc4051", name: "ab" },
            { id: "abdc4052", name: "abc" }
        ];
        
        let arr3 = arr1.map((item, i) => Object.assign({}, item, arr2[i]));
        
        console.log(arr3);
        //디비 다 로드한후 스케쥴러 시동
        this.coinProcess.trading();
    }

    process(self) {
        console.log("start process");

    }

    handleDisconnect(self) {
        self.db = mysql.createConnection(db_config); // Recreate the connection, since
                                                        // the old one cannot be reused.
      
        self.db.connect(function(err) {              // The server is either down
          if(err) {                                     // or restarting (takes a while sometimes).
            console.log('error when connecting to db:', err);
            setTimeout(self.handleDisconnect(self), 2000, self); // We introduce a delay before attempting to reconnect,
          }                                     // to avoid a hot loop, and to allow our node script to
        });                                     // process asynchronous requests in the meantime.
                                                // If you're also serving http, display a 503 error.
        self.db.on('error', function(err) {
          console.log('db error', err);
          if(err.code === 'PROTOCOL_CONNECTION_LOST') { // Connection to the MySQL server is usually
            self.handleDisconnect(self);                         // lost due to either server restart, or a
          } else if(err.code === 'ECONNRESET') { // Connection to the MySQL server is usually
            self.handleDisconnect(self);                         // lost due to either server restart, or a
          } else {                                      // connnection idle timeout (the wait_timeout
            throw err;                                  // server variable configures this)
          }
        });
    }
}

module.exports = App;
