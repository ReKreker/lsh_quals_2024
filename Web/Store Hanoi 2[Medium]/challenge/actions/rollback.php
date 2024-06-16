<?php
include '../inc/header.php';
include '../models/user.php';

$user = User::find($_SESSION['id']);
if (!$user) {
	header("Location: /?action=login");
	return;
}
if ($user->id != 1) {
	header("Location: /");
	return;
}

unlink('../db/libra.db');
include('../init.php');
create_tables();
seeding_users();
seeding_items();
unset($_SESSION['id']);
header("Location: /?action=login");
?>