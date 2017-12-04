<?php

class HiddenBatch extends ModelBase
{
    public function getActiveTokenList($m_user_id)
    {
        try
        {
            $sql_update = "
                UPDATE m_token
                SET use_flg = 1 
                WHERE 
                    (TIME_TO_SEC(TIMEDIFF(NOW(),last_use_datetime)) >= 30 OR last_use_datetime IS NULL)
                    AND info_status = 1 AND (use_flg = 0 OR use_flg IS NULL)
                    AND m_user_id = :m_user_id
                ORDER BY m_token_id
                LIMIT ".$this->getDefine()->TOKEN->LIMIT_TOKEN_REQUEST.";
            ";

            if($this->sqlExecute($sql_update,['m_user_id'=>$m_user_id]) === TRUE){
                $sql = "
                    SELECT
                        *
                    FROM
                        m_token
                    WHERE 
                        (TIME_TO_SEC(TIMEDIFF(NOW(),last_use_datetime)) >= 30 OR last_use_datetime IS NULL)
                        AND info_status = 1 AND use_flg = 1
                        AND m_user_id = :m_user_id
                    ORDER BY m_token_id
                    LIMIT ".$this->getDefine()->TOKEN->LIMIT_TOKEN_REQUEST.";
                ";
                $result = $this->sqlQuery($sql,['m_user_id'=>$m_user_id]);
                if($result != NULL && count($result) > 0){
                    return $result;
                }
            }
            return NULL;
        }
        catch (Exception $ex){
            return NULL;
        }
    }

    public function getFriendListProcess($m_user_id)
    {
        try
        {
            $sql_update = "
                UPDATE m_friends
                SET status = 1 
                WHERE status = 0
                AND m_user_id = :m_user_id
                ORDER BY m_friends_id
                LIMIT 1;
            ";

            if($this->sqlExecute($sql_update,['m_user_id'=>$m_user_id]) === TRUE){
                $sql = "
                    SELECT
                        *
                    FROM
                        m_friends
                    WHERE
                        status = 1	
                    AND m_user_id = :m_user_id
                    ORDER BY 
                        m_friends_id
                    LIMIT 1;	
                ";
                $result = $this->sqlQuery($sql,['m_user_id'=>$m_user_id]);
                if($result != NULL && count($result) > 0){
                    return $result;
                }
            }
            return NULL;
        }
        catch (Exception $ex){
            return NULL;
        }
    }

    public function updateTokenStatus($param){
        try
        {
        	$sql_update = "
                UPDATE m_token
				SET use_flg = 0 
					,last_use_datetime = NOW()
				WHERE 
					m_token_id = :m_token_id and m_user_id = :m_user_id;
            ";
            
            $result = $this->sqlExecute($sql_update,$param);

            return TRUE;
        }
        catch (Exception $ex){
            return FALSE;
        }
    }

    public function updateFriendStatus($param){
        try
        {
            $record = TableFriends::find(
                [
                    'm_friends_id = :m_friends_id: AND status != :status: AND m_user_id = :m_user_id:',
                    'bind' => [
                        'm_user_id' => $param['m_user_id'],
                        'm_friends_id' => $param['m_friends_id'],
                        'status' => $param['status']
                    ]
                ]
            );

            if($record != NULL && count($record) > 0){
                $record->getFirst()->setStatus($param['status']);
                $record->getFirst()->save();

                return TRUE;
            }
            return FALSE;
        }
        catch (Exception $ex){
            return FALSE;
        }
    }

}