var myApp = angular.module("myApp", []);
myApp.controller("myController", function($scope, $http) {
    scope = $scope;
    http = $http;

    scope.alertError = alertError;
    scope.alertInfo = alertInfo;
    scope.alertWarning = alertWarning;
    scope.alertSuccess = alertSuccess;

    scope.toastError = toastError;
    scope.toastInfo = toastInfo;
    scope.toastWarning = toastWarning;
    scope.toastSuccess = toastSuccess;

    scope.numberFormat = numberFormat;

    scope.alarm_state="";
    // Page
    scope.nLimitPage = 5;
    scope.nCurPage = 1;
    scope.nPageSize = 50;
    scope.lstPage = [];
    for(var i =0; i < scope.nLimitPage; i++) {
        scope.lstPage[i] = i + 1;
    }
    scope.nPageFrame = 0;
    scope.onSelectPage = onSelectPage;
    scope.onSelectNextPage = onSelectNextPage;
    scope.onSelectPrevPage = onSelectPrevPage;
    scope.onSelectCustomPage = onSelectCustomPage;

    scope.websocket = null;
    scope.ConnectSocket = ConnectSocket;
    scope.SendPacket = SendPacket;
    scope.SendAuthPacket = SendAuthPacket;
    scope.RecvPacket = RecvPacket;

    scope.initialize = initialize;

    if(document.getElementById("id_strAddress") != null)
        scope.ConnectSocket();
    else
        scope.initialize();

    //login users
    scope.login_ids="";
    //alarm0
    scope.alarm_f_0 = false;
    scope.alarm_0 = new Audio('/alram/user_exchange.mp3');
    scope.alarm_0.addEventListener('ended', function() {
        this.currentTime = 0;
        setTimeout(() => {
            if(scope.alarm_f_0 == true)
               scope.alarm_0.play();
        }, 2000);
    }, false);
    //alarm1
    scope.alarm_f_1 = false;
    scope.alarm_1 = new Audio('/alram/user_exchange.mp3');
    scope.alarm_1.addEventListener('ended', function() {
        this.currentTime = 0;
        setTimeout(() => {
            if(scope.alarm_f_1 == true)
               scope.alarm_1.play();
        }, 2000);
    }, false);
    //alarm2
    scope.alarm_f_2 = false;
    scope.alarm_2 = new Audio('/alram/user_exchange.mp3');
    scope.alarm_2.addEventListener('ended', function() {
        this.currentTime = 0;
        setTimeout(() => {
            if(scope.alarm_f_2 == true)
               scope.alarm_2.play();
        }, 2000);
    }, false);
    //alarm3
    scope.alarm_f_3 = false;
    scope.alarm_3 = new Audio('/alram/user_exchange.mp3');
    scope.alarm_3.addEventListener('ended', function() {
        this.currentTime = 0;
        setTimeout(() => {
            if(scope.alarm_f_3 == true)
               scope.alarm_3.play();
        }, 2000);
    }, false);
    //alarm4
    scope.alarm_f_4 = false;
    scope.alarm_4 = new Audio('/alram/user_exchange.mp3');
    scope.alarm_4.addEventListener('ended', function() {
        this.currentTime = 0;
        setTimeout(() => {
            if(scope.alarm_f_4 == true)
               scope.alarm_4.play();
        }, 2000);
    }, false);
    //alarm5
    scope.alarm_f_5 = false;
    scope.alarm_5 = new Audio('/alram/user_exchange.mp3');
    scope.alarm_5.addEventListener('ended', function() {
        this.currentTime = 0;
        setTimeout(() => {
            if(scope.alarm_f_5 == true)
               scope.alarm_5.play();
        }, 2000);
    }, false);
    //alarm6
    scope.alarm_f_6 = false;
    scope.alarm_6 = new Audio('/alram/user_exchange.mp3');
    scope.alarm_6.addEventListener('ended', function() {
        this.currentTime = 0;
        setTimeout(() => {
            if(scope.alarm_f_6 == true)
               scope.alarm_6.play();
        }, 2000);
    }, false);
});

function ConnectSocket()
{
    var strAddress = document.getElementById("id_strAddress").value;
    scope.websocket = new WebSocket(strAddress);
    scope.websocket.onopen = () => {
        scope.SendAuthPacket();
        scope.initialize();
    }

    scope.websocket.onerror = (error) => {
        console.log(`Connect error: ${error}`);
    }
    scope.websocket.onclose = (e) => {
        setTimeout(function() {
            ConnectSocket();
        }, 1000);
    }
    scope.websocket.onmessage = (e) => {
        scope.$apply(scope.RecvPacket(e.data));
    }
}

function SendPacket(nCmd, strPacket)
{
    var packet = {
        "m_nCmd"      : nCmd,
        "strValue"  : strPacket
    }

    scope.websocket.send(JSON.stringify(packet));
}

function SendAuthPacket()
{
    if(document.getElementById("id_main") != null)
    {
        if(document.getElementById("admin_id") != null)
        {
            var user_id = document.getElementById("admin_id").value;
            scope.SendPacket(PKT_ADMIN_ACT_MAIN_AUTH, JSON.stringify({user_id}));
        }
        // else if(document.getElementById("id_agentSn") != null)
        // {
        //     var agentSn = document.getElementById("id_agentSn").value;
        //     scope.SendPacket(PKT_AGENT_ACT_MAIN_AUTH, agentSn);
        // }
    }
    else
    {
        if(document.getElementById("admin_id") != null)
        {
            var user_id = document.getElementById("admin_id").value;
            scope.SendPacket(PKT_ADMIN_ACT_CHILD_AUTH, JSON.stringify({user_id}));
        }
        // else if(document.getElementById("id_agentSn") != null)
        // {
        //     var agentSn = document.getElementById("id_agentSn").value;
        //     scope.SendPacket(PKT_AGENT_ACT_CHILD_AUTH, agentSn);
        // }
    }
}


