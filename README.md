<p align="center"><img src="https://www.sms.ir/wp-content/themes/sms.ir/assets/img/final-sms-logo.png"></p>

<p align="center">Official Laravel Package for sms.ir</p>

[![Latest Stable Version](https://poser.pugx.org/ipecompany/smsirlaravel/v/stable)](https://packagist.org/packages/ipecompany/smsirlaravel)
[![Total Downloads](https://poser.pugx.org/ipecompany/smsirlaravel/downloads)](https://packagist.org/packages/ipecompany/smsirlaravel)
[![Monthly Downloads](https://poser.pugx.org/ipecompany/smsirlaravel/d/monthly)](https://packagist.org/packages/ipecompany/smsirlaravel)
[![License](https://poser.pugx.org/ipecompany/smsirlaravel/license)](https://packagist.org/packages/ipecompany/smsirlaravel)
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2FTrueMoein%2Fsmsir.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2FTrueMoein%2Fsmsir?ref=badge_shield)


<a align="center" href="https://www.sms.ir/%D8%AE%D8%AF%D9%85%D8%A7%D8%AA/%D9%88%D8%A8-%D8%B3%D8%B1%D9%88%DB%8C%D8%B3/%D8%A7%D8%B1%D8%B3%D8%A7%D9%84-%D9%BE%DB%8C%D8%A7%D9%85%DA%A9-laravel/">آموزش فارسی نصب و استفاده از پکیج ارسال پیامک لاراول</a>



Hi, if you have an account in sms.ir, you can use this package for laravel

----------


How to install:
-------------

    composer require ipecompany/smsirlaravel
    php artisan vendor:publish

> **Setup:**

add this line to your app.php providers:
ipecompany\smsirlaravel\SmsirlaravelServiceProvider::class,

and add this line to your app.php aliases:
'Smsirlaravel' => ipecompany\smsirlaravel\SmsirlaravelFacade::class,


> After publish the package files you must open smsirlaravel.php in config folder and set the api-key, secret-key and your sms line number.
> 

> **Like this:**

	'webservice-url' => env('SMSIR-WEBSERVICE-URL','https://ws.sms.ir/'),
	'api-key' => env('SMSIR-API-KEY','Your sms.ir api key'),
	'secret-key' => env('SMSIR-SECRET-KEY','Your sms.ir secret key'),
	'line-number' => env('SMSIR-LINE-NUMBER','Your sms.ir line number'
> 
> Note:

you can set the keys and line number in your .env file

> **like this:**

> SMSIR-WEBSERVICE-URL=https://ws.sms.ir/

> SMSIR-API-KEY=your api-key

> SMSIR-SECRET-KEY=your secret-key

> SMSIR-LINE-NUMBER=1000465******



Methods:
-------------

> Smsir::send()

> Smsir::credit()

> Smsir::getLines()

> Smsir::addToCustomerClub()

> Smsir::deleteContact();

> Smsir::sendToCustomerClub();

> Smsir::addContactAndSend();

> Smsir::sendVerification();

> Smsir::ultraFastSend();

> Smsir::getSentMessages();

> Smsir::getReceivedMessages();

## License
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2FTrueMoein%2Fsmsir.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2FTrueMoein%2Fsmsir?ref=badge_large)
