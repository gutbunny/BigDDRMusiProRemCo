<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of TestformController
 * @copyright  Copyright Aug 10, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 10, 2011
 * gutbunny@gmail.com
 * 
 */
class Application_Form_User extends Zend_Form {

    public function getUserForm($action)
    {
        $usermodel = new Application_Model_User();
        $user = $usermodel->loadUser();
        
        $form = new Zend_Form;

        $form->setAction($action)
             ->setMethod('post')
             ->setName('shepform')
             ->setDescription('Why do we need a description of the form? Where does this appear?');
        $form->setAttrib('sitename', "Shep's School");

        // Add Form Elements
        $form->addElement('text', 'gb_users_firstname');
        $fnElement = $form->getElement('gb_users_firstname');
        $fnElement->setLabel('First Name');
        $fnElement->setAttrib('style', 'display:inline;');
        $fnElement->setValue($user['gb_users_firstname']);
        $fnElement->setRequired(true);

        $form->addElement('text', 'gb_users_lastname');
        $lnElement = $form->getElement('gb_users_lastname');
        $lnElement->setLabel('Last Name');
        $lnElement->setValue($user['gb_users_lastname']);
        $lnElement->setAttrib('style', 'display:inline;');

        $form->addElement('text', 'gb_users_email');
        $emailElement = $form->getElement('gb_users_email');
        $emailElement->setLabel('Email Address');
        $emailElement->setValue($user['gb_users_email']);

        $form->addElement('password', 'gb_users_password');
        $pwdElement = $form->getElement('gb_users_password');
        $pwdElement->setLabel('Password');

        $form->addElement('password', 'confirm_password');
        $pwdElement = $form->getElement('confirm_password');
        $pwdElement->setLabel('Confirm Password');

        // Add Last Element - Submit Button
        $form->addElement('submit', 'save');
        $submitElement = $form->getElement('save');
        $submitElement->setLabel('Save My Stuff');

        return $form;

    }




}
?>
