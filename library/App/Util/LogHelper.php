<?php
 
class App_Util_LogHelper{
	
	const SEPARATOR = "=================================";
	

	public static function logger()
	{
		if (!($log = Zend_Registry::get("Log"))) {
			echo 'NOT LOGGER AVAILABLE';
		}
		return $log;
		
	}

	public static function LogMessage($message,$priority = Zend_Log::INFO, $doEcho = false) {
		self::logger()->log($message,$priority);
		
		if ($doEcho) {
			echo $message;
		}
	}
	
	public static function setStreamWritter()
	{
		$date = new DateTime();
		$filePrefix = $date->format("Ymd");
		if(defined('CLI_APP'))
			$logPath = APPLICATION_PATH.'/temp/'.$filePrefix."_".CLI_APP.'.log';
		else
			$logPath = APPLICATION_PATH.'/temp/'.$filePrefix."_".'zend.log';
				
		if ( !file_exists($logPath)) {
			$fp = fopen($logPath, 'w');
			fclose($fp);
			chmod($logPath, 0777);
		}

		$stream = @fopen($logPath, 'a');

		if ($stream) {
			$stdWritter = new Zend_Log_Writer_Stream($stream);
			$stdWritter->addFilter(Zend_Log::DEBUG);
			$stdWritter->addFilter(Zend_Log::INFO);
			self::logger()->addWriter($stdWritter);
		}
	}

}