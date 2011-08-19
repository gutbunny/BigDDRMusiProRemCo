<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of ProjectsController
 * @copyright  Copyright Aug 12, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 12, 2011
 * gutbunny@gmail.com
 * 
 */
class ProjectsController extends Zend_Controller_Action {

    
    public function init()
    {
        global $_SESSION;
        session_start();
        /* Initialize user array here */
        $this->usermodel = new Application_Model_User();
        $this->user = $this->usermodel->loadUser();
        date_default_timezone_set('America/Chicago');

    }

    public function indexAction()
    {

    }

    public function branchAction() {
        $projects_branches_id = $this->_request->getQuery('gb_projects_branches_id');
        $this->projectsmodel = new Application_Model_Projects();
        $this->view->branch = $this->projectsmodel->loadBranch($projects_branches_id, $this->user['gb_users_id']);
        //$this->view->stuff = $this->user;
    }

    public function addtracksAction() {

        $form_obj = new Application_Form_Track();
        $form = $form_obj->getTrackForm();
        if($_POST) {
            if($form->isValid($_POST)) {
                $gb_tracks_name = $form->getValue('gb_tracks_name');
                $gb_projects_branches_id = $form->getValue('gb_projects_branches_id');
                $gb_tracks_filename = $form->getValue('track');
                $gb_tracks_filepath = $form->track->getDestination();
                $form->track->receive();
                //save track data
                $data = array('gb_tracks_name' => $gb_tracks_name,
                            'gb_tracks_filename' => $gb_tracks_filename,
                            'gb_tracks_filepath' => $gb_tracks_filepath,
                            'gb_tracks_creator_users_id' => $this->user['gb_users_id'],
                            'gb_tracks_date_created' => time());
                $this->projectsmodel = new Application_Model_Projects();
                $this->projectsmodel->saveTrack($data, $gb_projects_branches_id);
            }
        }
        $this->view->stuff = $form->track->getDestination() . "/" . $form->getValue('track');
        $this->view->form = $form;
    }
}

