<?php
session_start();
$_SESSION = [];
setcookie('id', '', time() - 3600);
setcookie('kimi', '', time() - 3600);
session_unset();
session_destroy();
header("location: login.php");
exit;

?>