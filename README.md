<p align="center"><a href="https://sms.ir"><img src="https://sms.ir/wp-content/uploads/2020/04/smsir-logo.png"></a></p>

<p align="center">Unofficial Laravel Package for sms.ir</p>

[![Latest Stable Version](https://poser.pugx.org/ipecompany/smsirlaravel/v/stable)](https://packagist.org/packages/ipecompany/smsirlaravel)
[![Total Downloads](https://poser.pugx.org/ipecompany/smsirlaravel/downloads)](https://packagist.org/packages/ipecompany/smsirlaravel)
[![Monthly Downloads](https://poser.pugx.org/ipecompany/smsirlaravel/d/monthly)](https://packagist.org/packages/ipecompany/smsirlaravel)
[![License](https://poser.pugx.org/ipecompany/smsirlaravel/license)](https://packagist.org/packages/ipecompany/smsirlaravel)

Hi, if you have an account in sms.ir, you can use this package for laravel

<hr />

## 1. Install
```shell
composer require jalallinux/smsirlaravel
```

<hr />

## 2. Publish vendor
```shell
php artisan vendor:publish
```
then select `jalallinux\Smsirlaravel\SmsirlaravelServiceProvider`

<hr />

* If using laravel 5.4 or below must register provider and alias in your `config/app.php`:
> Providers: jalallinux\smsirlaravel\SmsirlaravelServiceProvider::class,

> Aliases: 'Smsirlaravel' => jalallinux\smsirlaravel\SmsirlaravelFacade::class,

<hr />

## 3. Migrate table
```shell
php artisan migrate
```

<hr />

## 4. Configuration package
After publish the package files you must open `config/smsirlaravel.php` set the keys.
```php
'webservice-url' => env('SMSIR_WEBSERVICE_URL','https://ws.sms.ir/'),

'api-key' => env('SMSIR_API_KEY','Your sms.ir api key'),

'secret-key' => env('SMSIR_SECRET_KEY','Your sms.ir secret key'),

'line-number' => env('SMSIR_LINE_NUMBER','Your sms.ir line number'
```

or you can set your key in `.env` file:

> SMSIR_WEBSERVICE_URL=https://ws.sms.ir/

> SMSIR_API_KEY=your api-key

> SMSIR_SECRET_KEY=your secret-key

> SMSIR_LINE_NUMBER=1000465******


Available Methods:
-------------
- Sending Message:
```php
Smsirlaravel::send($messages, $numbers, $sendDateTime = null);

Smsirlaravel::sendVerification($code, $number, $log = false);

Smsirlaravel::ultraFastSend(array $parameters, $template_id, $number);
```

<hr />

- Panel Details:
```php
Smsirlaravel::credit();

Smsirlaravel::getLines();
```

<hr />

- Customer Club:
```php
Smsirlaravel::addToCustomerClub($prefix, $firstName, $lastName, $mobile, $birthDay = '', $categotyId = '')

Smsirlaravel::sendToCustomerClub($messages, $numbers, $sendDateTime = null, $canContinueInCaseOfError = true);
```

<hr />

- Contact Management:
```php
Smsirlaravel::deleteContact($mobile);

Smsirlaravel::addContactAndSend($prefix, $firstName, $lastName, $mobile, $message, $birthDay = '', $categotyId = '');
```

<hr />

- Message Report:
```php
Smsirlaravel::getReceivedMessages($perPage, $pageNumber, $formDate, $toDate);

Smsirlaravel::getSentMessages($perPage, $pageNumber, $formDate, $toDate);

Smsirlaravel::getSentMessage($bulk);
```


<p align="center"><a href="https://jalallinux.ir">JalalLinuX</a></p>
