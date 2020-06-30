<?php
	session_start();

	require_once "Facebook/autoload.php";

	$FB = new \Facebook\Facebook([
		'app_id' => '1617806471728539',
		'app_secret' => '33ea611cb57eb9cd7faf8f3fa6b400fc',
		'default_graph_version' => 'v7.0'
	]);

	$helper = $FB->getRedirectLoginHelper();
?>