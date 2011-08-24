<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of Sandbox
 * @copyright  Copyright Aug 23, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 23, 2011
 * gutbunny@gmail.com
 * 
 */

require_once '/homepages/36/d378030953/htdocs/library/Zend/Form/Element/Xhtml.php';

class Application_Form_Sandbox extends Zend_Form {

    public function getSandboxForm() {

        $form = new Zend_Form;

        $form->setAction('sandbox')
             ->setMethod('post')
             ->setName('shepform')
             ->setDescription('Why do we need a description of the form? Where does this appear?');
        $form->setAttrib('sitename', "Shep's School");
        /*
        $testobj = new Zend_Form_Element_Xhtml;

        $primaryPhone = new Application_Form_Element_Phone('primary_phone');

        $primaryPhone->setLabel('Primary phone')
              ->setAttrib('class' ,'some class' )
              ->setAttrib('separator' ,'#' )  
              ->setAttrib('ignoreSeparator', true)  
              ->setDescription('Phone number format: XXX # XXXX # XXXXXX')
              ->setValue(isset($data['primary_phone']) ? $data['primary_phone'] : '')
              ->addValidator('digits');

        $form->addElement($primaryPhone);
*/
        // Add Last Element - Submit Button
        $form->addElement('submit', 'save');
        $submitElement = $form->getElement('save');
        $submitElement->setLabel('Save My Stuff');

        return $form;
    }
}
?>
