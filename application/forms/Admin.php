<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of Admin
 * @copyright  Copyright Aug 18, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 18, 2011
 * gutbunny@gmail.com
 * 
 */
class Application_Form_Admin extends Zend_Form {

    public function getInviteForm() {
        
        $form = new Zend_Form;
        $form->setAction('/admin/inviteuser')
             ->setMethod('post')
             ->setName('inviteform')
             ->setDescription('Why do we need a description of the form? Where does this appear?');
        $form->setAttrib('sitename', "BigDDRMusiProRemCo");

        $form->addElement('text', 'gb_users_invite_email');
        $emailElement = $form->getElement('gb_users_invite_email');
        $emailElement->setLabel('Email Address To Invite');
        $emailElement->setRequired(true);
        // Add Last Element - Submit Button
        $form->addElement('submit', 'send');
        $submitElement = $form->getElement('send');
        $submitElement->setLabel('Send Invite');
        return $form;
    }
}
?>
