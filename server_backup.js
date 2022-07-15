const express = require('express');
const mysql = require('mysql');
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'bitseller'
});
connection.connect((err) => {
  if(err) throw err;
  console.log('Connected to MySQL Server!');
});


//time
var moment = require('moment');

var constants = require('./express/constants');
const app = express();
/*****
 * 코인목록 로딩(사용가능 불가능, 구매제한 등)
 */

// /*************
//  * 유저정보 리스트 로딩
//  */

/*********
 * 스크레핑
 * *************** */
var coin_data;
const delay = ms => new Promise(res => setTimeout(res, ms));
const sleep = (milliseconds) => {
  const date = Date.now();
  let currentDate = null;
  do {
    currentDate = Date.now();
  } while (currentDate - date < milliseconds);
};
const puppeteer = require('puppeteer');

(async () => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();

  await page.goto('https://kimpga.com/',{
      waitUntil: 'load',
      // Remove the timeout
      timeout: 0
  });
  // await delay(10000);
  var scrap_cnt = 0;
  while (true){
    if(scrap_cnt > 120){
      
      await page.goto('https://kimpga.com/',{
        waitUntil: 'load',
        // Remove the timeout
        timeout: 0
      });
      scrap_cnt = 0
    }else{
      scrap_cnt++;
    }
    console.log(moment().format('YYYY-MM-DD hh:mm:ss'))
    var data = await page.$$eval('#__next > div.max-w-screen-lg > div > div.mt-4.mb-8 > div:nth-child(7) > div > table > tbody > tr', rows => {
      return Array.from(rows, row => {
        const columns = row.querySelectorAll('td');
        var scrap_data = {};
        scrap_data.name_kor = columns[0].querySelector('div > div').textContent;
        scrap_data.name_eng = columns[0].querySelector('div > div:nth-child(2)').textContent;
        scrap_data.img_coin = columns[0].querySelector('div > div:nth-child(1) > img').src;
        
        var cur_price = columns[1].innerText.trim();
        var arr_cur_price = cur_price.split('\n');
        scrap_data.cur_price1 = arr_cur_price[0];
        scrap_data.cur_price1_1 = scrap_data.cur_price1.replaceAll(',', '');
        scrap_data.cur_price2 = arr_cur_price.length > 1 ? arr_cur_price[1] : "";
        scrap_data.cur_price2_1 = scrap_data.cur_price2.replaceAll(',', '');

        scrap_data.kimp_per = columns[2].querySelector('div:nth-child(1)').textContent;
        scrap_data.kimp_per_1 = scrap_data.kimp_per.replace('%', '');
        scrap_data.kimp_amt = columns[2].querySelector('div:nth-child(2)').textContent;
        scrap_data.kimp_amt_1 = scrap_data.kimp_amt.replaceAll(',', '');

        var yesterday_info = columns[3].innerText.trim().replace('%', '');
        var arr_yesterday_info = yesterday_info.split('\n');
        scrap_data.comp_yesterday_per = arr_yesterday_info[0];
        scrap_data.comp_yesterday_amt = arr_yesterday_info[1];
        scrap_data.comp_yesterday_amt_1 = scrap_data.comp_yesterday_amt.replaceAll(',', '');

        var highest_info = columns[4].innerText.trim();
        var arr_highest_info = highest_info.split('%');
        scrap_data.comp_highest_per = arr_highest_info[0];
        scrap_data.comp_highest_amt = arr_highest_info[1];
        scrap_data.comp_highest_amt_1 = scrap_data.comp_highest_amt.replaceAll(',', '');

        var lowest_info = columns[5].innerText.trim();
        var arr_lowest_info = lowest_info.split('%');
        scrap_data.comp_lowest_per = arr_lowest_info[0];
        scrap_data.comp_lowest_amt = arr_lowest_info[1];
        scrap_data.comp_lowest_amt_1 = scrap_data.comp_lowest_amt.replaceAll(',', '');

        var trade_info = columns[6].innerText.trim();
        var arr_trade_info = trade_info.split('\n');
        scrap_data.trade_amt1 = arr_trade_info[0];
        scrap_data.trade_amt1_1 = scrap_data.trade_amt1.replaceAll(',', '').replace('조 ', '').replace('억', '00000000');
        scrap_data.trade_amt2 = arr_trade_info.length > 1 ? arr_trade_info[1] : "";
        scrap_data.trade_amt2_1 = scrap_data.trade_amt2.replaceAll(',', '').replace('조 ', '').replace('억', '00000000');
        //if(scrap_data.name_eng == "WEMIX")
          return scrap_data;
      });
    });
    //로딩중에는 빈자료가 넣지 않는다
    if(data.length > 0) coin_data = data;

    sleep(250);
  }
  browser.close();
})();

/********************
 * 웹소켓서버
 */
// Importing the required modules
const WebSocketServer = require('ws');
 
// Creating a new websocket server
const wss = new WebSocketServer.Server({ port: 8080 });
var clients = {};
// Creating connection using websocket
wss.on("connection", (ws, req) => {
    console.log("new client connected");
    var id = req.headers['sec-websocket-key'];
    var user_id = 0;
    clients[id] = {user_id,  ws};
    console.log(clients)
    // sending message
    ws.on('message', function(message) {
        //wss.broadcast(JSON.stringify(message));
        
        console.log('Received: ' + message);
        BetFunc(ws, JSON.parse(message));
        //console.log()
      });
    ws.on("close", () => {
        console.log("the client has connected");
        delete clients[req.headers['sec-websocket-key']];
    });
    ws.onerror = function () {
        console.log("Some Error occurred")
    }
    ws.send('You successfully connected to the websocket.');
});

wss.broadcast = function broadcast(msg) {
  //console.log(msg);
  wss.clients.forEach(function each(client) {
      client.send(msg);
   });
};

setInterval(() => wss.broadcast(JSON.stringify({m_strPacket : coin_data, m_nCmd : constants.PKT_USER_COIN_DATA})), 500);
console.log("The WebSocket server is running on port 8080");

function BetFunc (ws, message) {
  console.log(message);
  if(message.m_nCmd == constants.PKT_USER_ACT_MAIN_AUTH){
    clients.forEach((val, key)=>{
      if(val.user_id== 0)
        val.ws.send("제기랄");
    });
  }
  else if(message.m_nCmd == constants.PKT_USER_COIN_BUY)
  {
    BuyCoin(ws, message.strValue);
  }
  //ws.send('success');
  // var request = JSON.parse(message);
  // console.log(request.user_id)
  // console.log('betting!');
  // var sql = 'SELECT * from users where id = ? LIMIT 1'
  // connection.query(sql, request.user_id, (err, rows) => {
  //     if(err) throw err;
  //     console.log('The data from users table are: \n', rows);
  //     // connection.end();
  // });
}

function BuyCoin(ws, strValue){
  const req_info = JSON.parse(strValue);
  console.log(req_info.user_id)
  console.log('betting!');
  var sql = 'SELECT * from users where id = ? LIMIT 1'
  connection.query(sql, req_info.user_id, (err, rows, fields) => {
      ws.send(JSON.stringify(rows[0]));
      if(rows[0].money < req_info.order_amount){
        var packet = {
          m_nCmd              : '',
          strValue            : "주문금액이 보유머니를 초과할수 없습니다."          
        }
        ws.send(JSON.stringify(packet));
      }else{
        sql = "";
        connection.query(sql, req_info.user_id, (err, rows, fields) => {
            //ws.send(JSON.stringify(rows[0]));
        });
      }
      
  });
}