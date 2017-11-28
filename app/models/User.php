<?php

class User extends ModelBase
{

    public function checkLoginData($params)
    {
        try
        {
            $record = TableUser::find(
                [
                    'pass = :passwd: AND user_id = :user_id: ',
                    'bind' => $params,
                ]
            );
            if($record != NULL && count($record) == 1){
                return $record->getFirst()->getMUserId();
            }
            return FALSE;
        }
        catch (Exception $ex){
            return FALSE;
        }
    }

}