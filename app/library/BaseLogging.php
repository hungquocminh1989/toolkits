<?php
use Phalcon\Logger\Adapter\File as FileAdapter;

class BaseLogging extends Phalcon\Mvc\User\Module
{
	
	public function debugLog($prefix_class, $prefix_function, $message, $paramLog = '')
    {
    	if($this->getDI()->getDefine()->SETTING->ENABLE_DEBUG_LOGGING == "TRUE"){
	        $this->baseLog($prefix_class)->debug('Function: '.$prefix_function."\n".$message."\n".var_export($paramLog,TRUE));
        }
    }
    
    public function createLog($prefix_class, $message, $paramLog = '')
    {
    	if($this->getDI()->getDefine()->SETTING->ENABLE_LOGGING == "TRUE"){
			$this->baseLog($prefix_class)->debug($message."\n".var_export($paramLog,TRUE));
		}
    }
    
    public function baseLog($prefix){
		$config = $this->getDI()->getConfig();
	    $define = $this->getDI()->getDefine();
	    $session = $this->getDI()->getSession();
	    $logFilename = date('Ymd').'_DEBUG_'.$prefix.'_'.$session->get($define->SESSION->SESS_LOGIN_USER).'.log';
	    $logging = new FileAdapter($config->application->logsDir.$logFilename);
	    
	    return $logging;
	}
}