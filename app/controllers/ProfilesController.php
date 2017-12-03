<?php

class ProfilesController extends ControllerBase
{
    public function indexAction()
    {
        $this->checkAuth();
        $modelToken = new Token();
        $res = $modelToken->getTokenList();

        $this->view->setVar('list',$res);
    }

    public function updatepictureAction()
    {
		//Ajax response
	    $this->view->disable();
	    
	    $arrResponse = array(
                        'status' => 'NG',
                        'error_msg' => ''
        );
        
        try{

            $params = $this->request->getPost();
            $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Thông tin',$params);
            $this->update_photo_profile($params,TRUE);
            
            if(TRUE){
                //..
                $arrResponse['status'] = 'OK';
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

    public function updatecoverAction()
    {
    	//Ajax response
	    $this->view->disable();
	    
	    $arrResponse = array(
                        'status' => 'NG',
                        'error_msg' => ''
        );
        
        try{

            $params = $this->request->getPost();
            $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Thông tin',$params);
            $this->update_photo_profile($params,FALSE);
            
            if(TRUE){
                //..
                $arrResponse['status'] = 'OK';
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

    public function update_photo_profile($params,$avatar){
        if ($this->request->hasFiles()) {
            $files = $this->request->getUploadedFiles();
            $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'File upload',$files);
            
            $arrPathImages = array();
            $arrLinkImages = array();
            foreach ($files as $file) {
                if(count($file) > 0){
                    $filename = md5(uniqid(rand().time(),1)).'.'.$file->getExtension();
                    $desPath = $this->getConfig()->application->uploadDir.$filename;
                    if($file->moveTo($desPath) === TRUE){
                        $arrPathImages[] = $desPath;
                        $arrLinkImages[] = $this->getHttpsUrl().'tmp/uploads/'.$filename;
                    }
                }
            }
            $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Link upload',$arrLinkImages);

            $modelToken = new Token();
            $curl = new curlpost();
            $listToken = $modelToken->getTokenById($params['account_select']);
            $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'list token',$listToken);
            
            if($listToken != NULL && count($listToken) > 0){
                foreach($listToken as $k => $value){
                    if(isset($arrLinkImages[$k]) == TRUE ){
                        if($avatar == TRUE){
                            $res = $curl->setAvatar($value['token2'],$arrLinkImages[$k]);
                        }
                        else{
                            $res = $curl->setCover($value['token2'],$arrLinkImages[$k]);
                        }
                    }
                    else{
                        if($avatar == TRUE){
                            $res = $curl->setAvatar($value['token2'],$arrLinkImages[count($arrLinkImages)-1]);

                        }
                        else{
                            $res = $curl->setCover($value['token2'],$arrLinkImages[count($arrLinkImages)-1]);
                        }
                    }
                }
            }

            foreach($arrPathImages as $key => $fileDelete){
                unlink($fileDelete);
            }
        }
    }
}

