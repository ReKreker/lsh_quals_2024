<?php
require_once('model.php');

class User extends Model 
{

	public int $id;
	public string $username;
	private string $password;
	public float $balance;
	public array $purchasedItems;

	protected $tableName = 'users';

	public function __construct() 
	{
		parent::__construct();
		$this->purchasedItems = [];
	}

	public function setUsername(string $username)
	{
		$this->username = $username;
	}

	public function setPassword(string $password)
	{
		$this->password = $password;
	}

	public function setBalance(float $balance)
	{
		$this->balance = $balance;
	}

	public function setId (int $id)
	{
		$this->id = $id;
	}

	public static function find(int $id) 
	{
		$instance = new self();
		$stmt = $instance->db->prepare('
			SELECT id, username, balance
			FROM users
			WHERE id = :id
			');
		$stmt->bindValue(':id', $id);
		$result = $stmt->execute();

		$row = $result->fetchArray();
		foreach($row as $attr => $value) {
			$instance->$attr = $value;
		}
		if ($row) {
			$instance->fetchItems();
		}
		
		 
		return $instance->id !== 0 ? $instance : null;
	}

	public static function fetchByUsername(string $username)
	{
		$instance = new self();
		$stmt = $instance->db->prepare('
			SELECT id
			FROM users
			WHERE username = :username
		');
		$stmt->bindValue(':username', $username);
		$result = $stmt->execute();		

		$row = $result->fetchArray();
		if (!$row) {
			return null;
		}
		foreach($row as $attr => $value) {
			$instance->$attr = $value;
		}		
		 
		return $instance->id !== 0 ? $instance : null;
	}

	public function fetchItems() 
	{		
		$stmt = $this->db->prepare('
			SELECT item_id
			FROM users_items
			WHERE user_id = :id
		');
		$stmt->bindValue(':id', $this->id);
		$result = $stmt->execute();

		while($row = $result->fetchArray()) {			
			array_push($this->purchasedItems, $row['item_id']);
		}
	}

	public function transfer(int $recipientId, float $amount)
	{
		$stmt = $this->db->prepare('
			UPDATE users
			SET balance = balance - :amount
			WHERE id = :sid
		');
		$stmt->bindValue(':sid', $this->id);
		$stmt->bindValue(':amount', $amount);		
		$stmt->execute();

		$stmt = $this->db->prepare('
			UPDATE users
			SET balance = balance + :amount
			WHERE id = :rid
		');
		$stmt->bindValue(':rid', $recipientId);
		$stmt->bindValue(':amount', $amount);
		$stmt->execute();
	}

	public function purchase($item)
	{		
		$stmt = $this->db->prepare('
			INSERT INTO users_items (user_id, item_id)
			VALUES (:uid, :tid);
			');
		$stmt->bindValue(':uid', $this->id);
		$stmt->bindValue(':tid', $item->id);
		$stmt->execute();


		$this->balance -= $item->price;
		$stmt = $this->db->prepare('
			UPDATE users
			SET balance = :balance
			WHERE id = :id
			');
		$stmt->bindValue(':balance', $this->balance);
		$stmt->bindValue(':id', $this->id);
		$stmt->execute();
	}


	public function authenticate() 
	{
		$stmt = $this->db->prepare('
			SELECT id
			FROM users
			WHERE username = :username
			AND password = :password
		');
		$stmt->bindValue(':username', $this->username);
		$stmt->bindValue(':password', md5($this->password));
		
		$result = $stmt->execute();
		$row = $result->fetchArray();
		if (!$row) {
			return false;
		}
		$this->id = $row['id'];
		
		return true;
	}
}