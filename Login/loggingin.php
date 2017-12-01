<?php
session_start();

//If the user is already logged in, welcome them : 
if (isset($_SESSION['loggedinuser']))
{
    $liu = $_SESSION['loggedinuser'];
    //Display their username, with the option of logging out : 
    echo "$liu<br />
          <a href = 'http://www.michael-r-oneill.ie/assesspatients/Login/loggedout.php'>Logout</a>";
}


//------------------------------------------------------------------------
// FIRST : 
//------------------------------------------------------------------------
//Take the username and password from the form field : 
$user = $_POST["user"];
$pwd = $_POST["pwd"];


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
//Testing : 
//echo "Connection was successful<br />";

//------------------------------------------------------------------------
//MAKE SURE IT'S THE CORRECT USER AND PASSWORD : 
//------------------------------------------------------------------------

//Get the 'hash' from the New Guests table for the user :
$sql = "SELECT Hash FROM MikesGuests WHERE Username = '$user'";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
   //Fetch the row : 
    while($row = $result->fetch_assoc())
    {
     	//Check the pasword they have just entered against the hash.
        //If it matches, then display the logged-in-successful page. 
        //If not, the show the logged-in-unsuccessful page :  
      	$the_hash = $row["Hash"];
        if(crypt($pwd, $the_hash) == $the_hash)
        {
         //Testing : 
         //echo "Password is correct<br />";
        //If correct, log them in. 
    	 $_SESSION["loggedin"] = "yes";
         //Store username in session variable : 
         $_SESSION["loggedinuser"] = $user;
         $_SESSION["test"] = 'test';
        //Get the logged-in-successful page
        //$lisp = file_get_contents('logged-in-successful.html');
        //echo $lisp;
         echo 
"
<!DOCTYPE html>
<html lang='en'>
<head>
  <title>Logged in</title>

  <!-- Favicon : -->
  <link rel='shortcut icon' href='http://www.michael-r-oneill.ie/assesspatients/favicon.ico'>
  
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
        <li class ='active'><a href='http://www.michael-r-oneill.ie/assesspatients/Login/login.php'>Login</a></li>
        <li class='dropdown'>
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
<p>Welcome, $user you are now logged in to the site.</p>
<!-- *********************************************************************** : -->
    </div>

    </div>
</div>



</body>


</html>

";
		}

    	else
    	{//Get the logged-in-unsuccessful page
        $liusp = file_get_contents('login-unsuccessful.html');
        echo $liusp;}        	
    }
} 
else 
	 {
    //Get the logged-in-unsuccessful page
        $liusp = file_get_contents('login-unsuccessful.html');
        echo $liusp;
	 }



$conn->close();


?>

