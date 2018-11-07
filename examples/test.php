<?php
set_time_limit(0);
date_default_timezone_set('UTC');
//header('Content-Type: text/html; charset=utf-8');
header("Content-type:application/json");

require __DIR__ . '/../vendor/autoload.php';
\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
/////// CONFIG ///////
$username = '5.8ft';
$password = 'Abc980326.';
$debug = false;
$truncatedDebug = false;
//////////////////////

$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);

// login
try {
	$ig->login($username, $password);
} catch (\Exception $e) {
	echo 'Something went wrong: ' . $e->getMessage() . "\n";
	exit(0);
}

// main
try {

	$isFollowingMe = intval($ig->people->getFriendship("397195065")->getFollowedBy());

} catch (\Exception $e) {
	print "Something is wrong: " . $e->getMessage();
}
