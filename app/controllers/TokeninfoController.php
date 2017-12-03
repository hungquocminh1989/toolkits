<?php

class TokenInfoController extends ControllerBase
{

    public function indexAction()
    {
        $this->checkAuth();
        $modelToken = new Token();
        $curl = new curlpost();
        $listToken = $modelToken->getTokenList();
        if($listToken != NULL && count($listToken) > 0){
            foreach($listToken as $k => $item){
                $listToken[$k]['friends_count'] = $curl->getCountFriend($item['token2'],$item['user_id']);
            }
        }
        
        $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Kết quả token',$listToken);
        $this->view->setVar('tokenInfo',$listToken);
    }

}

