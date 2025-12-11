<?php
require '../vendor/autoload.php';
session_start();
$_SESSION = array();

session_destroy();
setcookie(session_name(), 123, time() - 1000);
header("Location:index.php");
?>