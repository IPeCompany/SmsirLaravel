<?php
namespace ipecompany\smsirlaravel;
use Illuminate\Support\Facades\Facade;

class SmsirFacade extends Facade
{
	protected static function getFacadeAccessor() {
		return 'smsirlaravel';
	}
}
