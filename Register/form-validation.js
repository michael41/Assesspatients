function validateForm() {
    
    //Create the variables which with store the values from the form : 
    var username = document.forms["createuserform"]["username"].value;
    var password1 = document.forms["createuserform"]["pwd1"].value;
    var password2 = document.forms["createuserform"]["pwd2"].value;
    var email = document.forms["createuserform"]["email"].value;

    //Make sure the username, email address and passwords aren't blank (for older browsers where HTML5 doesn't work) : : 
    if  (username == null || username == "") 
         {
          alert("Please enter your username");
          return false;
         }
    if  (password1 == null || password1 == "") 
         {
          alert("Please enter your password");
          return false;
         }
    if  (password2 == null || password2 == "") 
         {
          alert("Please re-enter your password");
          return false;
         }
    if  (email == null || email == "") 
         {
          alert("Please enter your email address");
          return false;
         }

    //Find any letter, number or the underscore character (\w)
    charcheck = /^\w+$/;
    //So now, if the username contains strange symbols, like * for example, show error : 
    if  (!charcheck.test(username)) {
      alert("Error: Username must contain only letters, numbers and underscores!");
      return false;
    }

    //Make sure the password is different to the username : 
    if(username == password1) {
        alert("Error: Password must be different from Username!");
        return false;
      }

    //Make sure the password length is less than 6 characters (for older browsers where HTML5 doesn't work) :
      if(password1.length < 6) {
        alert("Error: Password must contain at least six characters!");
        return false;
      }

    //Make sure the password contains a digit (for older browsers where HTML5 doesn't work) :
      re = /[0-9]/;
      if(!re.test(password1)) {
        alert("Error: password must contain at least one number (0-9)!");
        return false;
      }

    //Make sure the password contains lower case characters (for older browsers where HTML5 doesn't work) :
      re = /[a-z]/;
      if(!re.test(password1)) {
        alert("Error: password must contain at least one lowercase letter (a-z)!");
        return false;
      }

      //Make sure the password contains upper case characters (for older browsers where HTML5 doesn't work) :
      re = /[A-Z]/;
      if(!re.test(password1)) {
        alert("Error: password must contain at least one uppercase letter (A-Z)!");
        return false;
      }

      //If both passwords are equal, and are not blank, return true. If not, prompt user to match passwords : 
      if(password1 != "" && password1 == password2) {
        return true;
      }
      else{alert("Please make sure your passwords match"); return false;}
}

function test()
{ 
  alert("Delete the diagnosis for this patient?"); 
  /*
  if (confirm("Delete Account?"))
  {return true;}
  else
  {return false;}*/
}