<?php
session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>

	<title>Patient Profile Created</title>

  <!-- Favicon : -->
  <link rel='shortcut icon' href='http://www.michael-r-oneill.ie/assesspatients/favicon.ico'>

  <?php
//The doctor is the logged in user : 
$doctor = $_SESSION["loggedinuser"]; 

//As usual, display their username, with the opton of logging out : 
echo "$doctor<br />
<a href = 'http://www.michael-r-oneill.ie/assesspatients/Login/loggedout.php'>Logout</a>";


//The patient and diagnosis are got from the form in the previous page : 
$patient = $_POST["patientname"];
$diag = $_POST["diagnosis"];

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
//Commented out, for testing : 
//echo "Connection was successful";


//If the doctor has already created a diagnosis for this patient, he/she cannot do it again  : 
$sql = "SELECT Patientname FROM Patients WHERE Doctorname = '$doctor' AND Patientname = '$patient'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $alreadycreated = file_get_contents('patient-profile-already-created.html');
	echo $alreadycreated;
	break;
    }
} 
//Otherwise, if it's a new patient, the doctor can now create a diagnosis for the patient :
else
{ 
$sql = "INSERT INTO Patients (Doctorname, Patientname, Diagnosis)
VALUES ('$doctor', '$patient', '$diag')"; 

if ($conn->query($sql) === TRUE) {
	//Commented out, for testing : 
	//echo "New record created";
	$regsuccessfulfile = file_get_contents('patient-profile-created.html');
	echo $regsuccessfulfile;
} 
else {
	//Specific sql error (commented out) : 
    //echo "<br />Error: " . $sql . "<br />" . $conn->error;
   
    $regunsuccessfulfile = file_get_contents('patient-profile-not-created.html');
	echo $regunsuccessfulfile;
}
}

$conn->close();

?>