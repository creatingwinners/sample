<?php

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

Route::get('/', 'VoucherController@welcome')->name('voucher.welcome');
Route::get('voucher/code', 'VoucherController@code')->name('voucher.code');
Route::post('voucher/verify', 'VoucherController@verify')->name('voucher.verify');
Route::get('voucher/ongeldig', 'VoucherController@invalid')->name('voucher.invalid');
Route::get('voucher/oeps', 'VoucherController@oeps')->name('voucher.oeps');
Route::get('voucher/{hash}/naw', 'VoucherController@address')->name('voucher.address');
Route::post('voucher/naw', 'VoucherController@save')->name('voucher.save');
Route::get('voucher/saved', 'VoucherController@saved')->name('voucher.saved');

Route::get('actie/{actie}/gefeliciteerd', 'ActieController@winner')->name('actie.winner');
Route::get('actie/{actie}/inactief', 'ActieController@inactive')->name('actie.inactive');
Route::get('actie/{actie}/bekend', 'ActieController@processed')->name('actie.processed');
Route::get('actie/{actie}/kanshebber', 'ActieController@chance')->name('actie.chance');

Route::get('excel/winners', 'ExcelController@winners')->name('excel.winners');
Route::get('excel/participants', 'ExcelController@participants')->name('excel.participants');

Auth::routes(['verify' => true, 'resgister' => false]);

Route::get('/admin', 'Admin\DashboardController@index')->name('dashboard.index');

Route::get('/admin/download', 'Admin\DownloadController@index')->name('download.index');
Route::get('/admin/download/{file}', 'Admin\DownloadController@download')->name('download.download');

Route::get('/admin/maandprijs', 'Admin\MaandprijsController@index')->name('maandprijs.index');
Route::get('/admin/maandprijs/search', 'Admin\MaandprijsController@search')->name('maandprijs.search');
Route::post('/admin/maandprijs/select', 'Admin\MaandprijsController@select')->name('maandprijs.select');
Route::post('/admin/maandprijs/save', 'Admin\MaandprijsController@save')->name('maandprijs.save');

Route::get('/admin/{actie}/setting', 'Admin\SettingController@index')->name('setting.index');
Route::put('/admin/{actie}/setting', 'Admin\SettingController@update')->name('setting.update');

Route::get('/admin/winner', 'Admin\WinnerController@index')->name('winner.index');
Route::get('/admin/winner/data', 'Admin\WinnerController@data')->name('winner.data');
Route::get('/admin/{actie}/winner', 'Admin\WinnerController@index_actie')->name('winner.index_actie');
Route::get('/admin/{actie}/winner/data', 'Admin\WinnerController@data_actie')->name('winner.data_actie');

Route::get('/admin/mail/{voucher}', 'Admin\VoucherController@mail')->name('voucher.mail');

Route::get('/admin/participant', 'Admin\ParticipantController@index')->name('participant.index');
Route::get('/admin/participant/data', 'Admin\ParticipantController@data')->name('participant.data');
Route::get('/admin/{actie}/participant', 'Admin\ParticipantController@index_actie')->name('participant.index_actie');
Route::get('/admin/{actie}/participant/data', 'Admin\ParticipantController@data_actie')->name('participant.data_actie');

Route::get('/admin/voucher', 'Admin\VoucherController@index')->name('voucher.index');
Route::get('/admin/voucher/data', 'Admin\VoucherController@data')->name('voucher.data');
Route::get('/admin/{actie}/voucher', 'Admin\VoucherController@index_actie')->name('voucher.index_actie');
Route::get('/admin/{actie}/voucher/data', 'Admin\VoucherController@data_actie')->name('voucher.data_actie');
Route::get('/admin/voucher/details/{voucher}', 'Admin\VoucherController@details')->name('voucher.details');

Route::get('/admin/coupon', 'Admin\CouponController@index')->name('coupon.index');
Route::get('/admin/coupon/data', 'Admin\CouponController@data')->name('coupon.data');
Route::get('/admin/coupon/details/{coupon}', 'Admin\CouponController@details')->name('coupon.details');
