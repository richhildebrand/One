<?php
require_once("../Configs/Web.config");
require_once("../Security/SecureSession.php");

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

function AddThenUsetPizza( $details ) 
{
	$order = $_SESSION['Order'];
    $pizza = $_SESSION['Pizza'];

    $order->AddPizza($pizza, $details);
	unset($_SESSION['Pizza']);
}