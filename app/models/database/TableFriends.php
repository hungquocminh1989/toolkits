<?php

class TableFriends extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=20, nullable=false)
     */
    protected $m_friends_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=20, nullable=true)
     */
    protected $m_user_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=20, nullable=true)
     */
    protected $uid;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=255, nullable=true)
     */
    protected $status;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $upd_datetime;

    /**
     * Method to set the value of field m_friends_id
     *
     * @param integer $m_friends_id
     * @return $this
     */
    public function setMFriendsId($m_friends_id)
    {
        $this->m_friends_id = $m_friends_id;

        return $this;
    }

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
     * Method to set the value of field uid
     *
     * @param integer $uid
     * @return $this
     */
    public function setUid($uid)
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field status
     *
     * @param integer $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

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
     * Returns the value of field m_friends_id
     *
     * @return integer
     */
    public function getMFriendsId()
    {
        return $this->m_friends_id;
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
     * Returns the value of field uid
     *
     * @return integer
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
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
        $this->setSchema("toolkits");
        $this->setSource("m_friends");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'm_friends';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MFriends[]|MFriends|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MFriends|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