function RecvPacket(strPacket)
{
    var packet = JSON.parse(strPacket);
    var m_nCmd = parseInt(packet.m_nCmd);

    switch(m_nCmd)
    {
        // case PKT_ADMIN_REV_SERVER_TIME:
        //     scope.strServerTime = packet.strValue;
        //     break;

        case PKT_ADMIN_LOGIN_USERS:
            var data = JSON.parse(packet.m_strPacket);
            RecvAdminLoginUsers(data);
            break;

        case PKT_ADMIN_ACT_MAIN_AUTH:
            RecvAdminMainAuth(data);
            break;

        default:
            RecvDataPacket(packet);
            break;
    }
}

function RecvAdminMainAuth(packet)
{
    if(packet.nRet == RET_ERROR)
    {
        window.location = "/admin/onLogout";
    }
}

function RecvAdminLoginUsers(packet)
{
    scope.login_ids="";
    var cnt_bronz = 0, cnt_silver = 0, cnt_gold = 0, cnt_vip = 0;
    for (const key in packet) {
        scope.login_ids += key+'|';
        if (packet[key].user_level == 1) {
            cnt_bronz ++;            
        }else if(packet[key].user_level == 2) {
            cnt_silver ++;            
        }else if(packet[key].user_level == 3) {
            cnt_gold ++;            
        }else if(packet[key].user_level == 4) {
            cnt_vip ++;            
        }
    }
    scope.login_ids = scope.login_ids.slice(0, -1);
    $('.level_1').val(cnt_bronz+"명");
    $('.level_2').val(cnt_silver+"명");
    $('.level_3').val(cnt_gold+"명");
    $('.level_4').val(cnt_vip+"명");
}

function RecvDataPacket(packet)
{
    //재정의되는 함수
}

function alertError(strMsg)
{
    $('#id_msg_error').html(strMsg);
    $("#id_alert_error").click();
}

function alertInfo(strMsg)
{
    $('#id_msg_info').html(strMsg);
    $("#id_alert_info").click();
}

function alertWarning(strMsg)
{
    $('#id_msg_warning').html(strMsg);
    $("#id_alert_warning").click();
}

function alertSuccess(strMsg)
{
    $('#id_msg_success').html(strMsg);
    $("#id_alert_success").click();
}

function toastError(strMsg)
{
    toastr.error(strMsg)
}

function toastInfo(strMsg)
{
    toastr.info(strMsg)
}

function toastWarning(strMsg)
{
    toastr.warning(strMsg)
}

function toastSuccess(strMsg)
{
    toastr.success(strMsg)
}

// Number Format
function numberFormat(val) {
    var num = numeral(val).format('0,0');
    return num;
}

function onSelectPage(nPage) {
    scope.nCurPage = scope.nPageFrame * scope.nLimitPage + nPage + 1;
}

function onSelectNextPage() {
    if ((scope.nPageFrame + 1) * scope.nLimitPage >= scope.nPage) {
        return;
    }
    scope.nPageFrame++;
    scope.nCurPage = scope.nPageFrame * scope.nLimitPage + 1;
    for (var i = 0; i < scope.nLimitPage; i++) {
        scope.lstPage[i] = scope.nPageFrame * scope.nLimitPage + i + 1;
    }
}

function onSelectPrevPage() {
    if (scope.nPageFrame == 0 || scope.nPageFrame == undefined) {
        return;
    }
    scope.nCurPage = scope.nPageFrame * scope.nLimitPage;
    scope.nPageFrame--;
    for (var i = 0; i < scope.nLimitPage; i++) {
        scope.lstPage[i] = scope.nPageFrame * scope.nLimitPage + i + 1;
    }
}

function changeTimezone(date) {
    var localTIme = (new Date(date).getTime()) / 1000;
    var localOffset = new Date().getTimezoneOffset() * 60;
    var utc = localTIme + localOffset;
    utc = localTIme + localOffset + 9 * 3600;
    date = moment.unix(utc).format('YYYY/MM/DD');

    return date;
}

function dateDiff(date, diff) {
    var diffset = diff * 24 * 3600;
    var strampTime = new Date(date).getTime() / 1000;
    strampTime = strampTime + diffset;
    var date = moment.unix(strampTime).format('YYYY/MM/DD');

    return date;
}

function initialize()
{

}

function onSelectCustomPage()
{

}

// //$('body').on('click', '.fa-bell', function () {
//     function alarm_state(id){
    
//     if($(this).hasClass('fa')){
//         $(this).removeClass('fa')
//         $(this).addClass('far')
//     }else{
//         $(this).removeClass('far')
//         $(this).addClass('fa')
//     }
//     var userId = document.getElementById("admin_id").value;;
//     var action = '/admin/user/alarm_state/' + userId;
    
//     // $.ajax({
//     //     url: action,
//     //     data: {id},
//     //     type: "POST",
//     //     dataType: 'json',
//     //     success: function ({status, data}) {
//     //         if(status == "success"){
//     //           $(this).class  
                
//     //         }else{
                
//     //         }
//     //     },
//     //     error: function (data) {
//     //     }
//     // });
// }

function goto_login_users() {
    if(scope.login_ids == ""){
        location.href ='/admin/user/login_list/0';
    }else{
        location.href ='/admin/user/login_list/' + scope.login_ids;
    }
    
}