<?php
include '../inc/header.php';
include '../models/user.php';
$user = User::find($_SESSION['id']);
if (!$user) {
	header("Location: /?action=login");
	return;
}

include '../views/market.php';
?>

