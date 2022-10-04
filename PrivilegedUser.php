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
        $sql = "SELECT * FROM users WHERE id = :id";
        $sth = $con->prepare($sql);
        $sth->execute(array(":id" => $id));
        $result = $sth->fetchAll();

        if (!empty($result)) {
            $privUser = new PrivilegedUser();
            $privUser->id = $id;
            $privUser->email = $result[0]["email"];
            $privUser->tel = $result[0]["tel"];
            $privUser->addr = $result[0]["addr"];
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
                WHERE t1.id = ?";
        $sth = $con->prepare($sql);
        $sth->bind_param("s", $this->id);
        $sth->execute();

        while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $this->roles[$row["role_name"]] = Role::getRolePerms($row["role_id"]);
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