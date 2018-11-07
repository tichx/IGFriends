<?php
set_time_limit(0);
date_default_timezone_set('UTC');
header("Content-Type: application/json; charset=UTF-8");

require __DIR__ . '/../vendor/autoload.php';
\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
/////// CONFIG ///////
$username = '5.8ft';
$password = 'Xtc980326@zwy';
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

//echo $ig->story->getUserStoryFeed($ig->account_id)->getReel();
$users = array();
$nextMax = 0;
while ($nextMax <= 1065) {
	$data = $ig->story->getStoryItemViewers('1854438657014867531', $nextMax);
	$nextMax = $data->getNextMaxId();
	array_push($users, $data->getUsers());
}

print_r($users);