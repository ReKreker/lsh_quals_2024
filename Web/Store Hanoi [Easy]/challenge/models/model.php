<?php
require_once('../db/db.php');

class Model 
{
	protected $db;
	protected $tableName = '';
	public function __construct() 
	{
		$this->db = new LibraDb();				
		if (!$this->db) {
			throw new Exception($db->lastErrorMsg()); 
		}		
	}

}