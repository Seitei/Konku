<?php

class Www_Form_Game extends Zend_Form
{

   public function init()
    {
        $this->setMethod('post');
        
        $this->addElement('text', 'title', array(
        		'label'      => 'Game Title',
        		'required'   => true,
        		'filters'    => array('StringTrim'),
        		'validators' => array(
        				array('NotEmpty', true,  array('messages'=>'This field cannot be left empty. Please fill in.')),
        		),
        		'decorators' => array(array('ViewHelper'),array('Errors'),array('Description'),array('HtmlTag'),array('Label'))
        ));
        $this->addElement('text', 'codename', array(
        		'label'      => 'Game Codename',
        		'required'   => true,
        		'filters'    => array('StringTrim'),
        		'validators' => array(
        				array('NotEmpty', true,  array('messages'=>'This field cannot be left empty. Please fill in.')),
        		),
        		'decorators' => array(array('ViewHelper'),array('Errors'),array('Description'),array('HtmlTag'),array('Label'))
        ));
        $this->addElement('text', 'category', array(
            'label'      => 'Game Category',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('NotEmpty', true,  array('messages'=>'This field cannot be left empty. Please fill in.')),
            ),
            'decorators' => array(array('ViewHelper'),array('Errors'),array('Description'),array('HtmlTag'),array('Label'))
        ));
        $this->addElement('text', 'version', array(
        		'label'      => 'Game Version',
        		'required'   => true,
        		'filters'    => array('StringTrim'),
        		'validators' => array(
        				array('NotEmpty', true,  array('messages'=>'This field cannot be left empty. Please fill in.')),
        		),
        		'decorators' => array(array('ViewHelper'),array('Errors'),array('Description'),array('HtmlTag'),array('Label'))
        ));
        $this->addElement('textarea', 'description', array(
        		'label'      => 'Game Description',
        		'required'   => true,
        		'filters'    => array('StringTrim'),
        		'validators' => array(
        				array('NotEmpty', true,  array('messages'=>'This field cannot be left empty. Please fill in.')),
        		),
        		'decorators' => array(array('ViewHelper'),array('Errors'),array('Description'),array('HtmlTag'),array('Label'))
        ));
        

        $this->addElement('file', 'file', array(
        		'label'      => 'Game File',
        		'required'   => true,
        ));
        $this->addElement('file', 'preview', array(
            'label'      => 'Game Preview Image',
            'required'   => true,
        ));
        $this->addElement('file', 'previewPuzzle', array(
            'label'      => 'Game Puzzle Image',
            'required'   => true,
        ));

 
        $this->addElement('image', 'submit', array(
            'ignore'   => true,
			'decorators' => array(array('ViewHelper')),
        ));
 
        $this->addElement('hash', 'csrf');
        $this->csrf->setErrorMessages(array("Too much time passed."));
    }
    
}

