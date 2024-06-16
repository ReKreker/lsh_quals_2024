<?php

$allowedActions = ['login', 'logout', 'buy', 'index', 'transfer', 'rollback'];
$action = isset($_GET['action']) && in_array($_GET['action'], $allowedActions) ? $_GET['action'] : 'index';
include "../actions/$action.php"

?>
