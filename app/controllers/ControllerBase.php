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
        //Ajax response
	    $this->view->disable();
	    
	    $arrResponse = array(
                        'status' => 'NG',
                        'result' => '',
                        'error_msg' => ''
        );
        
        try{

            $params = $this->request->getPost();
            
            //...
            if(TRUE){
                //..
                $arrResponse['status'] = '';
                $arrResponse['result'] = $this->url->get('index');
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
		//echo 1111;die();
		
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
