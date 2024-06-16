<?php

session_start();

if (!array_key_exists('id', $_SESSION) || !isset($_SESSION['id'])) {
	header("Location: /?action=login");
	die();
}
