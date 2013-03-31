<?php
include_once("../Database/CrustRepository.php");

$_crustRepository = new CrustRepository();

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



function IsNullOrEmptyString($question){
    return (!isset($question) || trim($question)==='');
}