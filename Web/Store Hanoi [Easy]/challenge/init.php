<?php 
require_once('../db/db.php');

function create_tables() {
	$db = new LibraDb();
	if (!$db) {
		die($db->lastErrorMsg()); 
	}

	$sql = <<<EOF
		CREATE TABLE IF NOT EXISTS users
		(
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			username CHAR(50) NOT NULL UNIQUE,
			password CHAR(32) NOT NULL,
			balance REAL DEFAULT 0
		)
		EOF;

	$ret = $db->exec($sql);
	if (!$ret) {
		die($db->lastErrorMsg());
	}

	$sql = <<<EOF
		CREATE TABLE IF NOT EXISTS items
		(
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			name CHAR(50) NOT NULL UNIQUE,
			content TEXT NOT NULL,
			price REAL DEFAULT 0
		)
		EOF;

	$ret = $db->exec($sql);
	if (!$ret) {
		die($db->lastErrorMsg());
	}

	$sql = <<<EOF
		CREATE TABLE IF NOT EXISTS users_items
		(
			id INTEGER PRIMARY KEY AUTOINCREMENT,
			user_id INTEGER NOT NULL,
			item_id INTEGER NOT NULL,			
			FOREIGN KEY(user_id) REFERENCES users(id),
			FOREIGN KEY(item_id) REFERENCES items(id)
		)
		EOF;

	$ret = $db->exec($sql);
	if (!$ret) {
		die($db->lastErrorMsg());
	}




	$db->close();	
}

function seeding_users() {
	$db = new LibraDb();
	if (!$db) {
		die($db->lastErrorMsg()); 
	}

	$sql = sprintf("
		INSERT INTO users (username, password, balance)
		VALUES ('alice', '%s', 1500),
		('bob', '%s', 1500);
		", md5('alice'), md5('bob'));

	$ret = $db->exec($sql);
	if (!$ret) {
		die($db->lastErrorMsg());
	}
	

	$db->close();	
}

function seeding_items() {
  	$flag = file_get_contents("/flag.txt");
	$db = new LibraDb();
	if (!$db) {
		die($db->lastErrorMsg()); 
	}

	$sql = sprintf("
		INSERT INTO items (name, content, price)
		VALUES ('poem', 'Roses are red. Violets are blue. Onions stink. And so do you.', 1000),
		('flag', '%s', 3001),
		('music', 'https://www.youtube.com/watch?v=5T3ip8yQp_k', 5000);
		", $flag);

	$ret = $db->exec($sql);
	if (!$ret) {
		die($db->lastErrorMsg());
	}

	

	$db->close();	
}

if (isset($_GET['action'])) {
	switch ($_GET['action']) {
		case 'create-tables':
			create_tables();
			echo "Table user created successfully";			
			break;
		case 'seeding-users':
			seeding_users();
			echo "Seeding users successfully";
			break;
    	case 'seeding-items':
			seeding_items();
			echo "Seeding items successfully";
			break;
		default:			
			break;
	}	
}


