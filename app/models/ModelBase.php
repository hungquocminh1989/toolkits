<?php
use Phalcon\Mvc\Model;
use Phalcon\Logger\Adapter\File as FileAdapter;

class ModelBase extends Model
{
	/**
	* ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
	* Start Sample function
	*/
	public function sampleQuery()
    {
    	//Select một dòng và trả ra 1 column duy nhất
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
        
        //Select nhiều dòng trả ra Array
        try
        {
            $record = TableUser::find(
                [
                    'pass = :passwd: AND user_id = :user_id: ',
                    'bind' => $params,
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
        
        //Select nhiều dòng trả ra ObjectDatabase
        try
        {
            $record = TableUser::find(
                [
                    'pass = :passwd: AND user_id = :user_id: ',
                    'bind' => $params,
                ]
            );
            if($record != NULL && count($record) > 0){
                return $record;
            }
            return NULL;
        }
        catch (Exception $ex){
            return NULL;
        }
    }
    /**
	* End Sample function
	* ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
	*/
	
    public function sqlQuery($sql,$param = [])
    {
        try
        {
            $db = $this->getDb();

            $result = $db->query($sql,$param);

            if($result != NULL && count($result) > 0){
                return $result->fetchAll();
            }
            return NULL;
        }
        catch (Exception $ex){
            return NULL;
        }
    }

    public function sqlExecute($sql,$param = [])
    {
        try
        {
            $db = $this->getDb();

            $result = $db->execute($sql,$param);

            return $result;
        }
        catch (Exception $ex){
            return FALSE;
        }
    }

    public function getDefine()
    {
        return $this->getDI()->getDefine();
    }

    public function getSession()
    {
        return $this->getDI()->getSession();
    }

    public function getConfig()
    {
        return $this->getDI()->getConfig();
    }

    public function getUrl()
    {
        return $this->getDI()->getUrl();
    }
    
    public function getDb()
    {
        return $this->getDI()->getDb();
    }

}