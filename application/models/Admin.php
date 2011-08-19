<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of Application_Model_Admin
 * @copyright  Copyright Aug 19, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 19, 2011
 * gutbunny@gmail.com
 * 
 */
class Application_Model_Admin {

    private function connectDB() {
        $application = new Zend_Application(
            APPLICATION_ENV,
            APPLICATION_PATH . '/configs/application.ini'
        );
        $bootstrap = $application->getBootstrap();
        $bootstrap->bootstrap('db');
        $this->db = $bootstrap->getResource('db');
    }

    public function saveInvite($email, $inviteCode) {

        $this->connectDB();
        $data = array('gb_users_invite_email' => $email, 'gb_users_invite_code' => $inviteCode);
        $this->db->insert('gb_users_invites', $data);
        //$sql = "insert into gb_users_invites (gb_users_invite_email, gb_users_invite_code) values ('".$email."', '".$inviteCode."')";
        //return $this->db->lastInsertId();
        return true;
    }

        public function indexAction()
    {
        // action body
    }
}
?>
