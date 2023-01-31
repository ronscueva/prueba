<?php
//$_SESSION = array();
session_start();
session_destroy();
header('Location: index.php');
die();
?>