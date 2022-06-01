<?php

/*
    login.php

    MediaWiki API Demos
    Demo of `Login` module: Sending post request to login
    MIT license
*/

$endPoint = "https://ds1.cp4.vps1.seadan.com.au/wiki/api.php";

$login_Token = getLoginToken(); // Step 1
loginRequest($login_Token); // Step 2

// Step 1: GET Request to fetch login token
function getLoginToken()
{
	global $endPoint;

	$params1 = [
		"action" => "query",
		"meta" => "tokens",
		"type" => "login",
		"format" => "json"
	];

	$url = $endPoint . "?" . http_build_query($params1);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");

	$output = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($output, true);
	return $result["query"]["tokens"]["logintoken"];
}

// Step 2: POST Request to log in. Use of main account for login is not
// supported. Obtain credentials via Special:BotPasswords
// (https://www.mediawiki.org/wiki/Special:BotPasswords) for lgname & lgpassword
function loginRequest($logintoken)
{
	global $endPoint;
	// max_execution_time = 300;

	$params2 = [
		"action" => "login",
		"lgname" => "itzmichael",
		"lgpassword" => "8q6vcd6rb0thm1mk3dohi5q1ui4inb2t",
		"lgtoken" => $logintoken,
		"format" => "json"
	];

	// $ch = curl_init();

	// curl_setopt($ch, CURLOPT_URL, $endPoint);
	// curl_setopt($ch, CURLOPT_POST, true);
	// curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params2));
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
	// curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");

	// $output = curl_exec($ch);
	// curl_close($ch);




	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => $endPoint,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $params2,

	));

	$response = curl_exec($curl);
	$response = json_decode($response);

	curl_close($curl);



	echo '<pre>';
	print_r($response);
	echo '</pre>';
	die;
}
