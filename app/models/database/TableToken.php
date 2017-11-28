<?php

class TableToken extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=20, nullable=false)
     */
    protected $m_token_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $user;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $pass;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=20, nullable=false)
     */
    protected $user_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $cookie;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $token1;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $token2;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $full_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $friends_count;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $last_use_datetime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $use_flg;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $info_status;

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
     * Method to set the value of field m_token_id
     *
     * @param integer $m_token_id
     * @return $this
     */
    public function setMTokenId($m_token_id)
    {
        $this->m_token_id = $m_token_id;

        return $this;
    }

    /**
     * Method to set the value of field user
     *
     * @param string $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

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
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field cookie
     *
     * @param string $cookie
     * @return $this
     */
    public function setCookie($cookie)
    {
        $this->cookie = $cookie;

        return $this;
    }

    /**
     * Method to set the value of field token1
     *
     * @param string $token1
     * @return $this
     */
    public function setToken1($token1)
    {
        $this->token1 = $token1;

        return $this;
    }

    /**
     * Method to set the value of field token2
     *
     * @param string $token2
     * @return $this
     */
    public function setToken2($token2)
    {
        $this->token2 = $token2;

        return $this;
    }

    /**
     * Method to set the value of field full_name
     *
     * @param string $full_name
     * @return $this
     */
    public function setFullName($full_name)
    {
        $this->full_name = $full_name;

        return $this;
    }

    /**
     * Method to set the value of field friends_count
     *
     * @param integer $friends_count
     * @return $this
     */
    public function setFriendsCount($friends_count)
    {
        $this->friends_count = $friends_count;

        return $this;
    }

    /**
     * Method to set the value of field last_use_datetime
     *
     * @param string $last_use_datetime
     * @return $this
     */
    public function setLastUseDatetime($last_use_datetime)
    {
        $this->last_use_datetime = $last_use_datetime;

        return $this;
    }

    /**
     * Method to set the value of field use_flg
     *
     * @param integer $use_flg
     * @return $this
     */
    public function setUseFlg($use_flg)
    {
        $this->use_flg = $use_flg;

        return $this;
    }

    /**
     * Method to set the value of field info_status
     *
     * @param integer $info_status
     * @return $this
     */
    public function setInfoStatus($info_status)
    {
        $this->info_status = $info_status;

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
     * Returns the value of field m_token_id
     *
     * @return integer
     */
    public function getMTokenId()
    {
        return $this->m_token_id;
    }

    /**
     * Returns the value of field user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
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
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field cookie
     *
     * @return string
     */
    public function getCookie()
    {
        return $this->cookie;
    }

    /**
     * Returns the value of field token1
     *
     * @return string
     */
    public function getToken1()
    {
        return $this->token1;
    }

    /**
     * Returns the value of field token2
     *
     * @return string
     */
    public function getToken2()
    {
        return $this->token2;
    }

    /**
     * Returns the value of field full_name
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * Returns the value of field friends_count
     *
     * @return integer
     */
    public function getFriendsCount()
    {
        return $this->friends_count;
    }

    /**
     * Returns the value of field last_use_datetime
     *
     * @return string
     */
    public function getLastUseDatetime()
    {
        return $this->last_use_datetime;
    }

    /**
     * Returns the value of field use_flg
     *
     * @return integer
     */
    public function getUseFlg()
    {
        return $this->use_flg;
    }

    /**
     * Returns the value of field info_status
     *
     * @return integer
     */
    public function getInfoStatus()
    {
        return $this->info_status;
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
        $this->setSource("m_token");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'm_token';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MToken[]|MToken|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MToken|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
