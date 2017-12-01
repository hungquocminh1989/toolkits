<?php

class LoginController extends ControllerBase
{

    public function indexAction()
    {
        $this->view->setMainView('login');
    }
    public function authAction()
    {
        //Ajax response
	    $this->view->disable();
	    $arrResponse = array(
                        'status' => 'NG',
                        'error_msg' => ''
        );
        
        try{

            $params = $this->request->getPost();
            
            $modelUser = new User();
            $m_user_id = $modelUser->checkLoginData($params);
            
            if($m_user_id !== FALSE){
            	//Gán login session
                $this->getSession()->set($this->getDefine()->SESSION->SESS_LOGIN_USER,$m_user_id);
                $arrResponse['status'] = 'OK';
                $arrResponse['homelink'] = $this->url->get('index');
                return json_encode($arrResponse);
            }
            else{
                $arrResponse['error_msg'] = $this->getDefine()->MESSAGES->HTML_MSG_ERROR_LOGIN_FAIL;
                return json_encode($arrResponse);
			}
        } catch (Exception $ex) {
            $arrResponse['error_msg'] = $ex->getMessage();
            return json_encode($arrResponse);
        }
    }

}

