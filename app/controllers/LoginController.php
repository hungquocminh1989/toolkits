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
        try{

            $params = $this->request->getPost();
            
            $modelUser = new User();
            $m_user_id = $modelUser->checkLoginData($params);
            if($m_user_id !== FALSE){
                $this->getSession()->set($this->getDefine()->SESSION->SESS_LOGIN_USER,$m_user_id);
                return json_encode(
                    array(
                        'status' => 'OK',
                        'result' => $this->url->get('index'),
                        'error_msg' => ''
                    )
                );
            }

            return json_encode(
                array(
                    'status' => 'NG',
                    'error_msg' => $this->getDefine()->MESSAGES->HTML_MSG_ERROR_LOGIN_FAIL
                )
            );
        } catch (Exception $ex) {
            return json_encode(
                array(
                    'status' => 'NG',
                    'error_msg' => $ex->getMessage()
                )
            );
        }
    }

}

