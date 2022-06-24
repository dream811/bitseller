
const delay = ms => new Promise(res => setTimeout(res, ms));
const puppeteer = require('puppeteer');
// const axios = require("axios");
// const cheerio = require("cheerio");
// const pretty = require("pretty");

    var coin_data;
    (async () => {
        const browser = await puppeteer.launch();
        const page = await browser.newPage();
    
        await page.goto('https://kimpga.com/');
        await delay(5000);
    
        while (true){
            coin_data = await page.$$eval('#__next > div.max-w-screen-lg > div > div.mt-4.mb-8 > div:nth-child(7) > div > table > tbody > tr', rows => {
                return Array.from(rows, row => {
                const columns = row.querySelectorAll('td');
                var scrap_data = {};
                scrap_data.name_kor = columns[0].querySelector('div > div').textContent;
                scrap_data.name_eng = columns[0].querySelector('div > div:nth-child(2)').textContent;
                scrap_data.img_coin = columns[0].querySelector('div > div:nth-child(1) > img').src;
                
                var cur_price = columns[1].innerText.trim();
                var arr_cur_price = cur_price.split('\n');
                scrap_data.cur_price1 = arr_cur_price[0];
                scrap_data.cur_price1_1 = scrap_data.cur_price1.replace(',', '');
                scrap_data.cur_price2 = arr_cur_price.length > 1 ? arr_cur_price[1] : "";
                scrap_data.cur_price2_1 = scrap_data.cur_price2.replace(',', '');
        
                scrap_data.kimp_per = columns[2].querySelector('div:nth-child(1)').textContent;
                scrap_data.kimp_per_1 = scrap_data.kimp_per.replace('%', '');
                scrap_data.kimp_amt = columns[2].querySelector('div:nth-child(2)').textContent;
                scrap_data.kimp_amt_1 = scrap_data.kimp_amt.replace(',', '');
        
                var yesterday_info = columns[3].innerText.trim().replace('%', '');
                var arr_yesterday_info = yesterday_info.split('\n');
                scrap_data.comp_yesterday_per = arr_yesterday_info[0];
                scrap_data.comp_yesterday_amt = arr_yesterday_info[1];
                scrap_data.comp_yesterday_amt_1 = scrap_data.comp_yesterday_amt.replace(',', '');
        
                var highest_info = columns[4].innerText.trim();
                var arr_highest_info = highest_info.split('%');
                scrap_data.comp_highest_per = arr_highest_info[0];
                scrap_data.comp_highest_amt = arr_highest_info[1];
                scrap_data.comp_highest_amt_1 = scrap_data.comp_highest_amt.replace(',', '');
        
                var lowest_info = columns[5].innerText.trim();
                var arr_lowest_info = lowest_info.split('%');
                scrap_data.comp_lowest_per = arr_lowest_info[0];
                scrap_data.comp_lowest_amt = arr_lowest_info[1];
                scrap_data.comp_lowest_amt_1 = scrap_data.comp_lowest_amt.replace(',', '');
        
                var trade_info = columns[6].innerText.trim();
                var arr_trade_info = trade_info.split('\n');
                scrap_data.trade_amt1 = arr_trade_info[0];
                scrap_data.trade_amt1_1 = scrap_data.trade_amt1.replace(',', '').replace('조 ', '').replace('억', '00000000');
                scrap_data.trade_amt2 = arr_trade_info.length > 1 ? arr_trade_info[1] : "";
                scrap_data.trade_amt2_1 = scrap_data.trade_amt2.replace(',', '').replace('조 ', '').replace('억', '00000000');
                //if(scrap_data.name_eng == "WEMIX")
                
                    return scrap_data;
                });
            });
        }
        browser.close();
    })();

    module.exports = coin_data;
