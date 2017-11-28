<?php

class TableUser extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=20, nullable=false)
     */
    protected $m_user_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $user_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $user_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $pass;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $del_flg;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $add_datetime;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $upd_datetime;

    /**
     * Method to set the value of field m_user_id
     *
     * @param integer $m_user_id
     * @return $this
     */
    public function setMUserId($m_user_id)
    {
        $this->m_user_id = $m_user_id;

        return $this;
    }

    /**
     * Method to set the value of field user_id
     *
     * @param string $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field user_name
     *
     * @param string $user_name
     * @return $this
     */
    public function setUserName($user_name)
    {
        $this->user_name = $user_name;

        return $this;
    }

    /**
     * Method to set the value of field pass
     *
     * @param string $pass
     * @return $this
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Method to set the value of field del_flg
     *
     * @param integer $del_flg
     * @return $this
     */
    public function setDelFlg($del_flg)
    {
        $this->del_flg = $del_flg;

        return $this;
    }

    /**
     * Method to set the value of field add_datetime
     *
     * @param string $add_datetime
     * @return $this
     */
    public function setAddDatetime($add_datetime)
    {
        $this->add_datetime = $add_datetime;

        return $this;
    }

    /**
     * Method to set the value of field upd_datetime
     *
     * @param string $upd_datetime
     * @return $this
     */
    public function setUpdDatetime($upd_datetime)
    {
        $this->upd_datetime = $upd_datetime;

        return $this;
    }

    /**
     * Returns the value of field m_user_id
     *
     * @return integer
     */
    public function getMUserId()
    {
        return $this->m_user_id;
    }

    /**
     * Returns the value of field user_id
     *
     * @return string
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field user_name
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->user_name;
    }

    /**
     * Returns the value of field pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Returns the value of field del_flg
     *
     * @return integer
     */
    public function getDelFlg()
    {
        return $this->del_flg;
    }

    /**
     * Returns the value of field add_datetime
     *
     * @return string
     */
    public function getAddDatetime()
    {
        return $this->add_datetime;
    }

    /**
     * Returns the value of field upd_datetime
     *
     * @return string
     */
    public function getUpdDatetime()
    {
        return $this->upd_datetime;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        //$this->setSchema("u952687329_dev");
        $this->setSource("m_user");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'm_user';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MUser[]|MUser|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MUser|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
