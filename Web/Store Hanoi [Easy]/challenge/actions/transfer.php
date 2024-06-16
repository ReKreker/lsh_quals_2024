<?php
include '../inc/header.php';
include '../models/user.php';
$user = User::find($_SESSION['id']);	
if (isset($_POST['amount']) and isset ($_POST['recipient'])) {	
	if ($user->balance < $_POST['amount']) {
		die('Insufficient balance');
	}

	$recipient = User::fetchByUsername($_POST['recipient']);
	if (!$recipient) {
		die('Recipient not found');
	}

	if ($_POST['recipient'] == $user->username) {
		die('Invalid recipient');
	}

	$user->transfer($recipient->id, floatval($_POST['amount']));
	$transferred = "Transferred $" . $_POST['amount'] . " to " . $_POST['recipient'];
}
include '../views/transfer.php';
?>
