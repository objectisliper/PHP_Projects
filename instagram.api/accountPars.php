<?php 
// This file is generated by Composer
require_once __DIR__ . '/vendor/autoload.php';

//$proxyArray = [[
//    'address' => '91.197.190.81',
//    'port'    => '53281',
//    'tunnel'  => true,
//    'timeout' => 30,
//],
//[
//    'address' => '91.228.158.61',
//    'port'    => '41258',
//    'tunnel'  => true,
//    'timeout' => 30,
//],
//[
//    'address' => '76.190.78.10',
//    'port'    => '3128',
//    'tunnel'  => true,
//    'timeout' => 30,
//],
//[
//    'address' => '213.168.63.158',
//    'port'    => '8080',
//    'tunnel'  => true,
//    'timeout' => 30,
//],
//[
//    'address' => '52.29.60.179',
//    'port'    => '3128',
//    'tunnel'  => true,
//    'timeout' => 30,
//],
//[
//    'address' => '179.43.141.201',
//    'port'    => '3128',
//    'tunnel'  => true,
//    'timeout' => 30,
//]
//];

//\InstagramScraper\Instagram::setProxy(
//$proxyArray[1]
//);


$start = microtime(true);

$account = (new \InstagramScraper\Instagram)->getMediasByLocationId('558008714386619',100);
//echo "Account info:\n";
//echo "Id: {$account->getId()}\n";
print_r($account);
$time = microtime(true) - $start;
print_r($time*50);
//echo "Full name: {$account->getFullName()}\n";
//echo "Biography: {$account->getBiography()}\n";
//echo "Profile picture url: {$account->getProfilePicUrl()}\n";
//echo "External link: {$account->getExternalUrl()}\n";
//echo "Number of published posts: {$account->getMediaCount()}\n";
//echo "Number of followers: {$account->getFollowedByCount()}\n";
//echo "Number of follows: {$account->getFollowsCount()}\n";
//echo "Is private: {$account->isPrivate()}\n";
//echo "Is verified: {$account->isVerified()}\n";


