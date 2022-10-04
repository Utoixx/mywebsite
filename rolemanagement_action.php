<?php
    include('Role.php');
    include('connection.php');

    $cmdDelete = "delete";
    $cmdModify = "modify";

    $q = $_REQUEST["q"];
    $str = explode("?", $q);
    if(strcmp($str[0], $cmdDelete) === 0)
    {
       $sql = "select * from roles where role_name = '$str[1]'";
       $result = mysqli_query($con, $sql);  
       $row = mysqli_fetch_row($result);
       Role::deleteRole($row[0]);
       echo "Sucess!";
    }
    if(strcmp($str[0], $cmdModify) === 0)
    {
       $sql = "select * from roles where role_name = '$str[1]'";
       $result = mysqli_query($con, $sql);  
       $row = mysqli_fetch_row($result);
       $role_id = $row[0];

        if(strcmp($str[2], "true") === 0)
        {
            $addEmployee = true;
        }else
        {
            $addEmployee = false;
        }

        if(strcmp($str[3], "true") === 0)
        {
            $editEmployee = true;
        }else
        {
            $editEmployee = false;
        }

        if(strcmp($str[4], "true") === 0)
        {
            $deleteEmployee = true;
        }else
        {
            $deleteEmployee = false;
        }

        ///////////
        if(strcmp($str[5], "true") === 0)
        {
            $addUser = true;
        }else
        {
            $addUser = false;
        }

        if(strcmp($str[6], "true") === 0)
        {
            $editUser = true;
        }else
        {
            $editUser = false;
        }

        if(strcmp($str[7], "true") === 0)
        {
            $deleteUser = true;
        }else
        {
            $deleteUser = false;
        }
        /////////
        if(strcmp($str[8], "true") === 0)
        {
            $addRole = true;
        }else
        {
            $addRole = false;
        }

        if(strcmp($str[9], "true") === 0)
        {
            $editRole = true;
        }else
        {
            $editRole = false;
        }

        if(strcmp($str[10], "true") === 0)
        {
            $deleteRole = true;
        }else
        {
            $deleteRole = false;
        }

        //
        if(strcmp($str[11], "true") === 0)
        {
            $approveSuvey = true;
        }else
        {
            $approveSuvey = false;
        }
        if(strcmp($str[12], "true") === 0)
        {
            $enableUserAccount = true;
        }else
        {
            $enableUserAccount = false;
        }

        $roles = Role::getRolePerms($role_id);
        
        if($roles->hasPerm("addEmployee")!=$addEmployee)
        {
            $sql = "select * from permissions where perm_desc = 'addEmployee'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            $perm_id = $row[0];

            if($addEmployee)
            {
                $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)";
                $result = mysqli_query($con, $sql);
            }
            else
            {
                $sql = "delete from role_perm where role_id = '$role_id' and perm_id = '$perm_id'";
                $result = mysqli_query($con, $sql);
            }
        }

        if($roles->hasPerm("editEmployee")!=$editEmployee)
        {
            $sql = "select * from permissions where perm_desc = 'editEmployee'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            $perm_id = $row[0];

            if($editEmployee)
            {
                $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)";
                $result = mysqli_query($con, $sql);
            }
            else
            {
                $sql = "delete from role_perm where role_id = '$role_id' and perm_id = '$perm_id'";
                $result = mysqli_query($con, $sql);
            }
        }

        if($roles->hasPerm("deleteEmployee")!=$deleteEmployee)
        {
            $sql = "select * from permissions where perm_desc = 'deleteEmployee'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            $perm_id = $row[0];

            if($deleteEmployee)
            {
                $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)";
                $result = mysqli_query($con, $sql);
            }
            else
            {
                $sql = "delete from role_perm where role_id = '$role_id' and perm_id = '$perm_id'";
                $result = mysqli_query($con, $sql);
            }
        }
        //////////////////////
        if($roles->hasPerm("addUser")!=$addUser)
        {
            $sql = "select * from permissions where perm_desc = 'addUser'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            $perm_id = $row[0];

            if($addUser)
            {
                $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)";
                $result = mysqli_query($con, $sql);
            }
            else
            {
                $sql = "delete from role_perm where role_id = '$role_id' and perm_id = '$perm_id'";
                $result = mysqli_query($con, $sql);
            }
        }

        if($roles->hasPerm("editUser")!=$editUser)
        {
            $sql = "select * from permissions where perm_desc = 'editUser'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            $perm_id = $row[0];

            if($editUser)
            {
                $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)";
                $result = mysqli_query($con, $sql);
            }
            else
            {
                $sql = "delete from role_perm where role_id = '$role_id' and perm_id = '$perm_id'";
                $result = mysqli_query($con, $sql);
            }
        }

        if($roles->hasPerm("deleteUser")!=$deleteUser)
        {
            $sql = "select * from permissions where perm_desc = 'deleteUser'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            $perm_id = $row[0];

            if($deleteUser)
            {
                $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)";
                $result = mysqli_query($con, $sql);
            }
            else
            {
                $sql = "delete from role_perm where role_id = '$role_id' and perm_id = '$perm_id'";
                $result = mysqli_query($con, $sql);
            }
        }
        if($roles->hasPerm("addRole")!=$addRole)
        {
            $sql = "select * from permissions where perm_desc = 'addRole'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            $perm_id = $row[0];

            if($addRole)
            {
                $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)";
                $result = mysqli_query($con, $sql);
            }
            else
            {
                $sql = "delete from role_perm where role_id = '$role_id' and perm_id = '$perm_id'";
                $result = mysqli_query($con, $sql);
            }
        }

        if($roles->hasPerm("editRole")!=$editRole)
        {
            $sql = "select * from permissions where perm_desc = 'editRole'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            $perm_id = $row[0];

            if($editRole)
            {
                $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)";
                $result = mysqli_query($con, $sql);
            }
            else
            {
                $sql = "delete from role_perm where role_id = '$role_id' and perm_id = '$perm_id'";
                $result = mysqli_query($con, $sql);
            }
        }

        if($roles->hasPerm("deleteRole")!=$deleteRole)
        {
            $sql = "select * from permissions where perm_desc = 'deleteRole'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_row($result);
            $perm_id = $row[0];

            if($deleteRole)
            {
                $sql = "insert into role_perm(role_id, perm_id) values($role_id, $perm_id)";
                $result = mysqli_query($con, $sql);
            }
            else
            {
                $sql = "delete from role_perm where role_id = '$role_id' and perm_id = '$perm_id'";
                $result = mysqli_query($con, $sql);
            }
        }
        ////////////////////
        echo "Success!";
        
    }
?>