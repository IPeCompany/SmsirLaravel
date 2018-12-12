<?php
Route::group(['namespace'=>'Ipecompany\Smsirlaravel\Controllers','middleware'=>config('smsirlaravel.middlewares')], function (){
	Route::get(config('smsirlaravel.route'),'SmsirlaravelController@index')->name('sms-admin');
	Route::get('sms-admin/{log}/delete','SmsirlaravelController@delete')->name('deleteLog');
});
