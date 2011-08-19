<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of AdminController
 * @copyright  Copyright Aug 18, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 18, 2011
 * gutbunny@gmail.com
 * 
 */
class AdminController extends Zend_Controller_Action {

    public function init()
    {
        /* Initialize action controller here */
        $this->view->title = "Administer";
    }

    public function indexAction()
    {

        //$this->view->debug = $this->view->smtpsettings;
    }

    public function inviteuserAction() {

        //process the invitation form
        if($this->_request->isPost()){

            $email    = $this->_request->getParam("gb_users_invite_email");

            $inviteCode = str_replace('3', 'E', str_replace('4', 'A', microtime()));
            //store invite code and email in database
            $adminModel = new Application_Model_Admin();
            $this->view->debug = $adminModel->saveInvite($email, $inviteCode);
       // send invite email
            $emailBody = "You have been invited to join Big Daddy Death Ray's Music Project Remote Collaboratorizer. \n\r";
            $emailBody .= "Click this link to confirm and signup:\n\r";
            $emailBody .= "<a href='http://bigdaddydeathray.com/user/addnewuser?inviteCode=" . urlencode($inviteCode) . "' target='_blank'>CONFIRM AND SIGNUP</a>";

            $mail = new Zend_Mail();
            $mail->setFrom('shep@bigdaddydeathray.com', 'BigDDRMusiProRemCo Administrator');
            $mail->addTo($email);
            $mail->setSubject("Invitation from BigDDRMusiProRemCo");
            $mail->setBodyText($emailBody);
            if($mail->send()) {
                $this->view->message = "Invitation email sent to " . $email;
            }



        }
        //show the invitation form
        $this->adminform = new Application_Form_Admin();
        $this->view->form = $this->adminform->getInviteForm();

    }

}
?>
