<?php
set_time_limit(0);
date_default_timezone_set('UTC');
header('Content-Type: application/json; charset=utf-8');

require __DIR__ . '/../vendor/autoload.php';
\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
/////// CONFIG ///////
$username = '5.8ft';
$password = '';
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
	$pk =  $ig->timeline->getUserFeed($ig->people->getUserIdForName("matt_lyfl"))->getItems()[0]->getPk();
	$ig->media->like($pk);

} catch (\Exception $e) {
	print "Something is wrong: " . $e->getMessage();
}
