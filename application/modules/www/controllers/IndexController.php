<?php

class Www_IndexController extends Zend_Controller_Action
{
    public function init()
    {
    	/* Initialize action controller here */
    }

    public function indexAction()
    {
        
    }

    public function newAction() 
    {
    }

    
	public function testAction()
    {
    	$flashMessenger = $this->_helper->getHelper('FlashMessenger');
    	$flashMessenger->addMessage('We did something in the last request');
		
    	$element = new ZendX_JQuery_Form_Element_DatePicker(
                        'dp1',
                        array('jQueryParams' => array('defaultDate' => '2007/10/10'))
                    );
		$this->view->datepicker = $element;
		
		$form = new ZendX_JQuery_Form();
    	$form->setAction('formdemo.php');
    	$form->setAttrib('id', 'mainForm');
    	$form->setAttrib('class', 'flora');
     
	    $form->setDecorators(array(
	        'FormElements',
	        array('TabContainer', array(
	            'id'          => 'tabContainer',
	            'style'       => 'width: 600px;',
	        )),
	        'Form',
	    ));
	    
	    $subForm1 = new ZendX_JQuery_Form();
	    $subForm1->setDecorators(array(
	        'FormElements',
	        array('HtmlTag',
	              array('tag' => 'dl')),
	        array('TabPane',
	              array('jQueryParams' => array('containerId' => 'mainForm',
	                                            'title' => 'DatePicker and Slider')))
	    ));
	     
	    $subForm2 = new ZendX_JQuery_Form();
	    $subForm2->setDecorators(array(
	       'FormElements',
	       array('HtmlTag',
	             array('tag' => 'dl')),
	       array('TabPane',
	             array('jQueryParams' => array('containerId' => 'mainForm',
	                                           'title' => 'AutoComplete and Spinner')))
	    ));
	        // Add Element Date Picker
	    $elem = new ZendX_JQuery_Form_Element_DatePicker(
	                    "datePicker1", array("label" => "Date Picker:")
	                );
	    $elem->setJQueryParam('dateFormat', 'dd.mm.yy');
	    $subForm1->addElement($elem);
	     
	    // Add Element Spinner
	    $elem = new ZendX_JQuery_Form_Element_Spinner(
	                    "spinner1", array('label' => 'Spinner:')
	                );
	    $elem->setJQueryParams(array('min' => 0, 'max' => 1000, 'start' => 100));
	    $subForm1->addElement($elem);
	     
	    // Add Slider Element
	    $elem = new ZendX_JQuery_Form_Element_Slider(
	                    "slider1", array('label' => 'Slider:')
	                );
	    $elem->setJQueryParams(array('defaultValue' => '75'));
	    $subForm2->addElement($elem);
	     
	    // Add Autocomplete Element
	    $elem = new ZendX_JQuery_Form_Element_AutoComplete(
	                    "ac1", array('label' => 'Autocomplete:')
	                );
	    $elem->setJQueryParams(array('source' => array('New York',
	                                                 'Berlin',
	                                                 'Bern',
	                                                 'Boston')));
	    $subForm2->addElement($elem);
	     
	    // Submit Button
	    $elem = new Zend_Form_Element_Submit("btn1", array('value' => 'Submit'));
	    $subForm1->addElement($elem);

	    $form->addSubForm($subForm1, 'subform1');
		$form->addSubForm($subForm2, 'subform2');
	    $this->view->form = $form;
    }
}

