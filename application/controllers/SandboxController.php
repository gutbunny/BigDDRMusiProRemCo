<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of SandboxController
 * @copyright  Copyright Aug 23, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 23, 2011
 * gutbunny@gmail.com
 * 
 */
class SandboxController extends Zend_Controller_Action {

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
            $form_obj = new Application_Form_Sandbox();
            $form = $form_obj->getSandboxForm();
            $this->view->form = $form;
    }
}
?>
