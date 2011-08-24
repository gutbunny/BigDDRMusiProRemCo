<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of FormPhone
 * @copyright  Copyright Aug 23, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 23, 2011
 * gutbunny@gmail.com
 * 
 */


/**
 * Abstract class for extension
 */
require_once '/homepages/36/d378030953/htdocs/library/Zend/View/Helper/FormElement.php';
// no need to include since this is already loaded with the help of bootstrap (I think)

/**
 * Helper to generate a "Phone" element
 *
 * This will print 3 text fields for taking seperate parts of phone number
 *
 * @author	Anis uddin Ahmad <anisniit@gmail.com>
 */
class Application_View_Helper_FormPhone extends Zend_View_Helper_FormElement
{

    /**
     * Generates a 'phone' element.
     *
     * @access public
     *
     * @param string|array $name If a string, the element name.  If an
     *      array, all other parameters are ignored, and the array elements
     *      are used in place of added parameters.
     * @param mixed $value The element value.
     * @param array $attribs Attributes for the element tag.
     *
     * @return string The element XHTML.
     */
    public function formPhone($name, $value = null, $attribs = null)
    {

        $info = $this->_getInfo($name, $value, $attribs);
        extract($info); // name, value, attribs, options, listsep, disable

        // build the element
        $disabled = '';
        if ($disable) {
            // disabled
            $disabled = ' disabled="disabled"';
        }

        $codeLength = $attribs['codeLength'];

        if(isset($attribs['separator'])){
            $separator = $attribs['separator'];
            unset($attribs['separator']);

            if($separator == ' ') $separator = '&nbsp;';

        } else {
            $separator = '';
        }



        // XHTML or HTML end tag?
        $endTag = ' />';
        if (($this->view instanceof Zend_View_Abstract) && !$this->view->doctype()->isXhtml()) {
            $endTag= '>';
        }

        // Some attributes should not use as html attr
        unset($attribs['codeLength']);
        unset($attribs['ignoreSeparator']);

        $class = $attribs['class'];
        $desepValue = str_replace($separator, '', $this->view->escape($value));

        // Print the field for Country code
        $attribs['class'] = "$class phone_country";
        $attribs['maxlenght'] = $codeLength['country'];

        $xhtml = '<input type="text"'
                . ' name="' . $this->view->escape($name) . '_country"'
                . ' id="' . $this->view->escape($id) . '_country"'
                . ' value="' . substr($desepValue, 0, $codeLength['country'])  . '"'
                . $disabled
                . $this->_htmlAttribs($attribs)
                . $endTag . $separator;

        // Print the field for Operator code
        $attribs['class'] = "$class phone_operator";
        $attribs['maxlenght'] = $codeLength['operator'];

        $xhtml .= '<input type="text"'
                . ' name="' . $this->view->escape($name) . '_operator"'
                . ' id="' . $this->view->escape($id) . '_operator"'
                . ' value="' . substr($desepValue, $codeLength['country'], $codeLength['operator']) . '"'
                . $disabled
                . $this->_htmlAttribs($attribs)
                . $endTag . $separator;

        $attribs['class'] = "$class phone";
        $attribs['maxlenght'] = $this->codeLength['self'];

        $xhtml .= '<input type="text"'
                . ' name="' . $this->view->escape($name) . '"'
                . ' id="' . $this->view->escape($id) . '"'
                . ' value="' . substr($desepValue, $codeLength['country'] + $codeLength['operator']) . '"'
                . $disabled
                . $this->_htmlAttribs($attribs)
                . $endTag;

        return $xhtml;
    }
}
