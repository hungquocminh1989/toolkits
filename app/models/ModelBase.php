<?php

class ModelBase extends \Phalcon\Mvc\Model
{
    public function sqlQuery($sql,$param = [])
    {
        try
        {
            $db = $this->getDI()->getDb();

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
            $db = $this->getDI()->getDb();

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

}