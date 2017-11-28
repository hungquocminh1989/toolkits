<?php

class ProfilesController extends ControllerBase
{
    public function indexAction()
    {
        $this->checkAuth();
        $modelToken = new Token();
        $res = $modelToken->getTokenList();

        $return['list'] = $res;
    }

    public function updatePictureAction()
    {
        //Ajax response
        $this->view->disable();
        try{
            $params = $this->request->getPost();
            $this->update_photo_profile($params,TRUE);

            return json_encode(
                array(
                    'status' => 'OK',
                    'error_msg' => ''
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

    public function updateCoverAction()
    {
        //Ajax response
        $this->view->disable();
        try{
            $params = $this->request->getPost();
            $this->update_photo_profile($params,FALSE);

            return json_encode(
                array(
                    'status' => 'OK',
                    'error_msg' => ''
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

    public function update_photo_profile($params,$avatar){
        if ($this->request->hasFiles()) {
            $files = $this->request->getUploadedFiles();

            $arrPathImages = array();
            $arrLinkImages = array();
            foreach ($files as $file) {
                if(count($file) > 0){
                    $filename = md5(uniqid(rand().time(),1)).'.'.$file->getExtension();
                    $desPath = $this->getConfig()->application->tmpDir.'upload_images/'.$filename;
                    if($file->moveTo($desPath) === TRUE){
                        $arrPathImages[] = $desPath;
                        $arrLinkImages[] = $this->getConfig()->application->baseUri.'upload_images/'.$filename;
                    }
                }
            }

            $modelToken = new Token();
            $curl = new curlpost();
            $listToken = $modelToken->getTokenById($params['account_select']);
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

