const moment = require('moment');

class Scrapper {
    constructor(app) {
        this.app = app;
        this.puppeteer = require('puppeteer');
        this.scrapData();
    }

    scrapData() {
        const sleep = (milliseconds) => {
            const date = Date.now();
            let currentDate = null;
            do {
                currentDate = Date.now();
            } while (currentDate - date < milliseconds);
        };
        

        (async () => {
        const browser = await this.puppeteer.launch();
        const page = await browser.newPage();

        await page.goto('https://kimpga.com/',{
            waitUntil: 'load',            
            timeout: 0
        });

        var scrap_cnt = 0;

        while (true){
            try{
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

                //console.log(moment().format('YYYY-MM-DD hh:mm:ss'));

                var data = await page.$$eval('#__next > div.max-w-screen-lg > div > div.mt-4.mb-8 > div:nth-child(7) > div > table > tbody > tr', rows => {
                    return Array.from(rows, row => {
                        const columns = row.querySelectorAll('td');
                        var scrap_data = {};
                        //코인정보
                        scrap_data.nk = columns[0].querySelector('div > div').textContent;
                        scrap_data.ne = columns[0].querySelector('div > div:nth-child(2)').textContent;
                        scrap_data.ic = columns[0].querySelector('div > div:nth-child(1) > img').src;
                        scrap_data.ic = scrap_data.ic.match(/.*\/(.*)$/)[1];
                        //현재가
                        var cur_price = columns[1].innerText.trim();
                        var arr_cur_price = cur_price.split('\n');
                        scrap_data.c1 = arr_cur_price[0];
                        scrap_data.c11 = scrap_data.c1.replaceAll(',', '');
                        scrap_data.c2 = arr_cur_price.length > 1 ? arr_cur_price[1] : "";
                        scrap_data.c21 = scrap_data.c2.replaceAll(',', '');
                        //마켓가
                        scrap_data.kp = columns[2].querySelector('div:nth-child(1)').textContent;
                        scrap_data.kp1 = scrap_data.kp.replace('%', '');
                        scrap_data.ka = columns[2].querySelector('div:nth-child(2)').textContent;
                        scrap_data.ka1 = scrap_data.ka.replaceAll(',', '');
                        //전일대비
                        var yesterday_info = columns[3].innerText.trim().replace('%', '');
                        var arr_yesterday_info = yesterday_info.split('\n');
                        scrap_data.yp = arr_yesterday_info[0];
                        scrap_data.ya = arr_yesterday_info[1];
                        scrap_data.ya1 = scrap_data.ya.replaceAll(',', '');
                        // //최대가
                        // var highest_info = columns[4].innerText.trim();
                        // var arr_highest_info = highest_info.split('%');
                        // scrap_data.hp = arr_highest_info[0];
                        // scrap_data.ha = arr_highest_info[1];
                        // scrap_data.ha1 = scrap_data.ha.replaceAll(',', '');
                        // //최저가
                        // var lowest_info = columns[5].innerText.trim();
                        // var arr_lowest_info = lowest_info.split('%');
                        // scrap_data.lp = arr_lowest_info[0];
                        // scrap_data.la = arr_lowest_info[1];
                        // scrap_data.la1 = scrap_data.la.replaceAll(',', '');
                        // //판매액
                        // var trade_info = columns[6].innerText.trim();
                        // var arr_trade_info = trade_info.split('\n');
                        // scrap_data.t1 = arr_trade_info[0];
                        // scrap_data.t11 = scrap_data.t1.replaceAll(',', '').replace('조 ', '').replace('억', '00000000');
                        // scrap_data.t2 = arr_trade_info.length > 1 ? arr_trade_info[1] : "";
                        // scrap_data.t21 = scrap_data.t2.replaceAll(',', '').replace('조 ', '').replace('억', '00000000');
                        //if(scrap_data.ne == "WEMIX")
                        return scrap_data;
                    });
                });
                var filtered = data.filter(function (el) {
                    return el != null;
                });
                // console.log(filtered);
                //로딩중에는 빈자료가 넣지 않는다
                if(data.length > 0) {
                    this.app.scrap_data = filtered;
                    
                }

                sleep(250);
            }catch{
                console.log('scrapping error');
            }
        }
        browser.close();
        })();
    }

    
}

module.exports = Scrapper;
