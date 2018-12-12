<?php

namespace Ipecompany\Smsirlaravel;

use Illuminate\Database\Eloquent\Model;

class SmsirlaravelLogs extends Model
{
	protected $guarded = [];
	protected $table = 'smsirlaravel_logs';

	public function sendStatus() {
		if($this->status){
			return '<i class="fa fa-check-circle" aria-hidden="true" style="color: green"></i>';
		}
		
		return '<i class="fa fa-exclamation-circle" aria-hidden="true" style="color: red"></i>';
		
	}
}
