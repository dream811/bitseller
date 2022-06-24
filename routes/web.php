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

Route::get('/we', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');

Auth::routes();




Route::middleware('admin')->prefix('admin')->name('admin.')->group(
    function () {
        Route::get('/admin',                        [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
        Route::get('/home_admin',                   [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
        Route::get('user/roleManage',               [App\Http\Controllers\Admin\User\RoleManageController::class, 'index'])->name('user.RoleManage');
        //사용자관리
        Route::get('user/userManage',               [App\Http\Controllers\Admin\User\UserManageController::class, 'index'])->name('user.UserManage');
        Route::get('user/userManage/edit/{userId}', [App\Http\Controllers\Admin\User\UserManageController::class, 'edit'])->name('user.UserManage.Edit');
        Route::get('user/userManage/checkIDEmail',  [App\Http\Controllers\Admin\User\UserManageController::class, 'checkIDEmail'])->name('user.UserManage.CheckIDEmail');
        Route::post('user/userManage',              [App\Http\Controllers\Admin\User\UserManageController::class, 'save'])->name('user.UserManage.Save');
        Route::get('user/charge/{type}',            [App\Http\Controllers\Admin\User\ChargeManageController::class, 'index'])->name('user.charge');
        Route::get('user/charge/{type}/{id}',       [App\Http\Controllers\Admin\User\ChargeManageController::class, 'show'])->name('user.chargeEdit');
        Route::post('user/charge/{type}/{id}',      [App\Http\Controllers\Admin\User\ChargeManageController::class, 'save'])->name('user.chargeEdit');
        Route::delete('user/charge/{type}/{id}',    [App\Http\Controllers\Admin\User\ChargeManageController::class, 'delete'])->name('user.delete');
        //샵관리
        Route::get('shop/shopManage',               [App\Http\Controllers\Admin\Shop\ShopManageController::class, 'index'])->name('shop.ShopManage');
        Route::get('shop/shopManage/state/{id}',    [App\Http\Controllers\Admin\Shop\ShopManageController::class, 'state'])->name('shop.ShopManage.state');
        //상품관리
        //Route::get('user/depositManage', [App\Http\Controllers\Admin\User\DepositManageController::class, 'index'])->name('user.DepositManage');
        Route::get('product/productManage',         [App\Http\Controllers\Admin\Product\ProductManageController::class, 'index'])->name('product.ProductManage');
        Route::get('product/productManage/share',   [App\Http\Controllers\Admin\Product\ProductManageController::class, 'share'])->name('product.ProductManage.share');

        Route::get('product/category',              [App\Http\Controllers\Admin\Product\CategoryManageController::class, 'index'])->name('product.category.index');
        Route::get('product/category/{id}/{pid}',   [App\Http\Controllers\Admin\Product\CategoryManageController::class, 'show'])->name('product.category.show');
        Route::post('product/category/{id}/{pid}',  [App\Http\Controllers\Admin\Product\CategoryManageController::class, 'save'])->name('product.category.save');
        //1대1문의

        Route::get('contact/QNA',                   [App\Http\Controllers\Admin\Contact\QNAController::class, 'index'])->name('contact.QNA');
        Route::get('contact/QNA/{id}',              [App\Http\Controllers\Admin\Contact\QNAController::class, 'show'])->name('contact.QNAEdit');
        Route::post('contact/QNA/{id}',             [App\Http\Controllers\Admin\Contact\QNAController::class, 'save'])->name('contact.QNASave');
        Route::delete('contact/QNA/{id}',           [App\Http\Controllers\Admin\Contact\QNAController::class, 'delete'])->name('contact.QNADelete');
        //공지
        Route::get('contact/Notice',                [App\Http\Controllers\Admin\Contact\NoticeController::class, 'index'])->name('contact.Notice');
        Route::get('contact/Notice/{id}',           [App\Http\Controllers\Admin\Contact\NoticeController::class, 'show'])->name('contact.NoticeEdit');
        Route::post('contact/Notice/{id}',          [App\Http\Controllers\Admin\Contact\NoticeController::class, 'save'])->name('contact.NoticeSave');
        Route::delete('contact/Notice/{id}',        [App\Http\Controllers\Admin\Contact\NoticeController::class, 'delete'])->name('contact.NoticeDelete');
        //자주묻는 질문
        Route::get('contact/FAQ',                   [App\Http\Controllers\Admin\Contact\FAQController::class, 'index'])->name('contact.FAQ');
        Route::get('contact/FAQ/{id}',              [App\Http\Controllers\Admin\Contact\FAQController::class, 'show'])->name('contact.FAQEdit');
        Route::post('contact/FAQ/{id}',             [App\Http\Controllers\Admin\Contact\FAQController::class, 'save'])->name('contact.FAQSave');
        Route::delete('contact/FAQ/{id}',           [App\Http\Controllers\Admin\Contact\FAQController::class, 'delete'])->name('contact.FAQDelete');
    }
);
