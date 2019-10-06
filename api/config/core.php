<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Asia/Kolkata');
 
// variables used for jwt
$key = "exampleSecretkey";

//specify site root url
$aud = $iss = $siteURL = "http://localhost/kc-test-task";

$iat = time();
$nbf = time();
?>