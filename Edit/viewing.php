<?php
session_start();
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Viewing Patient</title>

  <!-- Favicon : -->
  <link rel='shortcut icon' href='http://www.michael-r-oneill.ie/assesspatients/favicon.ico'>

<?php
//The doctor is the logged in user : 
$doctor = $_SESSION["loggedinuser"]; 

//As usual, display their username, with the opton of logging out : 
echo "$doctor<br />
<a href = 'http://www.michael-r-oneill.ie/assesspatients/Login/loggedout.php'>Logout</a>";

//The patient name is got from the form in the previous page : 
$patient = $_POST["patientname"];
//It's then stored in a session variable for future use : 
$_SESSION["newpatientfordoctor"] = $patient;

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


//Display the page : 
echo "

  
  <!-- Enable Boostrap library : -->
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
  
    <!--Custom CSS file : --> 
  <link href='http://www.michael-r-oneill.ie/assesspatients/Stylesheet/stylesheet.css' rel='stylesheet' type='text/css'>

<!-- Javascript file for form validation : -->
<script src='form-validation.js' type='text/javascript'></script>


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

    <!-- Putt the main chunk of each page in this div ('col-md-6') : -->
    <div class='col-md-6'>
 <!-- *********************************************************************** : -->
    ";

//Get the data for the patient from the logged-in doctor : 
$sql = 
"SELECT id, Doctorname, Patientname, Diagnosis 
 FROM Patients
 WHERE Patientname = '$patient' AND Doctorname = '$doctor'
";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 //Show the table : 
 echo "
<h4>Your diagnosis : </h4>
<table class ='table'>
  <thead>
      <tr>
        <th>Doctor</th>
        <th>Patient</th>
        <th>Diagnosis</th>
      </tr>
    </thead>
  <tbody>";

    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "

  <tr>
    <td>".$row["Doctorname"]."</td>
    <td>".$row["Patientname"]."</td> 
    <td>".$row["Diagnosis"]."</td>
  </tr>

  ";
 
        //Store the doctor name, patient name and diagnosis in session variables for the next page : 
        $_SESSION["docname"] = $row["Doctorname"];
        $_SESSION["patientname"] = $row["Patientname"];
        $_SESSION["diagnosisname"] = $row["Diagnosis"];
    }


    echo " 
</tbody>
</table>
<!-- *********************************************************************** : -->
";
//*********Showing the diagnosis' from other doctors ***********

//Retrieve the results from the table where the patient name is the patient entered in the search and the doctor is NOT the logged in doctor 
$sql = 
"SELECT id, Doctorname, Patientname, Diagnosis 
 FROM Patients
 WHERE Patientname = '$patient' AND Doctorname != '$doctor'
";
$result = $conn->query($sql);

//Display the results if they are there to show : 
if ($result->num_rows > 0) {
 //Show the table : 
 echo "
<h4 class='dfod'>Diagnosis from other doctors : </h4>
<table class ='table'>
  <thead>
      <tr>
        <th>Doctor</th>
        <th>Patient</th>
        <th>Diagnosis</th>
      </tr>
    </thead>
  <tbody>";

    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "

  <tr>
    <td>".$row["Doctorname"]."</td>
    <td>".$row["Patientname"]."</td> 
    <td>".$row["Diagnosis"]."</td>
  </tr>
  ";
    }
 //end of row loop
  echo "  </tbody>
  </table>";
  }
  //Display the fact there are no results to show : 
  else
    {echo "<p>No results found from other doctors</p>";}
//**********************************************************

echo "
</div>
<form action='modify.php' class='modifyanddeletebuttons'>
<button type='submit' class='btn btn-default'>Modify</button>
</form>
<form action='delete.php' onsubmit='return confirmdelete()'>
<button type='submit' class='btn btn-default'>Delete</button>
</form>

";



} 



//If there is no patient with the said name, doctor is prompted to create a diagnosis for that patient : 
else {
    echo "
<p>You have not entered a disgnosis for $patient. To submit your own diagnosis for this patient, click <a href='http://www.michael-r-oneill.ie/assesspatients/Edit/create-for-this-patient.php'>here</a>.<br />
 To view other doctors' diagnosis of this patient, click <a href= 'http://www.michael-r-oneill.ie/assesspatients/Edit/viewing-all.php'>here</a>.
</p>

";
}




echo "</div></div>"; 
$conn->close();

?>