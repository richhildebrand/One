<?php
require_once("../Configs/Web.config");
require_once("../Security/SecureSession.php");


if (isset($_POST['AddAnoterPizza']))
{

	AddThenUsetPizza();
	header('Location: Add-Pizza.php');
}

if(isset($_POST['Checkout']))
{
	AddThenUsetPizza();
	header('Location: Checkout.php');
}

function AddThenUsetPizza() 
{
	$order = ($_SESSION['Order']);
    $pizza = ($_SESSION['Pizza']);

    $order->AddPizza($pizza);
	unset($_SESSION['Pizza']);
}