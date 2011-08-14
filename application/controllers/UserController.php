<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of UserController
 * @copyright  Copyright Aug 11, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 11, 2011
 * gutbunny@gmail.com
 * 
 */
class UserController extends Zend_Controller_Action {

    public function _init()
    {
        //$this->view->stuff = "executed _init() in UserController called by Bootstrap _initUser()";

    }

    public function indexAction()
    {

    }

    public function checkSession() {
        $this->usermodel = new Application_Model_User();
        $user = $this->usermodel->loadUser();
        $this->view->user = $user;
    }

    public function edituserAction() {

        if($this->_request->isPost()){

            $email    = $this->_request->getParam("gb_users_email");
            $firstname = $this->_request->getParam("gb_users_firstname");
            $lastname = $this->_request->getParam("gb_users_lastname");
            $password = md5($this->_request->getParam("password"));

            $data = array('gb_users_firstname' => $firstname,
                            'gb_users_lastname' => $lastname,
                            'gb_users_email' => $email,
                            'gb_users_password' => $password);

        } else {
            $form_obj = new Application_Form_User();
            $form = $form_obj->getUserForm('/user/edituser');
            $this->view->form = $form;
        }
    }

    public function addnewuserAction() {
        
        if($this->_request->isPost()){

            $email    = $this->_request->getParam("gb_users_email");
            $firstname = $this->_request->getParam("gb_users_firstname");
            $lastname = $this->_request->getParam("gb_users_lastname");
            $password = md5($this->_request->getParam("gb_users_password"));

            $data = array('gb_users_firstname' => $firstname,
                            'gb_users_lastname' => $lastname,
                            'gb_users_email' => $email,
                            'gb_users_password' => $password);

            $this->usermodel = new Application_Model_User();
            $this->view->stuff = $this->usermodel->saveUser($data);

        } else {
            $form_obj = new Application_Form_User();
            $form = $form_obj->getUserForm('/user/addnewuser');
            $this->view->form = $form;
        }
    }

    public function loginAction() {

        $email    = $this->_request->getParam("gb_users_email");
        $password = $this->_request->getParam("gb_users_password");
        $this->usermodel = new Application_Model_User();
        $this->view->message = $this->usermodel->loginUser($email, $password);
    }

    public function logoutAction() {
        setcookie('email', 'logout');
        session_start();
        $_SESSION['email'] = 'logout';
    }

}
?>
