<?php
require_once('model.php');

class Item extends Model
{
	public int $id;
	public string $name;
	public string $content;
	public float $price;

	protected $tableName = 'items';

	public function __construct(int $id = 0, string $name = '', string $content = '', float $price = 0) 
	{
		parent::__construct();
		$this->id = $id;
		$this->name = $name;
		$this->content = $content;
		$this->price = $price;
	}
	

	public static function find(int $id) 
	{
		$instance = new self();
		$stmt = $instance->db->prepare('
			SELECT id, name, content, price
			FROM items
			WHERE id = :id
			');
		$stmt->bindValue(':id', $id);
		
		$result = $stmt->execute();
		if ($result->numColumns() > 0) {
			$row = $result->fetchArray();
			foreach( $row as $attr => $value) {
				$instance->$attr = $value;
			}
		}
		 
		return $instance->id !== 0 ? $instance : null;
	}

	public static function listAll(int $user_id = 0) 
	{
		$items = [];
		$query = sprintf("
			SELECT i.id, i.name, i.content, i.price 
			FROM items i
		");

		$instance = new self();
		$result = $instance->db->query($query);
		while($row = $result->fetchArray(SQLITE3_ASSOC)){
			array_push($items, new self($row['id'], $row['name'], $row['content'], $row['price']));			
		} 		
		return $items;
	}
}