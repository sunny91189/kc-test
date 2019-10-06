<?php
// 'students' object
class Students{
 
    // database connection and table name
    private $conn;
    private $table_name = "students";
 
    // object properties
    public $resultsInPage = 5;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
	
	// get relevant student results
	function getStudents($page=1){
		$sqlCount = "SELECT count(*) FROM " . $this->table_name . ""; 
		$resultCount = $this->conn->prepare($sqlCount); 
		$resultCount->execute(); 
		$resultCountTotal = $resultCount->fetchColumn(); 
		
		
		// query to check if username exists
		$query = "SELECT id, name, username, email, dob
				FROM " . $this->table_name . " LIMIT :start,:limit";
	 
		// prepare the query
		$statement = $this->conn->prepare( $query );
	 
		// sanitize
		$page=htmlspecialchars(strip_tags($page));
		if($page==1){
			$start = 0;
			$end = $this->resultsInPage;
		}else{
			$multiplier = $page - 1;
			$start = $multiplier*$this->resultsInPage;
			$end = $this->resultsInPage;
		}
		$statement->bindParam(':start', $start, PDO::PARAM_INT);
		$statement->bindParam(':limit', $end, PDO::PARAM_INT);
	 
		// execute the query
		$statement->execute();
	 
	 
		// get record details / values
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
		$resultsResp['studlist'] = $results;
		$resultsResp['resultCountTotal'] = $resultCountTotal;
		$resultsResp['resultPerPage'] = $this->resultsInPage;
		$resultsResp['resultPage'] = $page;
		$json = json_encode($resultsResp);  
		return $json;
	}
 

}