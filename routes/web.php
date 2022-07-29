<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(!Auth::check())
        return redirect('login');
    else if( Auth::check() && Auth::user()->isAdmin() == 1)
        return view('admin.user.list');
    else
        return redirect('/home');
});
// Route::group(['middleware' => ['guest']], function () {
//     Route::get('/', function () {
//         if()
//             return redirect('login');
//     });
// });
//Route::get('/',                                     [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
Route::get('/resizeImage',                          [App\Http\Controllers\ImageController::class, 'resizeImage']);
Route::post('/resizeImagePost',                     [App\Http\Controllers\ImageController::class, 'resizeImagePost'])->name('resizeImagePost');
Route::post('/uploadImage',                         [App\Http\Controllers\ImageController::class, 'uploadImage'])->name('uploadImage');
Route::post('/uploadImages',                        [App\Http\Controllers\ImageController::class, 'uploadImages'])->name('uploadImages');
Route::post('/deleteImage',                         [App\Http\Controllers\ImageController::class, 'deleteImage'])->name('deleteImage');
Route::get('/bank_info',                            [App\Http\Controllers\User\UtilController::class, 'bank_info'])->name('bank_info');
Route::get('/referer_check',                        [App\Http\Controllers\User\UtilController::class, 'referer_check'])->name('referer_check');

