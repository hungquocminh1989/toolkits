<?php

class FriendsController extends ControllerBase
{
    public function indexAction()
    {
        $m_user_id = $this->getSession()->get($this->getDefine()->SESSION->SESS_LOGIN_USER);
        $fileLock  = $this->getConfig()->application->tmpDir . $this->getDefine()->LOCK->FOLDER_LOCK . '/'.$m_user_id.'_'. $this->getDefine()->LOCK->FILE_LOCK;
        $model = new Friend();
        $result['list'] = $model->getFriends();
        if(file_exists($fileLock) === TRUE) {
            $result['batch_status'] = 'locked';
        }
        else{
            $result['batch_status'] = 'unlock';
        }

        $this->view->setVar('batch_status',$result['batch_status']);
        $this->view->setVar('list',$result['list']);
    }

    public function importuidAction()
    {
        //Ajax response
        $this->view->disable();
        try{
            $modelFriend = new Friend();
            $curl = new curlpost();
            $param = $this->request->getPost();
            if($param['import_uid'] != ''){
                $multi_line = preg_replace("/\r\n|\r|\n/", '  ', $param['import_uid']);
                $arr_line = explode('  ',trim($multi_line));

                foreach($arr_line as $key => $uid){
                    $info = $curl->getUidInfo($this->getDefine()->TOKEN->DEFAULT_TOKEN,$uid);
                    $param['uid'] = $uid;
                    $param['name'] = $info['name'];
                    $modelFriend->insertFriend($param);
                }
                return json_encode(
                    array(
                        'status' => 'OK',
                        'error_msg' => ''
                    )
                );
            }
            else{
                return json_encode(
                    array(
                        'status' => 'NG',
                        'error_msg' => 'No data.'
                    )
                );
            }
        } catch (Exception $e) {
            return json_encode(
                array(
                    'status' => 'NG',
                    'error_msg' => $e->getMessage()
                )
            );
        }
    }
    public function execfriendsrequestAction()
    {
        //Ajax response
        $this->view->disable();
        $m_user_id = $this->getSession()->get($this->getDefine()->SESSION->SESS_LOGIN_USER);
        $fileLock  = $this->getConfig()->application->tmpDir . $this->getDefine()->LOCK->FOLDER_LOCK . '/'.$m_user_id.'_'. $this->getDefine()->LOCK->FILE_LOCK;
        if(file_exists($fileLock) === FALSE) {
            do{
                $curl = new curlpost();
                $curl->execute_batch($this->getHttpUrl().'Batchaddfriend?m_user_id='.$m_user_id);
                sleep(3);
            } while(file_exists($fileLock) === FALSE);

            $result['batch_status'] = 'locked';
        }
        else{
            unlink($fileLock);
            sleep(5);
            $result['batch_status'] = 'unlock';
        }

        $result['status'] = 'OK';

        return json_encode($result);
    }
}

