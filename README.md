
## Installation

### Using Composer

```sh
composer require mgp25/instagram-php
```

```php
require __DIR__.'/../vendor/autoload.php';

$ig = new \InstagramAPI\Instagram();
```

If you want to test new and possibly unstable code that is in the master branch, and which hasn't yet been released, then you can use master instead (at your own risk):

```sh
composer require mgp25/instagram-php dev-master
```

### I don't have Composer

You can download it [here](https://getcomposer.org/download/).

#### _Warning about moving data to a different server_

_Composer checks your system's capabilities and selects libraries based on your **current** machine (where you are running the `composer` command). So if you run Composer on machine `A` to install this library, it will check machine `A`'s capabilities and will install libraries appropriate for that machine (such as installing the PHP 7+ versions of various libraries). If you then move your whole installation to machine `B` instead, it **will not work** unless machine `B` has the **exact** same capabilities (same or higher PHP version and PHP extensions)! Therefore, you should **always** run the Composer-command on your intended target machine instead of your local machine._

## Examples

All examples can be found [here](https://github.com/mgp25/Instagram-API/tree/master/examples).

### IGFriends

The program helps to detect second degree friendships on Instagram by looking through your friends followings and find overlapping friends that you have not followed.
You can filter the list of potential friends by their follower counts or name or bio info to avoid following people you don't intend.
You can also do mass follow and like their media at the same time to get their attention.

This program really aims to help expanding connections by letting user aware of their potential friends, and allow user to fully engaged with maximum social connections.
Spams are strictly prohibited.