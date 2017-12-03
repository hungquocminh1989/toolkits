<?php

class TokenController extends ControllerBase
{

    public function getTokenAction()
    {
        //Ajax response
        $this->view->disable();
        $arrResponse = array(
                        'status' => 'NG',
                        'error_msg' => ''
        );
        try{
            $params = $this->request->getPost();
            $this->debugLog(__CLASS__, __FUNCTION__,'Lấy token',$params);

            $model = new Token();
            $arrResponse = $model->run_get_token($params['email'],$params['pass']);
            $this->debugLog(__CLASS__, __FUNCTION__,'Lấy token thành công',$arrResponse);

            return json_encode($arrResponse);

        } catch (Exception $e) {
            $arrResponse['error_msg'] = $this->getDefine()->EXCEPTION_CATCH_ERROR_MSG;
            $this->debugLog(__CLASS__, __FUNCTION__,'Lỗi bất thường',$arrResponse);

            return json_encode($arrResponse);
        }
    }

    public function getTokenMultiAction()
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
            if($params['multi_line'] != ''){
                $multi_line = preg_replace("/\r\n|\r|\n/", '  ', $params['multi_line']);
                $arr_line = explode('  ',trim($multi_line));
                $iOK = 0;
                foreach($arr_line as $key => $value){
                    $arr_user = explode('|',$value);
                    if(count($arr_user) == 2){
                        $params['email'] = $arr_user[0];
                        $params['pass'] = $arr_user[1];
                        $res = $model->run_get_token($params['email'],$params['pass']);
                        if($res['error_msg'] == ''){
							$iOK = $iOK + 1;
						}
                    }
                }
                $arrResponse['status'] = 'OK';
                $arrResponse['result_count'] = $iOK.'/'.count($arr_line);
                $this->debugLog(__CLASS__, __FUNCTION__,'Lấy token hàng loạt',$arr_line);
                $this->debugLog(__CLASS__, __FUNCTION__,'Kết quả',$arrResponse);

                return json_encode($arrResponse);
            }
            else{
                $arrResponse['error_msg'] = 'No data.';
                return json_encode($arrResponse);
            }

        } catch (Exception $e) {
            $arrResponse['error_msg'] = $this->getDefine()->EXCEPTION_CATCH_ERROR_MSG;
            $this->debugLog(__CLASS__, __FUNCTION__,'Có lỗi xảy ra',$arrResponse);

            return json_encode($arrResponse);
        }
    }

}

