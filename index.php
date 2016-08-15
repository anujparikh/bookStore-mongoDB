<?php
include("commonFunctions.php");
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
date_default_timezone_set("America/New_York");
$time = date("h:i:sa");
$uuid = uniqid();
urlDataInsert("HomePage", $actual_link, $time, $uuid);
include("header.php");
include("left.php");
include("content1.php");
include("footer.php");
?>