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

        $channel = new Zend_Feed_Rss('http://www.prisonplanet.com/feed.rss');
        foreach ($channel as $item) {
           $this->view->feeds []= $item;
        }
    }
}
?>