Route::middleware('user')->name('user.')->group(
    function () {
        Route::get('/home',                         [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');
        /////////////////////////////** 입출금관리 **//////////////////////////////////
        Route::get('/deposit',                      [App\Http\Controllers\User\CashController::class, 'deposit'])->name('deposit');
        Route::get('/deposit_history',              [App\Http\Controllers\User\CashController::class, 'deposit_history'])->name('deposit_history');
        Route::get('/withdraw',                     [App\Http\Controllers\User\CashController::class, 'withdraw'])->name('withdraw');
        Route::get('/withdraw_history',             [App\Http\Controllers\User\CashController::class, 'withdraw_history'])->name('withdraw_history');
        Route::get('/exchange_history',             [App\Http\Controllers\User\CashController::class, 'exchange_history'])->name('exchange_history');
        Route::get('/trading_history',              [App\Http\Controllers\User\CashController::class, 'trading_history'])->name('trading_history');
        Route::get('/result_history',               [App\Http\Controllers\User\CashController::class, 'result_history'])->name('result_history');
        
        /////////////////////////////** 가이드 **//////////////////////////////////
        Route::get('/guide',                        [App\Http\Controllers\User\UserController::class, 'guide'])->name('guide');
        Route::get('/mypage',                       [App\Http\Controllers\User\UserController::class, 'mypage'])->name('mypage');
        Route::post('/check_password',              [App\Http\Controllers\User\UserController::class, 'check_password'])->name('check_password');
        Route::post('/change_password',             [App\Http\Controllers\User\UserController::class, 'change_password'])->name('change_password');
        Route::post('/change_info',                 [App\Http\Controllers\User\UserController::class, 'change_info'])->name('change_info');
        //실시간 회원정보
        Route::get('/user_info',                    [App\Http\Controllers\User\UserController::class, 'user_info'])->name('user_info');

        /////////////////////////////** 고객관리 **//////////////////////////////////
        //공지사항
        Route::get('/notice',                       [App\Http\Controllers\User\NoticeController::class, 'index'])->name('notice');
        Route::get('/notice/{id}',                  [App\Http\Controllers\User\NoticeController::class, 'show'])->name('notice.edit');
        Route::post('/notice/{id}',                 [App\Http\Controllers\User\NoticeController::class, 'save'])->name('notice.save');
        Route::delete('/notice/{id}',               [App\Http\Controllers\User\NoticeController::class, 'delete'])->name('notice.delete');
        //1대1문의
        Route::get('/qna',                          [App\Http\Controllers\User\QNAController::class, 'index'])->name('qna');
        Route::get('/qna/{id}',                     [App\Http\Controllers\User\QNAController::class, 'show'])->name('qna.edit');
        Route::post('/qna/{id}',                    [App\Http\Controllers\User\QNAController::class, 'save'])->name('qna.save');
        Route::delete('/qna/{id}',                  [App\Http\Controllers\User\QNAController::class, 'delete'])->name('qna.delete');
        //자주하는 질문
        Route::get('/faq',                          [App\Http\Controllers\User\FAQController::class, 'index'])->name('faq');
        Route::get('/faq/{id}',                     [App\Http\Controllers\User\FAQController::class, 'show'])->name('faq.edit');
        Route::post('/faq/{id}',                    [App\Http\Controllers\User\FAQController::class, 'save'])->name('faq.save');
        Route::delete('/faq/{id}',                  [App\Http\Controllers\User\FAQController::class, 'delete'])->name('faq.delete');
        //자주하는 질문
        Route::get('/message',                      [App\Http\Controllers\User\MessageController::class, 'index'])->name('message');
        Route::get('/message/{id}',                 [App\Http\Controllers\User\MessageController::class, 'show'])->name('message.edit');
        Route::post('/message/{id}',                [App\Http\Controllers\User\MessageController::class, 'save'])->name('message.save');
        Route::put('/message/{id}',                 [App\Http\Controllers\User\MessageController::class, 'read'])->name('message.read');
        Route::delete('/message/{id}',              [App\Http\Controllers\User\MessageController::class, 'delete'])->name('message.delete');
    }
);
Auth::routes();




Route::middleware('admin')->prefix('admin')->name('admin.')->group(
    function () {
        Route::get('/home',                         [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
        Route::get('/realtime_info',                [App\Http\Controllers\Admin\HomeController::class, 'realtime_info'])->name('realtime_info');
        Route::get('/home_admin',                   [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
        Route::get('user/roleManage',               [App\Http\Controllers\Admin\User\RoleManageController::class, 'index'])->name('user.RoleManage');
        //신규회원관리
        Route::get('user/new_list',                 [App\Http\Controllers\Admin\User\NewUserController::class, 'index'])->name('user.new_list');
        Route::post('user/new_state/{userId}',      [App\Http\Controllers\Admin\User\NewUserController::class, 'state'])->name('user.new_state');
        //레벨업회원관리
        Route::get('user/levelup_list',             [App\Http\Controllers\Admin\User\LevelupController::class, 'index'])->name('user.levelup_list');
        Route::post('user/levelup/{userId}',        [App\Http\Controllers\Admin\User\LevelupController::class, 'levelup'])->name('user.levelup');
        //로그인회원
        Route::get('user/login_list/{ids}',               [App\Http\Controllers\Admin\User\LoginUserController::class, 'index'])->name('user.login_list');

        //사용자관리
        Route::get('user/list',                     [App\Http\Controllers\Admin\User\UserController::class, 'index'])->name('user.list');
        Route::get('user/edit/{userId}',            [App\Http\Controllers\Admin\User\UserController::class, 'edit'])->name('user.edit');
        Route::post('user/edit/{userId}',           [App\Http\Controllers\Admin\User\UserController::class, 'save'])->name('user.save');
        Route::delete('user/edit/{userId}',         [App\Http\Controllers\Admin\User\UserController::class, 'delete'])->name('user.delete');
        Route::post('user/state/{userId}',          [App\Http\Controllers\Admin\User\UserController::class, 'state'])->name('user.state');
        Route::post('user/check',                   [App\Http\Controllers\Admin\User\UserController::class, 'check'])->name('user.check');
        //등급관리
        Route::get('user/level_list',               [App\Http\Controllers\Admin\User\LevelController::class, 'index'])->name('user.level_list');
        Route::get('user/level_edit/{levelId}',     [App\Http\Controllers\Admin\User\LevelController::class, 'edit'])->name('user.level_edit');
        Route::post('user/level_edit/{levelId}',    [App\Http\Controllers\Admin\User\LevelController::class, 'save'])->name('user.level_save');
        Route::delete('user/level_edit/{levelId}',  [App\Http\Controllers\Admin\User\LevelController::class, 'delete'])->name('user.level_delete');
        Route::post('user/level_state/{levelId}',   [App\Http\Controllers\Admin\User\LevelController::class, 'state'])->name('user.level_state');
        Route::post('user/level_buy_state/{levelId}',[App\Http\Controllers\Admin\User\LevelController::class, 'buy_state'])->name('user.level_buy_state');
        //유저별 입출금
        Route::get('cash/user_cash/{type}/{user_d}',[App\Http\Controllers\Admin\Cash\CashController::class, 'user_index'])->name('cash.user_cash_list');
        //입출금
        Route::get('cash/cash/{type}',              [App\Http\Controllers\Admin\Cash\CashController::class, 'index'])->name('cash.cash_list');
        Route::get('cash/cash/{type}/{id}',         [App\Http\Controllers\Admin\Cash\CashController::class, 'show'])->name('cash.cash_edit');
        Route::post('cash/cash/{type}/{id}',        [App\Http\Controllers\Admin\Cash\CashController::class, 'save'])->name('cash.cash_save');
        Route::delete('cash/cash/{type}/{id}',      [App\Http\Controllers\Admin\Cash\CashController::class, 'delete'])->name('cash.cash_delete');
        Route::post('cash/cash_state/{type}/{id}',  [App\Http\Controllers\Admin\Cash\CashController::class, 'state'])->name('cash.cash_state');
        //코인관리
        Route::get('coin/list',                     [App\Http\Controllers\Admin\Coin\CoinController::class, 'index'])->name('coin.list');
        Route::post('coin/state/{id}',              [App\Http\Controllers\Admin\Coin\CoinController::class, 'state'])->name('coin.state');
        Route::get('coin/edit/{coinId}',            [App\Http\Controllers\Admin\Coin\CoinController::class, 'edit'])->name('coin.edit');
        Route::post('coin/edit/{coinId}',           [App\Http\Controllers\Admin\Coin\CoinController::class, 'save'])->name('coin.save');
        //정산관리
        //정산일정
        Route::get('calculate/schedule',            [App\Http\Controllers\Admin\Calculate\ScheduleController::class, 'index'])->name('calculate.schedule_list');
        Route::get('calculate/schedule_edit/{id}',  [App\Http\Controllers\Admin\Calculate\ScheduleController::class, 'edit'])->name('calculate.schedule_edit');
        Route::post('calculate/schedule_edit/{id}', [App\Http\Controllers\Admin\Calculate\ScheduleController::class, 'save'])->name('calculate.schedule_save');
        Route::delete('calculate/schedule_edit/{id}',[App\Http\Controllers\Admin\Calculate\ScheduleController::class, 'delete'])->name('calculate.schedule_delete');
        Route::post('calculate/schedule_state/{id}',[App\Http\Controllers\Admin\Calculate\ScheduleController::class, 'state'])->name('calculate.schedule_state');
        //회원별구매내역
        Route::get('calculate/user_trading/{userId}',[App\Http\Controllers\Admin\Calculate\TradingController::class, 'user_index'])->name('calculate.user_trading_list');
        //구매내역
        Route::get('calculate/trading',             [App\Http\Controllers\Admin\Calculate\TradingController::class, 'index'])->name('calculate.trading_list');
        Route::get('calculate/trading_edit/{id}',   [App\Http\Controllers\Admin\Calculate\TradingController::class, 'edit'])->name('calculate.trading_edit');
        Route::post('calculate/trading_edit/{id}',  [App\Http\Controllers\Admin\Calculate\TradingController::class, 'save'])->name('calculate.trading_save');
        Route::delete('calculate/trading_edit/{id}',[App\Http\Controllers\Admin\Calculate\TradingController::class, 'delete'])->name('calculate.trading_delete');
        Route::post('calculate/trading_state/{id}', [App\Http\Controllers\Admin\Calculate\TradingController::class, 'state'])->name('calculate.trading_state');
        //배당금지급내역
        Route::get('calculate/user_result/{userId}',[App\Http\Controllers\Admin\Calculate\ResultController::class, 'user_index'])->name('calculate.user_result_list');
        //배당금지급내역
        Route::get('calculate/result',              [App\Http\Controllers\Admin\Calculate\ResultController::class, 'index'])->name('calculate.result_list');
        Route::get('calculate/result_edit/{id}',    [App\Http\Controllers\Admin\Calculate\ResultController::class, 'edit'])->name('calculate.result_edit');
        Route::post('calculate/result_edit/{id}',   [App\Http\Controllers\Admin\Calculate\ResultController::class, 'save'])->name('calculate.result_save');
        Route::delete('calculate/result_edit/{id}', [App\Http\Controllers\Admin\Calculate\ResultController::class, 'delete'])->name('calculate.result_delete');
        Route::post('calculate/result_state/{id}',  [App\Http\Controllers\Admin\Calculate\ResultController::class, 'state'])->name('calculate.result_state');

        //1대1문의

        Route::get('contact/qna',                   [App\Http\Controllers\Admin\Contact\QNAController::class, 'index'])->name('qna.list');
        Route::get('contact/acc_qna',               [App\Http\Controllers\Admin\Contact\QNAController::class, 'acc_index'])->name('qna.acc_list');
        Route::get('contact/qna/{id}',              [App\Http\Controllers\Admin\Contact\QNAController::class, 'show'])->name('qna.edit');
        Route::post('contact/qna/{id}',             [App\Http\Controllers\Admin\Contact\QNAController::class, 'save'])->name('qna.save');
        Route::delete('contact/qna/{id}',           [App\Http\Controllers\Admin\Contact\QNAController::class, 'delete'])->name('qna.delete');
        //공지
        Route::get('contact/notice',                [App\Http\Controllers\Admin\Contact\NoticeController::class, 'index'])->name('notice.list');
        Route::get('contact/notice/{id}',           [App\Http\Controllers\Admin\Contact\NoticeController::class, 'show'])->name('notice.edit');
        Route::post('contact/notice/{id}',          [App\Http\Controllers\Admin\Contact\NoticeController::class, 'save'])->name('notice.save');
        Route::delete('contact/notice/{id}',        [App\Http\Controllers\Admin\Contact\NoticeController::class, 'delete'])->name('notice.delete');
        //쪽지
        Route::get('contact/msg',                   [App\Http\Controllers\Admin\Contact\MSGController::class, 'index'])->name('msg.list');
        Route::get('contact/msg/{id}',              [App\Http\Controllers\Admin\Contact\MSGController::class, 'show'])->name('msg.edit');
        Route::post('contact/msg/{id}',             [App\Http\Controllers\Admin\Contact\MSGController::class, 'save'])->name('msg.save');
        Route::delete('contact/msg/{id}',           [App\Http\Controllers\Admin\Contact\MSGController::class, 'delete'])->name('msg.delete');
        //자주묻는 질문
        Route::get('contact/faq',                   [App\Http\Controllers\Admin\Contact\FAQController::class, 'index'])->name('faq.list');
        Route::get('contact/faq/{id}',              [App\Http\Controllers\Admin\Contact\FAQController::class, 'show'])->name('faq.edit');
        Route::post('contact/faq/{id}',             [App\Http\Controllers\Admin\Contact\FAQController::class, 'save'])->name('faq.save');
        Route::delete('contact/faq/{id}',           [App\Http\Controllers\Admin\Contact\FAQController::class, 'delete'])->name('faq.delete');

        //가이드
        Route::get('setting/guide',                 [App\Http\Controllers\Admin\Setting\SettingController::class, 'guide'])->name('setting.guide');
        Route::post('setting/guide',                [App\Http\Controllers\Admin\Setting\SettingController::class, 'saveGuide'])->name('setting.guide');
        //가이드
        Route::get('setting/bank',                 [App\Http\Controllers\Admin\Setting\SettingController::class, 'bank'])->name('setting.bank');
        Route::post('setting/bank',                [App\Http\Controllers\Admin\Setting\SettingController::class, 'saveBank'])->name('setting.bank');
    }
);
