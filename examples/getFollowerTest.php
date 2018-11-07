<?php
set_time_limit(0);
date_default_timezone_set('UTC');
header("Content-Type: application/json; charset=UTF-8");

require __DIR__ . '/../vendor/autoload.php';
\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
/////// CONFIG ///////
$username = '5.8ft';
$password = '9';
$debug = false;
$truncatedDebug = false;

$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);

try {
	$ig->login($username, $password);
} catch (\Exception $e) {
	echo 'Something went wrong: ' . $e->getMessage() . "\n";
	exit(0);
}

//
try {
	/**
	$friendships = ['509919859',
	'354615921',
	'1452036207',
	'343760734',
	'352017219'];
	print($ig->people->getFriendships($friendships)->asJson());**/

	//print(json_encode($ig->people->getFollowing("527484260", $ig->uuid)));

	$my_followings_pks = [];
	$friends_followings = [];
	$results = [];

	$my_followings = $ig->people->getSelfFollowing($ig->uuid)->getUsers();
	foreach ($my_followings as $following) {

		array_push($my_followings_pks, $following->getPk());
	}
	foreach (array_slice($my_followings_pks, 0, 100) as $userId) {
		print $userId . "\n";
	}
} catch (\Exception $e) {
	echo 'Something went wrong: ' . $e->getMessage() . "\n";
}
