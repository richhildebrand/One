<?php
require_once("../Configs/Web.config");
require_once("../Security/SecureSession.php");
require_once("../Logging/Logging.php");

$log = new Logging();

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
	$log->write("inside AddAnoterPizza");
	AddThenUsetPizza( $_POST );
	header('Location: Add-Pizza.php');
}

if(isset($_POST['Checkout']))
{
	$log->write("inside Checkout");
	AddThenUsetPizza( $_POST );
	header('Location: Checkout.php');
}

if(isset($_POST['ClearOrder']))
{
	$log->write("inside ClearOrder");
	unset($_SESSION['Order']);
	header('Location: ../index.html');
}

if(isset($_POST['NavigateToAddPizza']))
{
	$log->write("inside NavigateToAddPizza");
	header('Location: Add-Pizza.php');
}

function AddThenUsetPizza( $details ) 
{
	if (isset($_SESSION['Pizza']) && isset($_SESSION['Order'])) 
	{
		$order = $_SESSION['Order'];
		$pizza = $_SESSION['Pizza'];

		$order->AddPizza($pizza, $details);
		unset($_SESSION['Pizza']);
		$log = new Logging();
		$log->write("After Unset in AddThenUsetPizza" . isset($_SESSION['Pizza']));
	}
}