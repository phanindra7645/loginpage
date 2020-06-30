<?php
	require_once "config.php";

	try {
		$accessToken = $helper->getAccessToken();
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}

	/*
	if (!$accessToken) {
		header('Location: login.php');
		exit();
	}*/

	$oAuth2Client = $FB->getOAuth2Client();
	if (!$accessToken->isLongLived())
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
	echo "Helooo";
	$response = $FB->get("/me?fields=id,name,email", $accessToken);
	$userData = $response->getGraphNode()->asArray();
	echo $userData;
	$_SESSION['userData'] = $userData;
	$_SESSION['access_token'] = (string) $accessToken;
	header('Location: welcome.php');
	exit();
?>