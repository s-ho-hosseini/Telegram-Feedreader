<?php
header('Content-Type: text/html; charset=utf-8');

define("TOKEN", "305737044:AAGAIwUrbDC15wWE9k4JSDyd9yfgYoUKSW8");

require_once dirname( __FILE__ ) . '/dbconnect.php';
require_once dirname( __FILE__ ) . '/functions.php';



$feed_address="http://www.tabnak.ir/fa/rss/allnews";
$message_id="-1001081902139";
SetFeedReader($feed_address,$message_id);
?> 