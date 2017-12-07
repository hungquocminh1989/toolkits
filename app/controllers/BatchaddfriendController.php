<?php
set_time_limit(0);
class BatchAddFriendController extends ControllerBase
{

    public function indexAction()
    {
        //Ajax response
        $this->view->disable();
        echo "Start";
        echo "<br>";
        $this->main();
        echo "End";
    }

    public function checkStopBatch($fileLock){
        if(file_exists($fileLock) === FALSE) {
            //ACWLog::debug_var(LOG_SUCCESS, "====STOP");
            return TRUE;
        }
        return FALSE;
    }

    public function GetListFriends($fileLock,$m_user_id){
        $model = new HiddenBatch();
        $tryAgain = TRUE;
        $n = 0;
        $listProcess = NULL;
        do{
            if($this->checkStopBatch($fileLock) == TRUE){
                return FALSE;
            }
            try{
                $listProcess = $model->getFriendListProcess($m_user_id);
                if($listProcess != NULL && count($listProcess)>0){
                    $tryAgain = FALSE;
                }
            } catch (Exception $e1) {
                $tryAgain = TRUE;
            }
            $n++;
        } while($tryAgain ==TRUE && $n <= $this->getDefine()->RETRY->TRY_AGAIN_GET_UID);

        return $listProcess;
    }

    public function GetListTokens($m_user_id){
        $model = new HiddenBatch();
        $tryAgain = TRUE;
        $n = 0;
        $tokens = NULL;
        do{
            try{
                $tokens = $model->getActiveTokenList($m_user_id);
                if($tokens != NULL && count($tokens)>0){
                    $tryAgain = FALSE;
                }
            } catch (Exception $e1) {
                $tryAgain = TRUE;
            }
            $n++;
        } while($tryAgain ==TRUE && $n <= $this->getDefine()->RETRY->TRY_AGAIN_GET_UID);

        return $tokens;
    }

    public function main()
    {
        $params = $this->request->get();
        if(isset($params['m_user_id']) === TRUE && $params['m_user_id'] != ''){
        	
        	$m_user_id = $params['m_user_id'];
        	//Gán login session
            $this->getSession()->set($this->getDefine()->SESSION->SESS_LOGIN_USER,$m_user_id);
            $fileLock  = $this->getConfig()->application->tmpDir . $this->getDefine()->LOCK->FOLDER_LOCK . '/'.$m_user_id.'_'. $this->getDefine()->LOCK->FILE_LOCK;
            try {
                /*if (time() >= strtotime(TIME_STOP)) {
                    ACWLog::debug_var(LOG_SUCCESS, "====STOP");
                    goto end_batch;
                }*/

                if(file_exists($fileLock) === TRUE) {
                    unlink($fileLock);
                    if($this->checkStopBatch($fileLock) == TRUE){
                        goto end_batch;
                    }
                }
                else{
                    file_put_contents($fileLock, 'start');
                }
                $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Khởi tạo file lock',$fileLock);
				
                $model = new HiddenBatch();
                $curl = new curlpost();
                do{
                	$this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Đang chạy ...');
                    //========================================
                    //Lấy danh sách UID cần kết bạn
                    $listProcess = $this->GetListFriends($fileLock,$m_user_id);
                    $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Lấy danh sách UID cần kết bạn',$listProcess);
                    //if($listProcess === NULL){
                    //    goto end_batch;
                    //}

                    if($listProcess != NULL && count($listProcess) > 0){
                        foreach($listProcess as $friends){
                            //Lấy danh sách token để gửi yêu cầu kết bạn
                            $tokens = $this->GetListTokens($m_user_id);
                            $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Lấy danh sách token để gửi yêu cầu kết bạn',$tokens);
                            if($tokens != NULL && count($tokens)>0){
                                foreach($tokens as $token){
                                    try{
                                        //Gửi yêu cầu kết bạn
                                        $res = $curl->setAddFriend($token['token2'],$friends['uid']);

                                        //ACWLog::debug_var('test', $token['full_name']."->".$friends['uid']);

                                        $friend_param['m_friends_id'] = $friends['m_friends_id'];
                                        $friend_param['m_user_id'] = $m_user_id;
                                        if(isset($res['success']) == TRUE && $res['success'] == TRUE){
                                            //Kết bạn thành công
                                            $friend_param['status'] = 9;
                                            $model->updateFriendStatus($friend_param);
                                        }
                                        else{
                                            //Kết bạn thất bại
                                            $friend_param['status'] = 6;
                                            $model->updateFriendStatus($friend_param);
                                        }
                                    } catch (Exception $ex1) {
                                        //Kết bạn thất bại
                                        $friend_param['status'] = 6;
                                        $model->updateFriendStatus($friend_param);
                                    }
                                    //Tắt token sau 1 khoảng thời gian mới sử dụng lại được
                                    $model->updateTokenStatus([
                                        'm_token_id' => $token['m_token_id'],
                                        'm_user_id' => $m_user_id
                                    ]);
                                }
                            }
                            else{
                                //Không có token khả dụng thì update UID về trạng thái chưa xử lý
                                $friend_param['m_friends_id'] = $friends['m_friends_id'];
                                $friend_param['status'] = 0;
                                $model->updateFriendStatus($friend_param);
                            }
                            //test 1 lan chay
                            /*if(file_exists($fileLock) === TRUE) {
                                unlink($fileLock);
                                if($this->checkStopBatch($fileLock) == TRUE){
                                    goto end_batch;
                                }
                            }*/
                            break;// 1 token gửi kết bạn 1 lần rồi dừng 1 khoảng thời gian
                        }
                    }
                    //========================================
                    if($this->checkStopBatch($fileLock) == TRUE){
                        goto end_batch;
                    }
                } while(TRUE);

                end_batch:
                $this->Logging()->debugLog(__CLASS__, __FUNCTION__,'Dừng batch',$fileLock);
            }
            catch (Exception $e){
                if(file_exists($fileLock) === TRUE) {
                    unlink($fileLock);
                }
                //ACWLog::debug_var(LOG_FAIL, $e->getMessage());
            }
        }
    }
}

