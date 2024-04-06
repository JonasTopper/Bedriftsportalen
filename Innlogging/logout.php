<?php

session_start();

$_SESSSION = array();

session_destroy();

header("location: Login.php");
exit;
