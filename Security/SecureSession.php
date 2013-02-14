<?php

ini_set('session.cookie_httponly', true);

session_start();

if (isset($_SESSION['last_ip']) === false)
{
	$_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
})

if ($_SESSION['last_ip'] !== $_SERVER) {
	session_unset();
	session_destroy();
}
