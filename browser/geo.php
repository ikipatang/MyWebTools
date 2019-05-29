<?php

	$curl_handle = curl_init();
	$IP = $_SERVER['REMOTE_ADDR'];
	curl_setopt($curl_handle, CURLOPT_URL, 'http://ip-api.com/json/'.$IP);
	curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
	$file_content = curl_exec($curl_handle);
	curl_close($curl_handle);
	if ($file_content == NULL) { // impossible request
		header("HTTP/1.0 404 Not Found"); exit;
	}



// send file to browser
header('Content-Type: text/json');
header('Content-Length: ' . strlen($file_content));
header('Cache-Control: public, max-age=2628000');
echo $file_content;
exit;
