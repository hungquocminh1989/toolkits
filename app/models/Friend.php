<?php

class Friend extends ModelBase
{
    public function getFriends()
    {
        try
        {
            $sql = "
                    SELECT
                        *
                        ,CASE 	WHEN status = 0 THEN 'Chưa Xử Lý'
                                WHEN status = 1 THEN 'Chờ Xử Lý'
                                WHEN status = 9 THEN 'Thành Công'
                                WHEN status = 6 THEN 'Thất Bại'
                                ELSE 'Không Xác Định'
                        END as status_text
                    FROM
                        m_friends
                      WHERE m_user_id = :m_user_id
                    ORDER BY 
                        m_friends_id	
                ";
            $sql_param = [
                'm_user_id' => $this->getSession()->get($this->getDefine()->SESSION->SESS_LOGIN_USER)
            ];
            $result = $this->sqlQuery($sql,$sql_param);
            if($result != NULL && count($result) > 0){
                return $result;
            }
            return NULL;
        }
        catch (Exception $ex){
            return NULL;
        }
    }

    public function insertFriend($param)
    {
        try
        {
            $sql = "
                    INSERT INTO m_friends (m_user_id, uid, name, status, upd_datetime)
			        VALUES (:m_user_id,:uid,:name, 0, NOW());
                ";
            $sql_arr = [
                'm_user_id' => $this->getSession()->get($this->getDefine()->SESSION->SESS_LOGIN_USER),
                'uid' => $param['uid'],
                'name' => $param['name']
            ];

            $result = $this->sqlExecute($sql,$sql_arr);
            if($result != NULL && count($result) > 0){
                return $result;
            }
            return FALSE;
        }
        catch (Exception $ex){
            return FALSE;
        }
    }

}