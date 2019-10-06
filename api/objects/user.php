<?php
// 'user' object
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $firstname;
    public $lastname;
    public $username;
    public $password;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
	
	// check if given username exists in the database
	function usernameExists(){
	 
		// query to check if username exists
		$query = "SELECT id, firstname, lastname, password
				FROM " . $this->table_name . "
				WHERE username = ?
				LIMIT 0,1";
	 
		// prepare the query
		$stmt = $this->conn->prepare( $query );
	 
		// sanitize
		$this->username=htmlspecialchars(strip_tags($this->username));
	 
		// bind given username value
		$stmt->bindParam(1, $this->username);
	 
		// execute the query
		$stmt->execute();
	 
		// get number of rows
		$num = $stmt->rowCount();
	 
		// if username exists, assign values to object properties for easy access and use for php sessions
		if($num>0){
	 
			// get record details / values
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
			// assign values to object properties
			$this->id = $row['id'];
			$this->firstname = $row['firstname'];
			$this->lastname = $row['lastname'];
			$this->password = $row['password'];
	 
			// return true because username exists in the database
			return true;
		}
	 
		// return false if username does not exist in the database
		return false;
	}
 

}