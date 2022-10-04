<?php
include('connection.php');
class Role
{
    protected $permissions;

    protected function __construct() {
        $this->permissions = array();
    }

    // return a role object with associated permissions
    public static function getRolePerms($role_id) {
        $role = new Role();
        global $con;
        $sql = "SELECT t2.perm_desc FROM role_perm as t1
                JOIN permissions as t2 ON t1.perm_id = t2.perm_id
                WHERE t1.role_id = '$role_id'";
        $sth = mysqli_query($con, $sql);
        while($rows = mysqli_fetch_row($sth)) {
            $role->permissions[$rows[0]] = true;
        }
        return $role;
    }

    // check if a permission is set
    public function hasPerm($permission) {
        return isset($this->permissions[$permission]);
    }
    // insert a new role
    public static function insertRole($role_name) {
        global $con;
        $sql = "INSERT INTO roles (role_name) VALUES (?)";
        $sth = $con->prepare($sql);
        $sth->bind_param("s", $role_name);
        return $sth->execute();
    }

    // insert array of roles for specified user id
    public static function insertUserRoles($user_id, $roles) {
        global $con;
        $sql = "INSERT INTO user_role (id, role_id) VALUES (?, ?)";
        $sth = $con->prepare($sql);
        $sth->bind_param("ss", $user_id, $role_id);
        foreach ($roles as $role_id) {
            $sth->execute();
        }
        return true;
    }

    // delete array of roles, and all associations
    public static function deleteRoles($roles) {
        global $con;
        $sql = "DELETE t1, t2, t3 FROM roles as t1
            JOIN user_role as t2 on t1.role_id = t2.role_id
            JOIN role_perm as t3 on t1.role_id = t3.role_id
            WHERE t1.role_id = ?";
        $sth = $con->prepare($sql);
        $sth->bind_param("i", $role_id);
        foreach ($roles as $role_id) {
            $sth->execute();
        }
        return true;
    }
    
    public static function deleteRole($role) {
        global $con;
        $sql = "DELETE t1, t3 FROM roles as t1
            JOIN role_perm as t3 on t1.role_id = t3.role_id
            WHERE t1.role_id = $role";
        $sth = $con->prepare($sql);
        $sth->execute();
        return $sql;
    }

    // delete ALL roles for specified user id
    public static function deleteUserRoles($user_id) {
        global $con;
        $sql = "DELETE FROM user_role WHERE id = ?";
        $sth = $con->prepare($sql);
        $sth->bind_param("s", $user_id);
        return $sth->execute();
    }
    public static function addRolePermission($role_name, $permission_name) {
        global $con;
        if(strcmp($permission_name, "addUser")==0)
        {
            $sql = "select * from permissions where perm_desc = '$permission_name'";
        }
        
        $sth = $con->prepare($sql);
        $sth->bind_param("s", $user_id);
        return $sth->execute();
    }
}
?>