<?php
session_start();


//------------------------------------------------------------------------
// FIRST : 
//------------------------------------------------------------------------
//Take the username, email and initial password from the form field : 
$un = $_POST["username"];
$em = $_POST["email"];
$pwinit = $_POST["pwd1"];

//------------------------------------------------------------------------
//BLOWFISH ENCRYPTION : 
//Using the (php 5.5) built-in Blowish algorithm to randomly encrypt the password : 
//------------------------------------------------------------------------

// A higher "cost" is more secure but consumes more processing power :
$cost = 5;

// Create a random salt
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

// Prefix information about the hash so PHP knows how to verify it later.
// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter : 
$salt = sprintf("$2a$%02d$", $cost) . $salt;

//Hash the password with the salt
//(Hashing means mapping digital data of varied size to digital data of fixed size)
$hash = crypt($pwinit, $salt);

//COMMENTED OUT (JUST FOR DEVELOPER) : 
//echo "Your inital password was $pwinit<br />";
//echo "Your encryptyed password is $hash<br />";

//------------------------------------------------------------------------
//CONNECT TO MYSQL : 
//------------------------------------------------------------------------

//Set the variables to connect to the database : 
$username="mikeo158_ekimmik";
$password="sparkle123321";
$database="mikeo158_startmike";
$servername = "127.0.0.1";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection was not successful: " . $conn->connect_error);
} 

//COMMENTED OUT (JUST FOR DEVELOPER) : 
//echo "Connection was successful<br />";
//echo "Your username is $un.<br />Your email address is $em.<br />";

// sql to insert data into table
// Inserting hashed (encrypted) password into db.
// Note, of course, that we are NOT entering the actual password the user has created into the databsase :  
$sql = "INSERT INTO MikesGuests (Username, Email, Hash)
VALUES ('$un', '$em', '$hash')";

if ($conn->query($sql) === TRUE) {
	//If the registration is successful, display the 'registration-successful.html' page :
	$regsuccessfulfile = file_get_contents('registration-successful.html');
	echo $regsuccessfulfile;
	//COMMENTED OUT (JUST FOR DEVELOPER) : 
	//echo "<br />New record created successfully";
} 
else {
	//If there is an error with registration, display the 'registration-unsuccessful.html' page :	
    $regunsuccessfulfile = file_get_contents('registration-unsuccessful.html');
	echo $regunsuccessfulfile;
    //Errors with registration could include a duplicate entry for a username (obviously, this should be informed to them on the previous page, but this functionality has not been implemented in this demo)
	//COMMENTED OUT (JUST FOR DEVELOPER) : 
    //echo "<br />Error: " . $sql . "<br />" . $conn->error;
}

$conn->close();


//------------------------------------------------------------------------
//INFORMING THE ADMINISTRATOR THAT A NEW USER HAS BEEN CREATED : 
//------------------------------------------------------------------------

//email receiver and subject : 
$to = "assesspatientsmike@gmail.com";//gmail password = assesspatientsmike123
$subject = "New Email from michael-r-oneill.ie website";

//take the first name, last name, etc. from register page : 
$fn = $_POST["firstname"];
$sn = $_POST["secondname"];
//$un = $_POST["username"]; //(already done)
//$em = $_POST["email"]; //(already done)

//set the message of the email : 
$message = "
<html>
<head>
<title>New Email from $un </title>
</head>
<body>
<p>First Name = $fn</p>
<p>Second Name = $sn</p>
<p>Username = $un</p>
<p>Email = $em</p>
<p>End of email</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <oneillmike41@gmail.com>' . "\r\n";

//mail it off! : 
mail($to,$subject,$message,$headers);

?>



</html>