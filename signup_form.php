<!DOCTYPE html>
<html>
    <head>
        <style>

        /* The message box is shown when the user clicks on the password field */
        #message {
          display:none;
        }
        
        #message p {
            margin:0
        }
        
        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
          color: green;
        }
        
        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
          color: red;
        }
        </style>
    </head>
<body>
<button onclick="document.location='homepage.php'">Home</button>
<h2>Sign up form</h2>

<form action="/signup_action.php" onsubmit = "return validation()" method="post">

        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required><br>

        <label for="psw"><b>Password</b></label>
        <input type="password" id="psw" placeholder="Enter password" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>

        <label for="repsw"><b>Re-Enter Password</b></label>
        <input type="Password" id="repsw" placeholder="Re-Enter your password" name="repsw" required><br>

        <label for="email"><b>Your email address</b></label>
        <input type="email" placeholder="Enter your email address" name="email" required><br>

        <label for="tel"><b>Your phone number</b></label>
        <input type="tel" placeholder="Enter your phone number" name="tel"><br>

        <label for="addr"><b>Your address</b></label>
        <input type="text" placeholder="Enter your address" name="addr"><br>
        
        <button type="submit">Sign up</button>
    </form>

    <div id="message">
        <br>
        <p><b>Password must contain the following:</b></p>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
    </div>

    <script>
        var myInput = document.getElementById("psw");
        var letter = document.getElementById("letter");
        var capital = document.getElementById("capital");
        var number = document.getElementById("number");
        var length = document.getElementById("length");
        
        myInput.onfocus = function() {
          document.getElementById("message").style.display = "block";
        }
        
        // When the user clicks outside of the password field, hide the message box
        myInput.onblur = function() {
          document.getElementById("message").style.display = "none";
        }
        
        // When the user starts to type something inside the password field
        myInput.onkeyup = function() {
          // Validate lowercase letters
          var lowerCaseLetters = /[a-z]/g;
          if(myInput.value.match(lowerCaseLetters)) {  
            letter.classList.remove("invalid");
            letter.classList.add("valid");
          } else {
            letter.classList.remove("valid");
            letter.classList.add("invalid");
          }
          
          // Validate capital letters
          var upperCaseLetters = /[A-Z]/g;
          if(myInput.value.match(upperCaseLetters)) {  
            capital.classList.remove("invalid");
            capital.classList.add("valid");
          } else {
            capital.classList.remove("valid");
            capital.classList.add("invalid");
          }
        
          // Validate numbers
          var numbers = /[0-9]/g;
          if(myInput.value.match(numbers)) {  
            number.classList.remove("invalid");
            number.classList.add("valid");
          } else {
            number.classList.remove("valid");
            number.classList.add("invalid");
          }
          
          // Validate length
          if(myInput.value.length >= 8) {
            length.classList.remove("invalid");
            length.classList.add("valid");
          } else {
            length.classList.remove("valid");
            length.classList.add("invalid");
          }
        }

        var password = document.getElementById("psw")
        var confirm_password = document.getElementById("repsw");

        function validatePassword(){
          if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
          } else {
            confirm_password.setCustomValidity('');
          }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
    </script>
</body>
</html>
