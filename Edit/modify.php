<?php

session_start();
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Modify</title>

  <!-- Favicon : -->
  <link rel='shortcut icon' href='http://www.michael-r-oneill.ie/assesspatients/favicon.ico'>
<?php

//The doctor is the logged in user : 
$doctor = $_SESSION["loggedinuser"]; 

//As usual, display their username, with the opton of logging out : 
echo "$doctor<br />
<a href = 'http://www.michael-r-oneill.ie/assesspatients/Login/loggedout.php'>Logout</a>";

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

//Collect the doctor (who diagnosed this patient), patient and diagnosis session variables : 
$doctorwho_d_t_p = $_SESSION["docname"];
$patientname = $_SESSION["patientname"]; 
$diagnosisname = $_SESSION["diagnosisname"];

//If the patient has been diagnosed by this doctor (the logged in user), allow them to modify the patient details : 
if ($doctor == $doctorwho_d_t_p)
{
	echo "


  <!-- Enable Boostrap library : -->
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
  
    <!--Custom CSS file : --> 
  <link href='http://www.michael-r-oneill.ie/assesspatients/Stylesheet/stylesheet.css' rel='stylesheet' type='text/css'>

<body>
	<div class='container'>
  <div class='jumbotron'>
    <h1>Assesspatients</h1>      
  </div>

<div class='row'>    
    <div class='col-md-3'>
    <ul class='nav nav-pills nav-stacked'>
        <li><a href='http://www.michael-r-oneill.ie/assesspatients/index.php'>Home</a></li>
        <li><a href='http://www.michael-r-oneill.ie/assesspatients/Register/register.php'>Register</a></li>
        <li><a href='http://www.michael-r-oneill.ie/assesspatients/Login/login.php'>Login</a></li>
        <li class='dropdown active'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Edit <span class='caret'></span></a>
          <ul class='dropdown-menu' role='menu'>
            <li><a href='http://www.michael-r-oneill.ie/assesspatients/Edit/create.php' data-toggle='tooltip' title='Create a patient profile'>
              <!-- Create Image Button : -->
              <img class ='editbuttons' src='http://www.michael-r-oneill.ie/assesspatients/Images/create.png'>Create
            </a></li>
            <li class='divider'></li>
            <li><a href='http://www.michael-r-oneill.ie/assesspatients/Edit/view.php' data-toggle='tooltip' title='View patient profile'>
              <!-- View Image Button : -->
              <img class ='editbuttons' src='http://www.michael-r-oneill.ie/assesspatients/Images/view.png'>View
            </a></li>
          </ul>
        </li>
      </ul>
      </div>

    <!-- Putt the main chunk of each page in this div ('col-md-8') : -->
    <div class='col-md-8'>
<!-- *********************************************************************** : -->

<form role='form' action='modifying.php' method='post'>
    <div class='form-group'>
      <label for='diagnosis'>Change diagnosis for $patientname:</label>
      <input name = 'newdiagnosis' type='text' class='form-control' placeholder='$diagnosisname'
      title='Diagnosis cannot be blank.'
  		required pattern='.{1,}'>
    </div>
    <button type='submit' class='btn btn-default'>Submit</button>
  </form>
</div>

<!-- *********************************************************************** : -->
    </div>
    </div>
</div>
	";
}
//If the logged in doctor is not the same doctor who diagnosed this patient, they can not alter their details : 
else
{
	echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Create</title>

  <!-- Enable Boostrap library : -->
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
  
    <!--Custom CSS file : --> 
  <link href='http://www.michael-r-oneill.ie/assesspatients/Stylesheet/stylesheet.css' rel='stylesheet' type='text/css'>

<body>
	<div class='container'>
  <div class='jumbotron'>
    <h1>Assesspatients</h1>      
  </div>

<div class='row'>    
    <div class='col-md-3'>
    <ul class='nav nav-pills nav-stacked'>
        <li><a href='http://www.michael-r-oneill.ie/assesspatients/index.php'>Home</a></li>
        <li><a href='http://www.michael-r-oneill.ie/assesspatients/Regiester/register.php'>Register</a></li>
        <li><a href='http://www.michael-r-oneill.ie/assesspatients/Login/login.php'>Login</a></li>
        <li class='dropdown active'>
          <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>Edit <span class='caret'></span></a>
          <ul class='dropdown-menu' role='menu'>
            <li><a href='http://www.michael-r-oneill.ie/assesspatients/Edit/create.php' data-toggle='tooltip' title='Create a patient profile'>
              <!-- Create Image Button : -->
              <img class ='editbuttons' src='http://www.michael-r-oneill.ie/assesspatients/Images/create.png'>Create
            </a></li>
            <li class='divider'></li>
            <li><a href='http://www.michael-r-oneill.ie/assesspatients/Edit/view.php' data-toggle='tooltip' title='View patient profile'>
              <!-- View Image Button : -->
              <img class ='editbuttons' src='http://www.michael-r-oneill.ie/assesspatients/Images/view.png'>View
            </a></li>
          </ul>
        </li>
      </ul>
      </div>

    <!-- Putt the main chunk of each page in this div ('col-md-8') : -->
    <div class='col-md-8'>
<!-- *********************************************************************** : -->

<p>You cannot edit the details of $doctorwho_d_t_p for $patientname. To submit your own diagnosis for this patient, click <a href='http://www.michael-r-oneill.ie/assesspatients/Edit/create-for-this-patient.php'>here</a>.</p>

<!-- *********************************************************************** : -->
    </div>
    </div>
</div>
	"; 
}







echo "

";

$conn->close();
?>