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
	$string = file_get_contents("file.txt");
	preg_match_all("/[a-z_.\d]{3,}/", $string, $usernames);
	$people = [];
	$counter = 0;
	foreach ($usernames[0] as $username) {
		$following = $ig->people->getInfoByName($username)->getUser();
		$counter += 1;
		if ($following->getFollowerCount() < 10000) {
			echo $following->getUsername() . "\n";
		}
		if ($counter % 100 == 0) {
			sleep(180);
		}
	}

} catch (\Exception $e) {
	print "Something is wrong: " . $e->getMessage();
}
