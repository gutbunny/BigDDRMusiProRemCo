<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of Phone
 * @copyright  Copyright Aug 23, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 23, 2011
 * gutbunny@gmail.com
 * 
 */


require_once '/homepages/36/d378030953/htdocs/library/Zend/Form/Element/Xhtml.php';

/**
 * Phone number form element.
 *
 * This will render 3 text fields for parts of phone number - country code, operator code and subscriber number
 * The values of these three fields jointly will be considered as the value.
 * Optionally, a separator can be used between these fields. This separator can be ignored from/included in value
 *
 * @author	Anis uddin Ahmad <anisniit@gmail.com>
 * @example
 *      $primaryPhone = new Project_Form_Element_Phone('primary_phone');

        $primaryPhone->setLabel('Primary phone')
                  ->setAttrib('class' ,'some class' )
                  ->setAttrib('separator' ,'#' )  // Separator between Phone number parts
                  ->setAttrib('ignoreSeparator', true)  // Ignore seperators from in field value
                  ->setDescription('Phone number format: XXX # XXXX # XXXXXX')
                  ->setValue(isset($data['primary_phone']) ? $data['primary_phone'] : '')
                  ->addValidator('digits');

        $form->addElement($primaryPhone);
 *
 * Phone number format : XXX-XXXX-XXXXXX
 */
class Application_Form_Element_Phone extends Zend_Form_Element_Xhtml
{
    /**
     * Default form view helper to use for rendering
     * @var string
     */
    public $helper = 'formPhone';

    public $options;

    /**
     * Length of phone number parts
     *
     * @var array
     */
    public $codeLength = array(
        'self' => 6,
        'operator' => 4,
        'country' => 3
    );

    /**
     * Should separators exclude from value or not
     * Default is true (exclude them)
     *
     * @var boolean
     */
    public $ignoreSeparator = true;

    public function __construct($field_name, $attributes = null, $data_item = null) {
        $this->options = $data_item;

        // Set special attributes for Phone number
        if(!isset($attributes['codeLength'])){
            $attributes['codeLength'] = $this->codeLength;
        }
        if(!isset($attributes['ignoreSeparator'])){
            $attributes['ignoreSeparator'] = $this->ignpreSeparator;
        }

        parent::__construct($field_name, $attributes);
    }

    /**
     * Validate element value
     *
     * Note: The *filtered* value is validated.
     *
     * @param  mixed $value
     * @param  mixed $context
     * @return boolean
     */
    public function isValid($value, $context = null)
    {
        $attributes = $this->getAttribs();

        $sep  = ($attributes['separator'] && !$attributes['ignoreSeparator'])? $attributes['separator'] : '';
        $name = $this->getName();

        $joinedValue = $context[$name . '_country'] . $sep . $context[$name . '_operator'] . $sep . $value;

        return parent::isValid($joinedValue, $context);
    }

}