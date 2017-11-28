<?php

class TokenController extends ControllerBase
{

    public function getTokenAction()
    {
        //Ajax response
        $this->view->disable();
        $result = array('error_msg' => '');
        try{
            $params = $this->request->getPost();
            $model = new Token();
            $result = $model->run_get_token($params['email'],$params['pass']);
            return json_encode($result);

        } catch (Exception $e) {
            $result['error_msg'] = $this->getDefine()->EXCEPTION_CATCH_ERROR_MSG;
            return json_encode($result);
        }
    }

    public function getTokenMultiAction()
    {
        //Ajax response
        $this->view->disable();
        $result = array('error_msg' => '');
        try{
            $params = $this->request->getPost();
            $model = new Token();
            if($params['multi_line'] != ''){
                $multi_line = preg_replace("/\r\n|\r|\n/", '  ', $params['multi_line']);
                $arr_line = explode('  ',trim($multi_line));

                foreach($arr_line as $key => $value){
                    $arr_user = explode('|',$value);
                    if(count($arr_user) == 2){
                        $params['email'] = $arr_user[0];
                        $params['pass'] = $arr_user[1];
                        $res = $model->run_get_token($params['email'],$params['pass']);
                        //ACWLog::debug_var('get_multi_token',$value."=>".$res['error_msg']);
                    }
                }
                return json_encode($result);
            }
            else{
                $result['error_msg'] = 'No data.';
            }
            return json_encode($result);

        } catch (Exception $e) {
            $result['error_msg'] = $this->getDefine()->EXCEPTION_CATCH_ERROR_MSG;
            return json_encode($result);
        }
    }

}

