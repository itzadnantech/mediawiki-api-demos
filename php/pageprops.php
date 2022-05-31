<?php

//This file is autogenerated. See modules.json and autogenerator.py for details

/*
    pageprops.php

    MediaWiki API Demos
    Demo of `Pageprops` module: Get various properties defined in the page content

    MIT License
*/

$endPoint = "https://en.wikipedia.org/w/api.php";
$params = [
    "action" => "query",
    "titles" => "Albert Einstein",
    "prop" => "pageprops",
    "format" => "json"
];

$url = $endPoint . "?" . http_build_query( $params );

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$output = curl_exec( $ch );
curl_close( $ch );

$result = json_decode( $output, true );
var_dump( $result );
