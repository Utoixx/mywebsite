<?php
include('connection.php');
include('User.php');
class PrivilegedUser extends User
{
    private $roles;

    public function __construct() {
        parent::__construct();
    }

    // override User method
    public static function getByUserID($id) {
        global $con;
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $sth = mysqli_query($con, $sql);
        $result = mysqli_fetch_row($sth);


        if (!empty($result)) {
            $privUser = new PrivilegedUser();
            $privUser->id = $id;
            $privUser->email = $result[2];
            $privUser->tel = $result[3];
            $privUser->addr = $result[4];
            $privUser->initRoles();
            return $privUser;
        } else {
            return false;
        }
    }

    // populate roles with their associated permissions
    protected function initRoles() {
        global $con;
        $this->roles = array();
        $sql = "SELECT t1.role_id, t2.role_name FROM user_role as t1
                JOIN roles as t2 ON t1.role_id = t2.role_id
                WHERE t1.id = '$this->id'";
        $sth = mysqli_query($con, $sql);
        while($row = mysqli_fetch_row($sth)) {
            $this->roles[$row[0]] = Role::getRolePerms($row[0]);
        }
    }

    // check if user has a specific privilege
    public function hasPrivilege($perm) {
        foreach ($this->roles as $role) {
            if ($role->hasPerm($perm)) {
                return true;
            }
        }
        return false;
    }
    // check if a user has a specific role
    public function hasRole($role_name) {
        return isset($this->roles[$role_name]);
    }

    // insert a new role permission association
    public static function insertPerm($role_id, $perm_id) {
        global $con;
        $sql = "INSERT INTO role_perm (role_id, perm_id) VALUES (:role_id, :perm_id)";
        $sth = $con->prepare($sql);
        $sth->bind_param("ii", $role_id,  $perm_id);
        return $sth->execute();
    }

    // delete ALL role permissions
    public static function deletePerms() {
        global $con;
        $sql = "TRUNCATE role_perm";
        $sth = $con->prepare($sql);
        return $sth->execute();
    }
}
?>