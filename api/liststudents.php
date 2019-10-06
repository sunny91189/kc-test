<?php
include_once 'config/core.php';
// required headers
header("Access-Control-Allow-Origin: ".$siteURL."");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/students.php';

// generate json web token
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
// get database connection
$database = new Database();
$dbObject = $database->getConnection();
 
// instantiate student object
$students = new Students($dbObject);
// get posted data
$data = json_decode(file_get_contents("php://input")); 
// get jwt
$jwt=isset($data->jwt) ? $data->jwt : "";
$page=isset($data->pageGt) ? $data->pageGt : 1;
// if jwt is not empty
if($jwt){
 
    // if decode succeed, show user details
    try {
 
        // decode jwt
        $decoded = JWT::decode($jwt, $key, array('HS256'));
		
    }
	 // if decode fails, it means jwt is invalid
	catch (Exception $e){
	 
		// set response code
		http_response_code(401);
	 
		// show error message
		echo json_encode(array(
			"message" => "Access denied.",
			"error" => $e->getMessage()
		));
	}
}
$studentLists = $students->getStudents($page);
print_r($studentLists);die;
?>