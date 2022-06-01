<?php

/*
    tag.php

    MediaWiki API Demos
    Demo of `Tag` module: Remove the spam tag from log entry ID 123 with the reason Wrongly applied

    MIT license
*/
$endPoint = "https://ds1.cp4.vps1.seadan.com.au/wiki/api.php";

$login_Token = getLoginToken(); // Step 1
loginRequest($login_Token); // Step 2
$csrf_Token = getCSRFToken(); // Step 3
stashEdit($csrf_Token); // Step 4

// Step 1: GET request to fetch login token
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

// Step 2: POST request to log in. Use of main account for login is not
// supported. Obtain credentials via Special:BotPasswords
// (https://www.mediawiki.org/wiki/Special:BotPasswords) for lgname & lgpassword
function loginRequest($logintoken)
{
	global $endPoint;

	$params2 = [
		"action" => "login",
		"lgname" => "bot_user_name",
		"lgpassword" => "bot_password",
		"lgtoken" => $logintoken,
		"format" => "json"
	];

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $endPoint);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params2));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");

	$output = curl_exec($ch);
	curl_close($ch);
}

// Step 3: GET request to fetch CSRF token
function getCSRFToken()
{
	global $endPoint;

	$params3 = [
		"action" => "query",
		"meta" => "tokens",
		"format" => "json"
	];

	$url = $endPoint . "?" . http_build_query($params3);

	$ch = curl_init($url);

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");

	$output = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($output, true);
	return $result["query"]["tokens"]["csrftoken"];
}

// Step 4: Send a POST request  to remove the spam tag from log entry ID 123 
// with the reason Wrongly applied
function stashEdit($csrftoken)
{
	global $endPoint;

	$params4 = [
		"action" => "tag",
		"format" => "json",
		"token" => $csrftoken,
		"logid" => "123",
		"remove" => "spam",
		"reason" => "Wrongly applied"

	];

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $endPoint);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params4));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");

	$response = curl_exec($ch);
	curl_close($ch);

	echo ($response);
}
