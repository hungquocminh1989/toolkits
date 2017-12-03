<?php

use Phalcon\Mvc\Controller;
use Phalcon\Logger\Adapter\File as FileAdapter;

class ControllerBase extends Controller
{
	/**
	* ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
	* Start Sample Function
	*/
	public function sampleAction()
    {
        //Log biến
        $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Dữ liệu post',['a','b']);

        //Ajax response
	    $this->view->disable();
	    
	    $arrResponse = array(
                        'status' => 'NG',
                        'error_msg' => ''
        );
        
        try{

            $params = $this->request->getPost();
            
            //...
            if(TRUE){
                //..
                $arrResponse['status'] = '';
                $arrResponse['blabla'] = $this->url->get('index');
            }
            else{
				$arrResponse['status'] = 'NG';
                $arrResponse['error_msg'] = 'error';
			}
			
			return json_encode($arrResponse);
        }
        catch (Exception $ex) {
        	$arrResponse['error_msg'] = 'error Exception';
            return json_encode($arrResponse);
        }
    }
    /**
	* End Sample Function
	* ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
	*/
	
    public function onConstruct()
    {
    	
    }

    public function initialize()
    {
        $this->tag->setDoctype(Phalcon\Tag::XHTML10_TRANSITIONAL);

        $this->assets->addCss('public/css/bootstrap.css');
        $this->assets->addCss('public/css/bootstrap-fileupload.min.css');
        $this->assets->addCss('public/css/font-awesome.css');
        $this->assets->addCss('public/css/basic.css');
        $this->assets->addCss('public/css/custom.css');

        $this->assets->addJs('public/js/jquery-1.10.2.js');
        $this->assets->addJs('public/js/bootstrap.js');
        $this->assets->addJs('public/js/bootstrap-fileupload.js');
        $this->assets->addJs('public/js/jquery.metisMenu.js');

    }
    
    public function Logging(){
    	$BaseLogging = new BaseLogging();
		return $BaseLogging;
	}

    public function getDefine()
    {
        return $this->getDI()->getDefine();
    }

    public function getSession()
    {
        return $this->getDI()->getSession();
    }

    public function getConfig()
    {
        return $this->getDI()->getConfig();
    }

    public function getUrl()
    {
        return $this->getDI()->getUrl();
    }
    
    public function getHttpsUrl()
    {
        return $this->getDI()->getHttpsurl();
    }
    
    public function debugLog($prefix_class, $prefix_function, $message, $paramLog = '')
    {
    	if($this->getDefine()->SETTING->ENABLE_DEBUG_LOGGING == "TRUE"){
	        $this->baseLog($prefix_class)->debug('Function: '.$prefix_function."\n".$message."\n".var_export($paramLog,TRUE));
        }
    }
    
    public function createLog($prefix_class, $message, $paramLog = '')
    {
    	if($this->getDefine()->SETTING->ENABLE_LOGGING == "TRUE"){
			$this->baseLog($prefix_class)->debug($message."\n".var_export($paramLog,TRUE));
		}
    }
    
    public function baseLog($prefix){
		$config = $this->getConfig();
	    $define = $this->getDefine();
	    $session = $this->getSession();
	    $logFilename = date('Ymd').'_DEBUG_'.$prefix.'_'.$session->get($define->SESSION->SESS_LOGIN_USER).'.log';
	    $logging = new FileAdapter($config->application->logsDir.$logFilename);
	    
	    return $logging;
	}

    public function indexAction()
    {
        $this->checkAuth();
    }

    public function checkAuth()
    {
        if($this->session->get($this->getDefine()->SESSION->SESS_LOGIN_USER) != '')
        {
            //$this->dispatcher->fo
        }
        else{
            $this->dispatcher->forward(
                [
                    'controller' => 'login',
                    'action'     => 'index'
                ]
            );
        }
    }

}
