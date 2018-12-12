<?php

namespace Ipecompany\Smsirlaravel\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use Ipecompany\Smsirlaravel\Smsirlaravel;
use Ipecompany\Smsirlaravel\SmsirlaravelLogs;


class SmsirlaravelController extends Controller
{

	// the main index page for administrators
	public function index() {
		$credit = Smsirlaravel::credit();
		$smsirlaravel_logs = SmsirlaravelLogs::orderBy('id','DESC')->paginate(config('smsirlaravel.in-page'));
		return view('smsirlaravel::index',compact('credit','smsirlaravel_logs'));
	}

	// administrators can delete single log
	public function delete() {
		SmsirlaravelLogs::where('id',Route::current()->parameters['log'])->delete();
		// return the user back to sms-admin after delete the log
		return back();
	}
}
