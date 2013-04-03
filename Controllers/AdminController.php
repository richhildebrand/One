<?php
include_once("../Database/CrustRepository.php");
include_once("../Database/ToppingRepository.php");
include_once("../Database/ProductRepository.php");

$_crustRepository = new CrustRepository();
$_toppingRepository = new ToppingRepository();
$_productRepository = new ProductRepository();

if (isset($_POST['AddNewCrust']))
{
	$description = $_POST['NewCrustDescription'];
	$price = $_POST['NewCrustPrice'];

	if (!IsNullOrEmptyString($description))
	{
		$_crustRepository->AddNewCrust($description, $price);
	}
}
elseif (isset($_POST['RemoveCrust']))
{
	$id = $_POST['RemoveCrust'];
	$_crustRepository->RemoveCrust($id);
}
elseif (isset($_POST['UpdateCrust']))
{
	$id = $_POST['UpdateCrust'];
	$description = $_POST['UpdatedCrustDescription' . $id];
	$price = $_POST['UpdatedCrustPrice' . $id];

	if (!IsNullOrEmptyString($description))
	{
		$_crustRepository->UpdateCrust($id, $description, $price);
	}
}
elseif (isset($_POST['AddNewTopping']))
{
	$description = $_POST['NewToppingDescription'];
	$price = $_POST['NewToppingPrice'];

	if (!IsNullOrEmptyString($description))
	{
		$_toppingRepository->AddNewTopping($description, $price);
	}
}
elseif (isset($_POST['RemoveTopping']))
{
	$id = $_POST['RemoveTopping'];
	$_toppingRepository->RemoveTopping($id);
}
elseif (isset($_POST['UpdateTopping']))
{
	$id = $_POST['UpdateTopping'];
	$description = $_POST['UpdatedToppingDescription' . $id];
	$price = $_POST['UpdatedToppingPrice' . $id];

	if (!IsNullOrEmptyString($description))
	{
		$_toppingRepository->UpdateTopping($id, $description, $price);
	}
}
elseif(isset($_POST['Logout']))
{
  session_unset();
  session_destroy();
  header('Location: ../index.html');
}
elseif(isset($_POST['AddNewProduct']))
{
	$type = $_POST['ProductType'];
	$description = $_POST['NewProductDescription'];
	$price = $_POST['NewProductPrice'];

	$_productRepository->AddNewProduct($type, $description, $price);
}
elseif (isset($_POST['RemoveProduct']))
{
	$id = $_POST['RemoveProduct'];
	$_productRepository->RemoveProduct($id);
}
elseif (isset($_POST['UpdateProduct']))
{
	$id = $_POST['UpdateProduct'];
	$type = $_POST['ProductType'];
	$description = $_POST['UpdatedProductDescription' . $id];
	$price = $_POST['UpdatedProductPrice' . $id];

	$_productRepository->UpdateProduct($id, $type, $description, $price);
}


function IsNullOrEmptyString($question) {
    return (!isset($question) || trim($question)==='');
}

function AreNullOrEmptyString($str1, $str2, $str3) {
    return IsNullOrEmptyString($str1) || IsNullOrEmptyString($str2) || IsNullOrEmptyString($str3);
}