<?php
require_once("../Configs/Web.config");
require_once("../Security/SecureSession.php");

foreach( $_POST as $key => $value )
{
    if( is_int($key) ) 
	{
		$order = $_SESSION['Order'];
		$_SESSION['Pizza'] = $order->GetPizza($key);
		header('Location: Add-Pizza.php');
	}
}


if (isset($_POST['AddAnoterPizza']))
{
	AddThenUsetPizza( $_POST );
	header('Location: Add-Pizza.php');
}

if(isset($_POST['Checkout']))
{
	AddThenUsetPizza( $_POST );
	header('Location: Checkout.php');
}

if(isset($_POST['ClearOrder']))
{
	unset($_SESSION['Order']);
	header('Location: ../index.html');
}

function AddThenUsetPizza( $details ) 
{
	if (isset($_SESSION['Pizza'])) 
	{
		$order = $_SESSION['Order'];
    	$pizza = $_SESSION['Pizza'];

    	$order->AddPizza($pizza, $details);
		unset($_SESSION['Pizza']);
	}
}