<?php

class PostFeedController extends ControllerBase
{

    public function createPostAction()
    {
        //Ajax response
        $this->view->disable();
        try{
            $params = $this->request->getPost();

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
                        $res = $curl->setPost($value['token2'],$params['post_content'],'',$params['list_tags'],$arrLinkImages);
                    }
                }

                foreach($arrPathImages as $key => $fileDelete){
                    unlink($fileDelete);
                }
            }

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
}

