<?php
include '../inc/header.php';
include '../models/user.php';
$user = User::find($_SESSION['id']);	
if (isset($_POST['amount']) and isset ($_POST['recipient'])) {	
	$ss = md5(rand());
	if ($user->balance < $_POST['amount']) {
		die('Insufficient balance');
	}

	if ($_POST['amount'] <= 0) {
		die('Invalid amount');
	}
	file_put_contents('/tmp/a.log', $ss . ' before sleep' . PHP_EOL, FILE_APPEND);
	sleep(5);
	file_put_contents('/tmp/a.log', $ss . ' after sleep' . PHP_EOL, FILE_APPEND);

	$recipient = User::fetchByUsername($_POST['recipient']);
	if (!$recipient) {
		die('Recipient not found');
	}

	if ($_POST['recipient'] == $user->username) {
		die('Invalid recipient');
	}
	file_put_contents('/tmp/a.log', $ss . ' before transfer. ' . 'Balance: ' . $user->balance  . PHP_EOL, FILE_APPEND);
	$user->transfer($recipient->id, floatval($_POST['amount']));
	file_put_contents('/tmp/a.log', $ss . ' after transfer. ' . 'Balance: ' . $user->balance  . PHP_EOL, FILE_APPEND);
	$transferred = "Transferred $" . $_POST['amount'] . " to " . $_POST['recipient'];
}
include '../views/transfer.php';
?>
