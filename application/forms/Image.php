<?php

class My_Decorator_SimpleButton extends Zend_Form_Decorator_Abstract
{
    protected $_format = '
    <div class="row">
    <div class="col-md-4 form-group">
    <input id="%s" name="%s" type="%s" class="btn btn-primary" value="%s"/>
    </div></div>';
 
    public function render($content)
    {
        $element = $this->getElement();
        $name    = htmlentities($element->getFullyQualifiedName());
        $id      = htmlentities($element->getId());
        $value   = htmlentities($element->getValue());
        $type    = htmlentities($element->getAttrib('type'));
 
        $markup  = sprintf($this->_format, $id, $name, $type, $value);
        return $markup;
    }

}


class Application_Form_Image extends Zend_Form
{

    public function init()
    {
        $this->setName('upload');

        $buttonDecorator = new My_Decorator_SimpleButton();

        $file = new Zend_Form_Element_File(
            'file', array(
                'onchange' => 'javascript:readURL(this);'
            )
        );
        $file->setLabel('File to Upload:')->setRequired(true);

        $upload = new Zend_Form_Element_Submit(
            'upload', array(
                'value' => 'Upload',
                'type' => 'submit',
                'decorators' => array($buttonDecorator),
            )
        );

        $this->addElements(array($file, $upload));
    }
}
