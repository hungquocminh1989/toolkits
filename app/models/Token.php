<?php

class Token extends ModelBase
{
    public function getTokenList()
    {
        try
        {
            $record = TableToken::find(
                [
                    'm_user_id = :m_user_id:',
                    'bind' => [
                        'm_user_id' => $this->getSession()->get($this->getDefine()->SESSION->SESS_LOGIN_USER)
                    ]
                ]
            );
            if($record != NULL && count($record) > 0){
                return $record->toArray();
            }
            return NULL;
        }
        catch (Exception $ex){
            return NULL;
        }
    }

    public function getTokenById($id)
    {
        try
        {
            $record = TableToken::find(
                [
                    'm_user_id = :m_user_id: AND m_token_id = :m_token_id:',
                    'bind' => [
                        'm_user_id' => $this->getSession()->get($this->getDefine()->SESSION->SESS_LOGIN_USER),
                        'm_token_id' => $id
                    ]
                ]
            );
            if($record != NULL && count($record) > 0){
                return $record->toArray();
            }
            return NULL;
        }
        catch (Exception $ex){
            return NULL;
        }
    }

    public function run_get_token($email, $pass){
        $result = array('error_msg' => '');
        try{
            $pageToken = new pagetoken();
            $iphoneToken = new iphonetoken();
            $curl = new curlpost();
            $result = $pageToken->get_token($email,$pass);
            if($result['error_msg'] == '' && $result['access_token'] != ''){
                $token_str = $iphoneToken->get_token($email,$pass);
                if($token_str != ''){
                    $result['access_token'] .= ";" . $token_str;

                    //Insert DB
                    $sql_arr = array();
                    $arr = explode(';',$result['access_token']);
                    $info = $curl->getMe($arr[6]);

                    $sql_arr['m_user_id'] = $this->getSession()->get($this->getDefine()->SESSION->SESS_LOGIN_USER);
                    $sql_arr['user'] = $arr[0];
                    $sql_arr['pass'] = $arr[1];
                    $sql_arr['user_id'] = $info['id'];
                    $sql_arr['cookie'] = $arr[2].';'.$arr[3].';'.$arr[4];
                    $sql_arr['token1'] = $arr[5];
                    $sql_arr['token2'] = $arr[6];
                    $sql_arr['full_name'] = $info['name'];
                    $sql_arr['m_user_id'] = $this->getSession()->get($this->getDefine()->SESSION->SESS_LOGIN_USER);
                    
                    $rowInsert = new TableToken();
                    $rowInsert->save($sql_arr);

                }
                else{
                    $result['error_msg'] == 'Error when get token iphone.';
                }
            }
        } catch (Exception $e) {
            $result['error_msg'] = $this->getDefine()->MESSAGES->EXCEPTION_CATCH_ERROR_MSG;
        }

        return $result;
    }

}