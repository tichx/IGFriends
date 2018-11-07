<?php
// This script returns a json summary of the friends of firends that you have not followed.
set_time_limit(0);
date_default_timezone_set('UTC');
header("Content-Type: application/json; charset=UTF-8");
require __DIR__ . '/../vendor/autoload.php';
\InstagramAPI\Instagram::$allowDangerousebUsageAtMyOwnRisk = true;


/////// CONFIG ///////
$username = '5.8ft';
$password = '';
$debug = false;
$truncatedDebug = false;
//////////////////////


// Initialize
$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);

// My following users' userID. You will need this to retrieve their following accounts.
$my_followings_pks = [];

// The list of accounts retrieved from friends' followings.
$friends_followings = [];

// Current number of following accounts

// Results of common friends
$results = [];

// Blacklist: the script will not retrieve the friends of the accounts below. You can use this to exclude certain groups of people. For example, if you don't want to crawl all of your high school friends' followings, you should try to put as much highschool friends you followed as possible into the blacklist. It only works if the list is accurate and exhaustive.
$blacklist = ["awwwwwzy","kkwwwwkk","sheldchen","wshiningw","galway__g","xinjasper","gjboseley","lsyjanis","haoxuan_luo","owwwlive","caseysophia2000","yhassan7","cheungxii","monacheb","cindyrella6268","hudieeeeeeee","attackiejackie","therealkimkay","ritawang_","lizisherry","leo_zhu_6er","alexsy.21","louisianachaii","cathyywu","jcarolynliu","eu.nahh","kira_kat_","ivancbo","lukas.zha","phinecc","easy_____pz","eu.nahh","linda_jingyu","thornelax","a_h_love8","ellenxrt","ritawang_","cherieeeeir","sunlit_blair","andrea_w_a","arashiiiii203","liuhanyuer","eacuniverse","lifeof_bom","fly_with_me_to","jintigerlee"];


// login 
try {
	$ig->login($username, $password);
} catch (\Exception $e) {
	echo 'Something went wrong: ' . $e->getMessage() . "\n";
	exit(0);
}


// This snippet of code retrieve my followed users and thier followings, and it is filtered by the black list.
$my_followings = $ig->people->getSelfFollowing($ig->uuid)->getUsers();
foreach ($my_followings as $following) {
	$pk = $following->getPk(); // pk is userId, you will need pk to access their account info.
	$username = $following->getUsername();
	if ($pk != "" && !in_array($username, $blacklist)) {
		array_push($my_followings_pks, $pk);
	}
}


// main
try {
	// selecting my top 100 followings.
	foreach (array_slice($my_followings_pks, 600, 700) as $userId) {
		// get one user's following
		$followings = $ig->people->getFollowing($userId, $ig->uuid)->getUsers();

		// going through this user's each following's profile.
		foreach ($followings as $following) {
			// test case
			//
			//if ($following->getUsername() == "yasmine.baba"||$following->getUsername() == "kayshava99"||$following->getUsername() == "eu.nahh") {
			//	echo $ig->people->getInfoById($userId)->getUser()->getUsername();
			//}
			$pk = $following->getPk();
			$data = array(
				'pk' => $pk,
				'username' => $following->getUsername(),
				'full_name' => $following->getFullName(),
				'is_private' => intval($following->getIsPrivate()),
				'profile_pic_url' => $following->getProfilePicUrl(),
				'is_verified' => intval($following->getIsVerified()),
				'common_followers' => [],
				'common_followers_count' => 0
			);
			if (!array_key_exists($pk, $friends_followings)) {
				$friends_followings[$pk] = $data;
			}
			array_push($friends_followings[$pk]["common_followers"], $userId);
			$friends_followings[$pk]["common_followers_count"]++;
		}
	}
	foreach ($friends_followings as $pk => $data) {
		/* filter by the following rules:
			1. mutual following greater than 10
			2. the user is not verified
			3. the user is not already followed by me
		*/
		if ($data["common_followers_count"] > 10 &&
			$data["is_verified"] == 0 &&
			!in_array($data["pk"], $my_followings_pks)
		) {
			$results[$data["common_followers_count"]] .= $data["username"] . "  ";
		}
	}
	arsort($results, SORT_NUMERIC);
	print json_encode($results);
	//$new_array = array_count_values($friends_followings);
	//arsort($new_array, SORT_NUMERIC);
	//print_r($new_array);
} catch (\Exception $e) {
	// TODO: make sure it still display partial json if some exception occurs.

	foreach ($friends_followings as $pk => $data) {
		/* filter by the following rules:
			1. mutual following greater than 5
			2. the user is not verified
			3. the user is not already followed by me
			4. the user has followers fewer than 50k
		*/
		if ($data["common_followers_count"] > 5 &&
			$data["is_verified"] == 0 &&
			!in_array($data["pk"], $my_followings_pks)
		) {
			$results[$data["common_followers_count"]] .= $data["username"] . "  ";
		}
	}
	arsort($results, SORT_NUMERIC);
	print json_encode($results);
}

