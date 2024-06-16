<?php

class LibraDb extends SQLite3 {
	public function __construct() {
		$this->open('../db/libra.db');
	}
}