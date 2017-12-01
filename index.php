<?php
//Start the session : 
session_start();

//If the user is already logged in, welcome them : 
if (isset($_SESSION['loggedinuser']))
{
    $liu = $_SESSION['loggedinuser'];
    //Display their username, with the option of logging out : 
    echo "$liu<br />
          <a href = 'http://www.michael-r-oneill.ie/assesspatients/Login/loggedout.php'>Logout</a>";
}

//Either way, display the home page : 
$homepage = file_get_contents('index.html');
echo $homepage;



?>

