<?php
//Start the session : 
session_start();

//If the user is already logged in, welcome them : 
if (isset($_SESSION['loggedinuser']))
{
    $liu = $_SESSION['loggedinuser'];
    //Display their username, with the opton of logging out : 
       echo "$liu<br />
          <a href = 'http://www.michael-r-oneill.ie/assesspatients/Login/loggedout.php'>Logout</a>";

//Tell them they've already registered : 
$alreadyregistered = file_get_contents('alreadyregistered.html');
echo $alreadyregistered;
}

//Otherwise, display the registration page : 
else
{
$regpage = file_get_contents('register.html');
echo $regpage;
}



?>