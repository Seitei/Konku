<?php
class App_Utils {
	static public function getOptions()
	{
		$options = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini',APPLICATION_ENV);
		return $options;
	}
}