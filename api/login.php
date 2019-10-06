<?php
include_once 'config/core.php';
// required headers
header("Access-Control-Allow-Origin: ".$siteURL."");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files needed to connect to database
include_once 'config/database.php';
include_once 'objects/user.php';

// get database connection
$database = new Database();
$dbObject = $database->getConnection();
 
// instantiate user object
$user = new User($dbObject);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$user->username = $data->username;
$usernameExists = $user->usernameExists();
 
// generate json web token
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;
if(isset($data->password)){
	$hashPassword  = md5($data->password);
}

// check if username exists and if password is correct
if($usernameExists && ($hashPassword == $user->password)){
    $token = array(
       "iss" => $iss,
       "aud" => $aud,
       "iat" => $iat,
       "nbf" => $nbf,
       "data" => array(
           "id" => $user->id,
           "firstname" => $user->firstname,
           "lastname" => $user->lastname,
           "username" => $user->username
       )
    );
 
    // set response code
    http_response_code(200);
 
    // generate jwt
    $jwt = JWT::encode($token, $key);
    echo json_encode(
            array(
                "message" => "Login successful",
				"redirect" => $siteURL."/students.html",
                "jwt" => $jwt
            )
        );
 
}else{ 
    // set response code
    //http_response_code(401);
 
    // tell the user login failed
    echo json_encode(array("error" => "Invalid Login Credentials!"));
}
?>