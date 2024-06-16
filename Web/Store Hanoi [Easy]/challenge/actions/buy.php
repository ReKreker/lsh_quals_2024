<?php
include '../inc/header.php';
include '../models/user.php';
include '../models/item.php';

$user = User::find($_SESSION['id']);
if (!$user) {
	header("Location: /?action=login");
	return;
}


$item = Item::find($_GET['id']);
if (!$item) {
	header("Location: /");
	return;
}

if ($user->balance < $item->price) {
	header("Location: /");
	return;	
}

$user->purchase($item);
header("Location: /");
?>