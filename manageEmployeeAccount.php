<?php
    include('connection.php');
    include('Role.php');
    include('PrivilegedUser.php');
    session_start(); 
    if(!isset($_SESSION['use']))                  
    {
        $message = "Your session expired!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header("Location: index.php");
    }   
    $userID = $_SESSION['use'];

    $u = PrivilegedUser::getByUserID($userID);
    if(!$u->hasPrivilege("addEmployee")||!$u->hasPrivilege("editEmployee")||!$u->hasPrivilege("deleteEmployee"))
    {
        $message = "Your don't have permission!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        header("Location: index.php");
    }

    echo "<h1>Hello ".$_SESSION['use']."</h1>";
?>
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
        table{
        border-collapse:collapse;
        border:1px solid #000000;
    }

    table td{
    border:1px solid #000000;
    }
    table th{
    border:1px solid #000000;
    }
        </style>
    </head>
<body>
<button onclick="document.location='homepage.php'">Home</button>
<h2>Add employee account</h2>
<form action="/manageEmployee_action.php" onsubmit = "return validation()" method="post">

        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required><br>

        <label for="psw"><b>Password</b></label>
        <input type="password" id="psw" placeholder="Enter password" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
        title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>

        <label for="repsw"><b>Re-Enter Password</b></label>
        <input type="Password" id="repsw" placeholder="Re-Enter your password" name="repsw" required><br>

        <label for="email"><b>Email address</b></label>
        <input type="email" placeholder="Enter your email address" name="email" required><br>

        <label for="tel"><b>Phone number</b></label>
        <input type="tel" placeholder="Enter your phone number" name="tel"><br>

        <label for="addr"><b>Address</b></label>
        <input type="text" placeholder="Enter your address" name="addr"><br>
        
        <button type="submit">Create</button>
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
    <hr>
    <h2>List all employee</h2>
    <form action="/rolemanagement_action.php" method="post">
        <table id="Table1">
            <tr>
                <th>Delete</th>
                <th>Account</th>
                <th>Email</th>
                <th>Tel</th>
                <th>Address</th>
                <th>Role</th>
            </tr>
            <?php
                // LOOP TILL END OF DATA
                $sql = "select users.id, users.email, users.tel, users.addr from users inner join user_role on users.id = user_role.id where user_role.role_id = 6";
                $sth = mysqli_query($con, $sql);

                while($rows=mysqli_fetch_row($sth))
                {
            ?>
            <tr>
                <td><input type="checkbox" name="checkbox"></td>
                <td><?php echo $rows[0];?></td>
                <td><?php echo $rows[1];?></td>
                <td><?php echo $rows[2];?></td>
                <td><?php echo $rows[3];?></td>
                <td>Employee</td>
            </tr>
            <?php
                }
            ?>
        </table>
            <input type="button" value="Update" onclick="GetSelected()" />
  </form>
  <script type="text/javascript">
            function GetSelected() {
                //Reference the Table.
                var grid = document.getElementById("Table1");
    
                //Reference the CheckBoxes in Table.
                var checkBoxes = grid.getElementsByTagName("INPUT");
 
                //Loop through the CheckBoxes.
                var i = 0;

                while(i<checkBoxes.length){
                    var message = "";
                    if(checkBoxes[i].checked){
                        message = "";
                        message+="delete"
                        var row = checkBoxes[i].parentNode.parentNode;
                        message+="?";
                        message+=row.cells[1].innerHTML;
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                alert(this.responseText);
                                location.reload();
                            }
                        };
                        xmlhttp.open("GET", "deleteEmployee_action.php?q="+message, true);
                        xmlhttp.send();
                    }
                    i++;
                }
            }
        </script>


    
</body>
</html>
