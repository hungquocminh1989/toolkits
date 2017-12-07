<?php

class TableDefine extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=20, nullable=false)
     */
    protected $m_define_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $def_type;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $def_value;

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
     * Method to set the value of field m_define_id
     *
     * @param integer $m_define_id
     * @return $this
     */
    public function setMDefineId($m_define_id)
    {
        $this->m_define_id = $m_define_id;

        return $this;
    }

    /**
     * Method to set the value of field def_type
     *
     * @param string $def_type
     * @return $this
     */
    public function setDefType($def_type)
    {
        $this->def_type = $def_type;

        return $this;
    }

    /**
     * Method to set the value of field def_value
     *
     * @param string $def_value
     * @return $this
     */
    public function setDefValue($def_value)
    {
        $this->def_value = $def_value;

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
     * Returns the value of field m_define_id
     *
     * @return integer
     */
    public function getMDefineId()
    {
        return $this->m_define_id;
    }

    /**
     * Returns the value of field def_type
     *
     * @return string
     */
    public function getDefType()
    {
        return $this->def_type;
    }

    /**
     * Returns the value of field def_value
     *
     * @return string
     */
    public function getDefValue()
    {
        return $this->def_value;
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
        $this->setSchema("toolkits");
        $this->setSource("m_define");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'm_define';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MDefine[]|MDefine|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MDefine|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
