<?php
session_start();

?>
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Create</title>


  <!-- Favicon : -->
  <link rel='shortcut icon' href='http://www.michael-r-oneill.ie/assesspatients/favicon.ico'>

<?php
//If a doctor has tried to modify details for a patient who he/she hasn't diagnosed yet, their name will then be displayed in a placeholder :
$anewpatient = $_SESSION["newpatientfordoctor"]; 

//If the user is already logged in : 
if (isset($_SESSION['loggedinuser']))
{
$liu = $_SESSION['loggedinuser'];
//Display their username, with the opton of logging out : 
 echo "$liu<br />
          <a href = 'http://www.michael-r-oneill.ie/assesspatients/Login/loggedout.php'>Logout</a>";

//Echo page allowing logged in user to create a patient profile = 
echo 
"

  
  <!-- Enable Boostrap library : -->
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js'></script>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
  
  <!--Custom CSS file : --> 
  <link href='http://www.michael-r-oneill.ie/assesspatients/Stylesheet/stylesheet.css' rel='stylesheet' type='text/css'>

</head>



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

    <!-- Putt the main chunk of each page in this div ('col-md-4') : -->
    <div class='col-md-4'>
<!-- *********************************************************************** : -->
	<h4>Create patient profile</h4>
 <form action='creating.php' method='post' name='createform'>
 <fieldset>
  <legend>Patient :</legend>
  Patient Name:<br />
  <input type='text' name='patientname'
  title='Patient name cannot be blank.'
  required pattern='.{1,}'
  placeholder = '$anewpatient'
  ><br />
  Diagnosis:<br />
  <input type='text' name='diagnosis'
  title='Diagnosis cannot be blank.'
  required pattern='.{1,}'
  ><br /><br />
  <input type='submit' />
 </fieldset>
</form>
<!-- *********************************************************************** : -->
    </div>

    </div>
</div>



</body>


</html>

";


}

//If the user is not logged in, prompt them to do so : 
else
{
echo 
"
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
  
</head>



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

    <!-- Putt the main chunk of each page in this div ('col-md-4') : -->
    <div class='col-md-4'>
<!-- *********************************************************************** : -->
	<p>You are not authorized to use this page.</p>
	<p>Please log in first</p>
<!-- *********************************************************************** : -->
    </div>

    </div>
</div>



</body>


</html>

";
}

?>
