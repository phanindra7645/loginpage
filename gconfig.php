<?php
	//session_start();
	require_once "GoogleAPI/vendor/autoload.php";
	$gClient = new Google_Client();
	$gClient->setClientId("934707873803-a79k23bktebo4aqfa27cdbfahhb9cf2g.apps.googleusercontent.com");
	$gClient->setClientSecret("PSKE9XZfKyEVpL_mF-y30X_J");
	$gClient->setApplicationName("login");
	$gClient->setRedirectUri("http://localhost/loginform/RegistrationLogin/g-callback.php");
	$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
?>
