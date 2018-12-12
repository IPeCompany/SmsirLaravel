<?php

namespace Ipecompany\Smsirlaravel;
use GuzzleHttp\Client;

class Smsirlaravel
{
	/**
	 * This method used for log the messages to the database if db-log set to true (@ smsirlaravel.php in config folder).
	 *
	 * @param $result
	 * @param $messages
	 * @param $numbers
	 * @internal param bool $addToCustomerClub | set to true if you want to log another message instead main message
	 */
	public static function DBlog($result, $messages, $numbers) {
		if(config('smsirlaravel.db-log')) {
			if (!is_array($numbers)) {
				$numbers = array($numbers);
			}
			$res = json_decode($result->getBody()->getContents(),true);

			if(count($messages) == 1) {
				foreach ( $numbers as $number ) {
					if (is_array($messages)) {
						$msg = $messages[0];
					} else {
						$msg = $messages;
					}
					$log = SmsirlaravelLogs::create( [
						'response' => $res['Message'],
						'message'  => $msg,
						'status'   => $res['IsSuccessful'],
						'from'     => config('smsirlaravel.line-number'),
						'to'       => $number,
					]);
				}
			} else {
				foreach ( array_combine( $messages, $numbers ) as $message => $number ) {
					SmsirlaravelLogs::create( [
						'response' => $res['Message'],
						'message'  => $message,
						'status'   => $res['IsSuccessful'],
						'from'     => config('smsirlaravel.line-number'),
						'to'       => $number,
					]);
				}
			}
		}
	}

	/**
	 * this method used in every request to get the token at first.
	 *
	 * @return mixed - the Token for use api
	 */
	public static function getToken()
	{
		$client     = new Client();
		$body       = ['UserApiKey'=>config('smsirlaravel.api-key'),'SecretKey'=>config('smsirlaravel.secret-key'),'System'=>'laravel_v_1_4'];
		$result     = $client->post(config('smsirlaravel.webservice-url').'api/Token',['json'=>$body,'connect_timeout'=>30]);
		return json_decode($result->getBody(),true)['TokenKey'];
	}

