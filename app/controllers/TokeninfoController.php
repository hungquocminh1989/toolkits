<?php

class TokenInfoController extends ControllerBase
{

    public function indexAction()
    {
        $this->checkAuth();
        $modelToken = new Token();
        $curl = new curlpost();
        $listToken = $modelToken->getTokenList();
        /*if($listToken != NULL && count($listToken) > 0){
            foreach($listToken as $k => $item){
                $listToken[$k]['friends_count'] = $curl->getCountFriend($item['token2'],$item['user_id']);
            }
        }*/
        
        $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Kết quả token',$listToken);
        $this->view->setVar('tokenInfo',$listToken);
    }
    
    public function updateinfoflgAction()
    {
        //Ajax response
        $this->view->disable();
        $arrResponse = array(
                        'status' => 'NG',
                        'error_msg' => ''
        );
        try{
            $params = $this->request->getPost();
			
            $model = new Token();
            $res = $model->updateInfoStatus($params['m_token_id'],$params['info_status']);
			if($res == TRUE){
				$arrResponse['status'] = 'OK';
			}
			else{
				$arrResponse['error_msg'] = $this->getDefine()->MESSAGES->ERROR_MSG_UPDATE_FAIL;
			}
            return json_encode($arrResponse);

        } catch (Exception $e) {
            $arrResponse['error_msg'] = $this->getDefine()->MESSAGES->EXCEPTION_CATCH_ERROR_MSG;
            $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Lỗi bất thường',$arrResponse);

            return json_encode($arrResponse);
        }
    }
    
    public function checkfriendsAction()
    {
        //Ajax response
        $this->view->disable();
        $arrResponse = array(
                        'status' => 'NG',
                        'error_msg' => ''
        );
        try{
            $params = $this->request->getPost();
			
            $curl = new curlpost();
	        $arrResponse['friends'] = $curl->getCountFriend($this->getDefine()->TOKEN->DEFAULT_TOKEN,$params['uid']);
	        if($arrResponse['friends'] != ''){
				$model = new Token();
		        $model->updateTotalFriend($params['uid'],$arrResponse['friends']);
				$arrResponse['status'] = 'OK';
			}
	        
            return json_encode($arrResponse);

        } catch (Exception $e) {
            $arrResponse['error_msg'] = $this->getDefine()->MESSAGES->EXCEPTION_CATCH_ERROR_MSG;
            $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Lỗi bất thường',$arrResponse);

            return json_encode($arrResponse);
        }
    }

}

