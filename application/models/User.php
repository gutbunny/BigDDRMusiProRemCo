<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of User
 * @copyright  Copyright Aug 11, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 11, 2011
 * gutbunny@gmail.com
 * 
 */
class Application_Model_User {

    private function connectDB() {
        $application = new Zend_Application(
            APPLICATION_ENV,
            APPLICATION_PATH . '/configs/application.ini'
        );
        $bootstrap = $application->getBootstrap();
        $bootstrap->bootstrap('db');
        $this->db = $bootstrap->getResource('db');
    }

    public function indexAction()
    {
        // action body
    }

    public function saveUser($data) {
        
        $this->connectDB();
        $this->db->insert('gb_users', $data);
        // now create an upload directory for this user
        return mkdir('/homepages/36/d378030953/htdocs/school/public/users/' . $data['gb_users_email']);
        

    }

    public function updateUser($data) {

    }

    public function loginUser($email, $password){

        $this->connectDB();
        $tmp_usr = $this->db->fetchRow("select * from gb_users where gb_users_email = '".$email."'");
        if(md5($password) == $tmp_usr['gb_users_password']) {
            session_start();
            $cookie = new Zend_Http_Cookie('email' , $email , ".bigdaddydeathray.com");
            setcookie('email', $email);
            $_SESSION['email'] = $email;
            if($_SESSION['email'] != '') {
                return "Thank you. You are logged in, click here to return";
            }
        }

        return "Incorrect Email or Password!";

    }

    public function loadUser() {
        $this->connectDB();
        session_start();
        $user = $this->db->fetchRow("select * from gb_users where gb_users_email = '".trim($_SESSION['email'])."'");
        
        if(sizeof($user) > 0) {

            // Now load any and all project data for this user
            $projects_sql = "select p.*, ptu.*
                        from gb_projects p, gb_projects_to_users ptu
                        where ptu.gb_users_id = " . $user['gb_users_id'] . "
                        and ptu.gb_projects_id = p.gb_projects_id";
            $projects = $this->db->fetchAll($projects_sql);
            foreach($projects as $key=>$val) {
                $branches_sql = "select * from gb_projects_branches where gb_projects_id = " . $projects[$key]['gb_projects_id'];
                $branches = $this->db->fetchAll($branches_sql);
                $projects[$key]['branches'] = $branches;
            }

            $user['projects'] = $projects;
            return $user;
        }
        return "User not logged in.";
    }
}
?>
