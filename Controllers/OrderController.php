<?php
include_once("../Database/OrderDatabaseAccessor.php");

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
elseif(isset($_POST['SaveOrder']))
{
	$databaseAccessor = new OrderRepository();
	$databaseAccessor->SaveOrder( $_SESSION['Order'], $_SESSION['userName'] );
	$_SESSION['Order'] = null;
	header('Location: ../index.html');
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