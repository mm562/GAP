<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}

if (isset($_SESSION['prolificid'])) {
    //echo "session_prolificid: ".$_SESSION['prolificid']."<br>";
   $prolificid = $_SESSION['prolificid'];
}
if (isset($_COOKIE['pid'])) {
    //echo "cookie_prolificid: ".$_COOKIE['pid']."<br>";
   $prolificid = $_COOKIE['pid'];
}
if (isset($_COOKIE['sd'])) {
   //echo "cookie_startdate: ".$_COOKIE['sd']."<br>";
   $startdate = $_COOKIE['sd'];
}
if (isset($_COOKIE['gid'])) {
   //echo "cookie_startdate: ".$_COOKIE['sd']."<br>";
   $groupid = $_COOKIE['gid'];
}
if (isset($_COOKIE['fnr'])) {
   //echo "cookie_startdate: ".$_COOKIE['sd']."<br>";
   $feednr = $_COOKIE['fnr'];
}
if (isset($_COOKIE['proc'])) {
   //echo "cookie_startdate: ".$_COOKIE['sd']."<br>";
   $proc = $_COOKIE['proc'];
}
if (isset($_COOKIE['lab'])) {
   //echo "cookie_startdate: ".$_COOKIE['sd']."<br>";
   $lab = $_COOKIE['lab'];
}
?>