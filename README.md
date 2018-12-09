<p align="center"><img src="https://www.sms.ir/wp-content/themes/sms.ir/assets/img/final-sms-logo.png"></p>

<p align="center">Official Laravel Package for sms.ir</p>

[![Latest Stable Version](https://poser.pugx.org/phplusir/smsir/v/stable)](https://packagist.org/packages/phplusir/smsir)
[![Total Downloads](https://poser.pugx.org/phplusir/smsir/downloads)](https://packagist.org/packages/phplusir/smsir)
[![Monthly Downloads](https://poser.pugx.org/phplusir/smsir/d/monthly)](https://packagist.org/packages/phplusir/smsir)
[![License](https://poser.pugx.org/phplusir/smsir/license)](https://packagist.org/packages/phplusir/smsir)
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2FTrueMoein%2Fsmsir.svg?type=shield)](https://app.fossa.io/projects/git%2Bgithub.com%2FTrueMoein%2Fsmsir?ref=badge_shield)


<a align="center" href="https://www.sms.ir/%D8%AE%D8%AF%D9%85%D8%A7%D8%AA/%D9%88%D8%A8-%D8%B3%D8%B1%D9%88%DB%8C%D8%B3/%D8%A7%D8%B1%D8%B3%D8%A7%D9%84-%D9%BE%DB%8C%D8%A7%D9%85%DA%A9-laravel/">آموزش فارسی نصب و استفاده از پکیج ارسال پیامک لاراول</a>



Hi, if you have an account in sms.ir, you can use this package for laravel

----------


How to install:
-------------

    composer require phplusir/smsir
    php artisan vendor:publish

> **Setup:**

add this line to your app.php providers:
phplusir\smsir\SmsirServiceProvider::class,

and add this line to your app.php aliases:
'Smsir' => phplusir\smsir\SmsirFacade::class,


> After publish the package files you must open smsir.php in config folder and set the api-key, secret-key and your sms line number.
> 

> **Like this:**

	'api-key' => env('SMSIR-API-KEY','Your sms.ir api key'),
	'secret-key' => env('SMSIR-SECRET-KEY','Your sms.ir secret key'),
	'line-number' => env('SMSIR-LINE-NUMBER','Your sms.ir line number'
> 
> Note:

you can set the keys and line number in your .env file

> **like this:**

> SMSIR-API-KEY=your api-key

> SMSIR-SECRET-KEY=your secret-key

> SMSIR-LINE-NUMBER=1000465******



Methods:
-------------

> Coming Soon



## License
[![FOSSA Status](https://app.fossa.io/api/projects/git%2Bgithub.com%2FTrueMoein%2Fsmsir.svg?type=large)](https://app.fossa.io/projects/git%2Bgithub.com%2FTrueMoein%2Fsmsir?ref=badge_large)
