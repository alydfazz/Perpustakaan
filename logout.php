<?php
session_start();
session_destroy(); 
setcookie('user', '', time() - 600, "/");
setcookie('level', '', time());

header("Location: index.php");
exit();
?>