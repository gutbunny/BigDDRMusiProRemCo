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
        $this->_redirector = $this->_helper->getHelper('Redirector');

        // Set the default options for the redirector
        // Since the object is registered in the helper broker, these
        // become relevant for all actions from this point forward
        $this->_redirector->setCode(303)
                          ->setExit(false)
                          ->setGotoSimple("loginpage",
                                          "user");

        //set up contextSwitch for AJAX requests
        $contextSwitch = $this->_helper->getHelper('contextSwitch');
        $contextSwitch->addActionContext('edituser', 'json')
                        ->initContext();
    }

    

    public function indexAction()
    {

    }

    public function loadSession() {
        session_start();
        $this->usermodel = new Application_Model_User();
        $user = $this->usermodel->loadUser();
        //$this->view->sanity = "\$_SERVER['REQUEST_URI'] = " . $_SERVER['REQUEST_URI'];
        $this->view->user = $user;
        //$this->view->user = 'debug output';
        if( (   $_SESSION['email'] == 'logout'
                || !$_SESSION['email'])
            && !strstr($_SERVER['REQUEST_URI'], 'logout')
            && !strstr($_SERVER['REQUEST_URI'], 'login')
            && !strstr($_SERVER['REQUEST_URI'], 'addnewuser')
            && !strstr($_SERVER['REQUEST_URI'], 'sandbox')
            && !strstr($_SERVER['REQUEST_URI'], 'ajax')
            && $_SERVER['REQUEST_URI'] != '/'
        ) {
            
            header('Location: /user/loginpage');
            exit;
        }
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

            $invite = $this->_request->getParam("gb_users_invite_code");
            //$this->usermodel->checkInvite($invite, $email);

            //$this->view->stuff = $this->usermodel->saveUser($data);

        } else {
            $form_obj = new Application_Form_User();
            $form = $form_obj->getSignupForm('/user/addnewuser');
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

    public function loginpageAction() {

        $form_obj = new Application_Form_User();
        $form = $form_obj->getLoginForm();
        $this->view->form = $form;
    }

}
?>
