<?php

if (isset($_POST['AddAnoterPizza']))
{
	AddThenUsetPizza( $_POST );
	header('Location: Add-Pizza.php');
}
elseif(isset($_POST['Checkout']))
{
	AddThenUsetPizza( $_POST );
	header('Location: Checkout.php');
}
elseif(isset($_POST['ClearOrder']))
{
	session_unset();
	session_destroy();
	header('Location: ../index.html');
}
elseif(isset($_POST['NavigateToAddPizza']))
{
	unset($_SESSION['Pizza']);
	header('Location: Add-Pizza.php');
}
elseif(isset($_POST['DeleteItem']))
{
	$order = $_SESSION['Order'];
	$order->DeletePizza($_POST['DeleteItem']);
	header('Location: Checkout.php');
}
elseif(isset($_POST['EditItem']))
{
	$order = $_SESSION['Order'];
	$_SESSION['Pizza'] = $order->GetPizza($_POST['EditItem']);
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
	}
}