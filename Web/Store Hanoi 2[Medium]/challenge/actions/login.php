<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
	login($_POST['username'], $_POST['password']);
}

if (isset($_SESSION['id'])) {
	header("Location: /");
	return;
}

function login($username, $password) {
	include '../models/user.php';
	$user = new User();
	$user->setUsername($username);
	$user->setPassword($password);
	if ($user->authenticate()) {
		$_SESSION['id'] = $user->id;		
		return;
	}
	echo "failed";
}
include('../views/login.php');
?>
