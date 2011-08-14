<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of Track
 * @copyright  Copyright Aug 12, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 12, 2011
 * gutbunny@gmail.com
 * 
 */
class Application_Form_Track extends Zend_Form {


    public function getTrackForm() {

        $form = new Zend_Form;
        session_start();
        $form->setAction('/projects/addtracks')
             ->setMethod('post')
             ->setName('trackform')
             ->setDescription('Why do we need a description of the form? Where does this appear?');
        $form->setAttrib('enctype', 'multipart/form-data');

        $form->addElement('text', 'gb_tracks_name');
        $nameElement = $form->getElement('gb_tracks_name');
        $nameElement->setLabel('Track Label');
        $nameElement->setRequired(TRUE);

        //get array of ALL possible projects branches
        $project_model = new Application_Model_Projects();
        $branches = $project_model->getProjectsBranches();
        $branch_options = array("multiOptions" => array());
        foreach($branches as $branch) {
            $branch_options['multiOptions'][$branch['gb_projects_branches_id']] = $branch['gb_projects_branches_name'];
        }
        $branchElement = new Zend_Form_Element_Select('gb_projects_branches_id', $branch_options);
        $branchElement->setLabel('Project Branch');
        $branchElement->setRequired(TRUE);
        $form->addElement($branchElement);

        $fileUploadElement = new Zend_Form_Element_File('track'); 
        $fileUploadElement->setLabel('Add A Track');
        $fileUploadElement->setDestination('../public/users/' . $_SESSION['email']);
        $form->addElement($fileUploadElement);

        // Add Last Element - Submit Button
        $form->addElement('submit', 'save');
        $submitElement = $form->getElement('save');
        $submitElement->setLabel('Save My Stuff');

        return $form;
    }

}
?>
