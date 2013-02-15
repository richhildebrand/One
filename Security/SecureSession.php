<?php

session_start();

if (isset($_SESSION['last_ip']) === false || $_SESSION['last_ip'] !== $_SERVER)
{
	session_unset();
	session_destroy();
	header("Location: login.php");
})