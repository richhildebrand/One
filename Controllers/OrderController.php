<?php
include_once("../Database/OrderRepository.php");

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
}
elseif(isset($_POST['IncreaseItemQuantity']))
{
	$order = $_SESSION['Order'];
	$pizza = $order->SafeGetPizza($_POST['IncreaseItemQuantity']);
	$quantity = $pizza->GetQuantity();
	$pizza->SetQuantity($quantity + 1);
}
elseif(isset($_POST['DecreaseItemQuantity']))
{
	$order = $_SESSION['Order'];
	$pizza = $order->SafeGetPizza($_POST['DecreaseItemQuantity']);
	$quantity = $pizza->GetQuantity();
	
	if ($quantity > 1) 
	{
		$pizza->SetQuantity($quantity - 1);
	}
	else
	{
		$order->GetPizza($_POST['DecreaseItemQuantity']);
	}
}
elseif(isset($_POST['Logout']))
{
  session_unset();
  session_destroy();
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