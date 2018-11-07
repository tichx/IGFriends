<?php
set_time_limit(0);
date_default_timezone_set('UTC');
header("Content-type:application/json");

require __DIR__ . '/../vendor/autoload.php';
\InstagramAPI\Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
/////// CONFIG ///////
$username = '5.8ft';
$password = 'zwy913786169';
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
$unfollow_list = [];
$unfollowed_list = [];
// main
try {
	$my_followings = $ig->people->getSelfFollowing($ig->uuid)->getUsers();
	foreach ($my_followings as $user) {
		array_push($unfollow_list, $user->getPk());
	}
	foreach ($unfollow_list as $pk) {
		$isFollowingMe = intval($ig->people->getFriendship($pk)->getFollowedBy());
		if ($isFollowingMe == 0) {
			$ig->people->unfollow($pk);
			echo "<script>console.log( '@: " . $pk . "' );</script>";
			array_push($unfollowed_list, $pk);
			if (count($unfollowed_list) % 70 == 0) {
				sleep(1200);
			}
		}
	}
	foreach ($unfollowed_list as $pk) {
		echo $pk . "\n";
	}
	echo "Total: " . count($unfollowed_list);

} catch (\Exception $e) {
	print "Something is wrong: " . $e->getMessage();
	foreach ($unfollowed_list as $pk) {
		echo $pk . "\n";
	}
	echo "Total: " . count($unfollowed_list);
}
