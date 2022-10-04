<!DOCTYPE html>
<html lang="en"> 
<head>
<style type="text/css" media="screen">

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
    <section>
        <h1>Roles Management</h1>
        <form action="/rolemanagement_action.php" method="post">
        <table id="Table1">
            <tr>
                <th>Delete</th>
                <th>Role name</th>
                <th>Add employee</th>
                <th>Edit employee</th>
                <th>Delete employee</th>
                <th>Add user</th>
                <th>Edit user</th>
                <th>Delete user</th>
                <th>Add role</th>
                <th>Edit role</th>
                <th>Delte role</th>
                <th>Enable user account</th>
                <th>Approve survery<th>
            </tr>
            <?php
                // LOOP TILL END OF DATA
                include('connection.php');
                include('Role.php');
                $sql = "select * from roles";
                $sth = mysqli_query($con, $sql);

                while($rows=mysqli_fetch_row($sth))
                {
            ?>
            <tr>
                <td><input type="checkbox" name="checkbox"></td>
                <td><?php echo $rows[1];?></td>
            <?php
                $role = Role::getRolePerms($rows[0]);
            ?>
                <td><input type="checkbox" name="addEmployee" id="addEmployee" value="yes" <?php echo ($role->hasPerm("addEmployee") ? 'checked' : '');?>></td>
                <td><input type="checkbox" name="editEmployee" id="editEmployee" value="yes" <?php echo ($role->hasPerm("editEmployee") ? 'checked' : '');?>></td>
                <td><input type="checkbox" name="deleteEmployee" id="deleteEmployee" value="yes" <?php echo ($role->hasPerm("deleteEmployee") ? 'checked' : '');?>></td>
                <td><input type="checkbox" name="addUser" id="addUser" value="yes" <?php echo ($role->hasPerm("addUser") ? 'checked' : '');?>></td>
                <td><input type="checkbox" name="editUser" id="editUser" value="yes" <?php echo ($role->hasPerm("editUser") ? 'checked' : '');?>></td>
                <td><input type="checkbox" name="deleteUser" id="deleteUser" value="yes" <?php echo ($role->hasPerm("deleteUser") ? 'checked' : '');?>></td>
                <td><input type="checkbox" name="addRole" id="addRole" value="yes" <?php echo ($role->hasPerm("addRole") ? 'checked' : '');?>></td>
                <td><input type="checkbox" name="editRole" id="editRole" value="yes" <?php echo ($role->hasPerm("editRole") ? 'checked' : '');?>></td>
                <td><input type="checkbox" name="deleteRole" id="deleteRole" value="yes" <?php echo ($role->hasPerm("deleteRole") ? 'checked' : '');?>></td>
                <td><input type="checkbox" name="enableUserAccount" id="enableUserAccount" value="yes" <?php echo ($role->hasPerm("enableUserAccount") ? 'checked' : '');?>></td>
                <td><input type="checkbox" name="approveSurvey" id="approveSurvey" value="yes" <?php echo ($role->hasPerm("approveSurvey") ? 'checked' : '');?>></td>
                <td>
            </tr>
            <?php
                }
            ?>
        </table>
            <input type="button" value="Update role" onclick="GetSelected()" />
        </form>
        <hr>
        <form action="/addrole.php" method="post">
            <label for="role_name"><b>Role name</b></label>
            <input type="text" placeholder="Enter role name" name="role_name" required><br>
            <label for="add_employee"><b>Add employee</b></label>
            <input type="checkbox" name="add_employee">
            <label for="edit_employee"><b>Edit employee</b></label>
            <input type="checkbox" name="edit_employee">
            <label for="delete_employee"><b>Delete employee</b></label>
            <input type="checkbox" name="delete_employee"><br>
            <label for="add_user"><b>Add user</b></label>
            <input type="checkbox" name="add_user">
            <label for="edit_user"><b>Edit user</b></label>
            <input type="checkbox" name="edit_user">
            <label for="delete_user"><b>Delete user</b></label>
            <input type="checkbox" name="delete_user"><br>
            <label for="add_role"><b>Add role</b></label>
            <input type="checkbox" name="add_role">
            <label for="edit_role"><b>Edit role</b></label>
            <input type="checkbox" name="edit_role">
            <label for="delete_role"><b>Delete role</b></label>
            <input type="checkbox" name="delete_role"><br>
            <label for="enableUserAccount"><b>Enable user account</b></label>
            <input type="checkbox" name="enable_user_account"><br>
            <label for="approveSurvey"><b>Approve survey</b></label>
            <input type="checkbox" name="approve_surve"><br>
            <button type="submit" name="Add role">Add role</button>
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
                        xmlhttp.open("GET", "rolemanagement_action.php?q="+message, true);
                        xmlhttp.send();
                    }else
                    {
                        message = "";
                        message+="modify"
                        var row = checkBoxes[i].parentNode.parentNode;
                        var role_name = row.cells[1].innerHTML; 
                        message +="?";
                        message+=role_name;
                        var add_employee = row.cells[2].children[0];
                        message +="?";
                        message+=add_employee.checked;
                        var edit_employee = row.cells[3].children[0];
                        message +="?";
                        message+=edit_employee.checked;
                        var delete_employee = row.cells[4].children[0];
                        message +="?";
                        message+=delete_employee.checked;
                        var add_user = row.cells[5].children[0];
                        message +="?";
                        message+=add_user.checked;
                        var edit_user = row.cells[6].children[0];
                        message +="?";
                        message+=edit_user.checked;
                        var delete_user = row.cells[7].children[0];
                        message +="?";
                        message+=delete_user.checked;
                        var add_role = row.cells[8].children[0];
                        message +="?";
                        message+=add_role.checked;
                        var edit_role = row.cells[9].children[0];
                        message +="?";
                        message+=edit_role.checked;
                        var delete_role = row.cells[10].children[0];
                        message +="?";
                        message+=delete_role.checked;
                        var approve_surve = row.cells[11].children[0];
                        message +="?";
                        message+=approve_surve.checked;
                        var enable_user_account = row.cells[12].children[0];
                        message +="?";
                        message+=enable_user_account.checked;
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                alert(this.responseText);
                                location.reload();
                            }
                        };
                        xmlhttp.open("GET", "rolemanagement_action.php?q="+message, true);
                        xmlhttp.send();
                    }
                    i+=12;
                }
            }
        </script>

    </section>
</body>
 
</html>