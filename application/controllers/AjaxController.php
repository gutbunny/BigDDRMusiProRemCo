<?php
/*
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of AjaxController
 * @copyright  Copyright Aug 28, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 28, 2011
 * gutbunny@gmail.com
 *
 */
class AjaxController extends Zend_Controller_Action {

    public function init() {


    }

    public function preDispatch() {
        $this->_helper->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function indexAction() {

        $someVar = $this->_request->getParam('someVar');

        $retStr = "sanity: \$someVar = " . $someVar;

        $this->getResponse()->setHeader('Content-Type', 'text/plain');

        $this->getResponse()->setBody($retStr);
    }


}
?>