	/**
	 * this method return your credit in sms.ir (sms credit, not money)
	 *
	 * @return mixed - credit
	 */
	public static function credit()
	{
		$client     = new Client();
		$result     = $client->get(config('smsirlaravel.webservice-url').'api/credit',['headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);
		return json_decode($result->getBody(),true)['Credit'];
	}

	/**
	 * by this method you can fetch all of your sms lines.
	 *
	 * @return mixed , return all of your sms lines
	 */
	public static function getLines()
	{
		$client     = new Client();
		$result     = $client->get(config('smsirlaravel.webservice-url').'api/SMSLine',['headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);
		return json_decode($result->getBody(),true);
	}

	/**
	 * Simple send message with sms.ir account and line number
	 *
	 * @param $messages = Messages - Count must be equal with $numbers
	 * @param $numbers  = Numbers - must be equal with $messages
	 * @param null $sendDateTime = don't fill it if you want to send message now
	 *
	 * @return mixed, return status
	 */
	public static function send($messages,$numbers,$sendDateTime = null)
	{
		$client     = new Client();
		$messages = (array)$messages;
		$numbers = (array)$numbers;
		if($sendDateTime === null) {
			$body   = ['Messages'=>$messages,'MobileNumbers'=>$numbers,'LineNumber'=>config('smsirlaravel.line-number')];
		} else {
			$body   = ['Messages'=>$messages,'MobileNumbers'=>$numbers,'LineNumber'=>config('smsirlaravel.line-number'),'SendDateTime'=>$sendDateTime];
		}
		$result     = $client->post(config('smsirlaravel.webservice-url').'api/MessageSend',['json'=>$body,'headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);

		self::DBlog($result,$messages,$numbers);

		return json_decode($result->getBody(),true);
	}

	/**
	 * add a person to the customer club contacts
	 *
	 * @param $prefix               = mr, dr, dear...
	 * @param $firstName            = first name of this contact
	 * @param $lastName             = last name of this contact
	 * @param $mobile               = contact mobile number
	 * @param string $birthDay      = birthday of contact, not require
	 * @param string $categotyId    = which category id of your customer club to join this contact?
	 *
	 * @return \Psr\Http\Message\ResponseInterface = $result as json
	 */
	public static function addToCustomerClub($prefix,$firstName,$lastName,$mobile,$birthDay = '',$categotyId = '')
	{
		$client     = new Client();
		$body       = ['Prefix'=>$prefix,'FirstName'=>$firstName,'LastName'=>$lastName,'Mobile'=>$mobile,'BirthDay'=>$birthDay,'CategoryId'=>$categotyId];
		$result     = $client->post(config('smsirlaravel.webservice-url').'api/CustomerClubContact',['json'=>$body,'headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);
		// $res        = json_decode($result->getBody()->getContents(),true);

		self::DBlog($result,"افزودن $firstName $lastName به مخاطبین باشگاه ",$mobile);

		return json_decode($result->getBody(),true);
	}

	/**
	 * this method send message to your customer club contacts (known as white sms module)
	 *
	 * @param $messages
	 * @param $numbers
	 * @param null $sendDateTime
	 * @param bool $canContinueInCaseOfError
	 *
	 * @return \Psr\Http\Message\ResponseInterface
	 */
	public static function sendToCustomerClub($messages,$numbers,$sendDateTime = null,$canContinueInCaseOfError = true)
	{
		$client     = new Client();
		$messages = (array)$messages;
		$numbers = (array)$numbers;
		if($sendDateTime !== null) {
			$body   = ['Messages'=>$messages,'MobileNumbers'=>$numbers,'SendDateTime'=>$sendDateTime,'CanContinueInCaseOfError'=>$canContinueInCaseOfError];
		} else {
			$body   = ['Messages'=>$messages,'MobileNumbers'=>$numbers,'CanContinueInCaseOfError'=>$canContinueInCaseOfError];
		}
		$result     = $client->post(config('smsirlaravel.webservice-url').'api/CustomerClub/Send',['json'=>$body,'headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);

		self::DBlog($result,$messages,$numbers);

		return json_decode($result->getBody(),true);

	}

	/**
	 * this method add contact to the your customer club and then send a message to him/her
	 *
	 * @param $prefix
	 * @param $firstName
	 * @param $lastName
	 * @param $mobile
	 * @param $message
	 * @param string $birthDay
	 * @param string $categotyId
	 *
	 * @return mixed
	 */
	public static function addContactAndSend($prefix,$firstName,$lastName,$mobile,$message,$birthDay = '',$categotyId = '')
	{
		$client = new Client();
		$body   = ['Prefix'=>$prefix,'FirstName'=>$firstName,'LastName'=>$lastName,'Mobile'=>$mobile,'BirthDay'=>$birthDay,'CategoryId'=>$categotyId,'MessageText'=>$message];
		$result = $client->post(config('smsirlaravel.webservice-url').'api/CustomerClub/AddContactAndSend',['json'=>[$body],'headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);

		self::DBlog($result,$message,$mobile);

		return json_decode($result->getBody(),true);
	}

	/**
	 * this method send a verification code to your customer. need active the module at panel first.
	 *
	 * @param $code
	 * @param $number
	 *
	 * @param bool $log
	 *
	 * @return mixed
	 */
	public static function sendVerification($code,$number,$log = false)
	{
		$client = new Client();
		$body   = ['Code'=>$code,'MobileNumber'=>$number];
		$result = $client->post(config('smsirlaravel.webservice-url').'api/VerificationCode',['json'=>$body,'headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);
		if($log) {
			self::DBlog($result,$code,$number);
		}
		return json_decode($result->getBody(),true);
	}

	/**
	 * @param array $parameters = all parameters and parameters value as an array
	 * @param $template_id = you must create a template in sms.ir and put your template id here
	 * @param $number = phone number
	 * @return mixed = the result
	 */
	public static function ultraFastSend(array $parameters, $template_id, $number) {
		$params = [];
		foreach ($parameters as $key => $value) {
			$params[] = ['Parameter' => $key, 'ParameterValue' => $value];
		}
		$client = new Client();
		$body   = ['ParameterArray' => $params,'TemplateId' => $template_id,'Mobile' => $number];
		$result = $client->post(config('smsirlaravel.webservice-url').'api/UltraFastSend',['json'=>$body,'headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);

		return json_decode($result->getBody(),true);
	}

	/**
	 * this method used for fetch received messages
	 *
	 * @param $perPage
	 * @param $pageNumber
	 * @param $formDate
	 * @param $toDate
	 *
	 * @return mixed
	 */
	public static function getReceivedMessages($perPage,$pageNumber,$formDate,$toDate)
	{
		$client = new Client();
		$result = $client->get(config('smsirlaravel.webservice-url')."api/ReceiveMessage?Shamsi_FromDate={$formDate}&Shamsi_ToDate={$toDate}&RowsPerPage={$perPage}&RequestedPageNumber={$pageNumber}",['headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);

		return json_decode($result->getBody()->getContents())->Messages;
	}

	/**
	 * this method used for fetch your sent messages
	 *
	 * @param $perPage = how many sms you want to fetch in every page
	 * @param $pageNumber = the page number
	 * @param $formDate = from date
	 * @param $toDate = to date
	 *
	 * @return mixed
	 */
	public static function getSentMessages($perPage,$pageNumber,$formDate,$toDate)
	{
		$client = new Client();
		$result = $client->get(config('smsirlaravel.webservice-url')."api/MessageSend?Shamsi_FromDate={$formDate}&Shamsi_ToDate={$toDate}&RowsPerPage={$perPage}&RequestedPageNumber={$pageNumber}",['headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);

		return json_decode($result->getBody()->getContents())->Messages;
	}

	
	/**
	 * @param $mobile = The mobile number of that user who you wanna to delete it
	 *
	 * @return mixed = the result
	 */
	public static function deleteContact($mobile) {
		$client = new Client();
		$body   = ['Mobile' => $mobile, 'CanContinueInCaseOfError' => false];
		$result = $client->post(config('smsirlaravel.webservice-url').'api/CustomerClub/DeleteContactCustomerClub',['json'=>$body,'headers'=>['x-sms-ir-secure-token'=>self::getToken()],'connect_timeout'=>30]);

		return json_decode($result->getBody(),true);
	}



}
