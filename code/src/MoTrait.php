<?php
namespace IVIR3zaM\SimpleMoPortfolio;

/**
 * Trait MoTrait
 * This trait implements MoInterface completely
 * @package IVIR3zaM\SimpleMoPortfolio
 */
trait MoTrait
{
    /**
     * @var number
     */
    protected $msisdn;

    /**
     * @var number
     */
    protected $operatorid;

    /**
     * @var number
     */
    protected $shortcodeid;

    /**
     * @var string
     */
    protected $text;

    /**
     * @param array $data An associative array with keys equals to getter-setters
     * @return $this
     */
    public function setFromArray($data)
    {
        if (is_array($data)) {
            foreach ($data as $name => $value) {
                $name = ucfirst(strtolower($name));
                $name = str_replace('id', 'Id', $name);
                $name = 'set' . $name;
                if (method_exists($this, $name)) {
                    $this->$name($value);
                }
            }
        }
        return $this;
    }

    /**
     * @return array An associate array of this Mo properties
     */
    public function getArray()
    {
        return [
            'msisdn' => $this->getMsisdn(),
            'operatorid' => $this->getOperatorId(),
            'shortcodeid' => $this->getShortcodeId(),
            'text' => $this->getText(),
        ];
    }

    /**
     * @return number
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * @param number $value
     * @return $this
     */
    public function setMsisdn($value)
    {
        $this->msisdn = $value;
        return $this;
    }

    /**
     * @return number
     */
    public function getOperatorId()
    {
        return $this->operatorid;
    }

    /**
     * @param number $value
     * @return $this
     */
    public function setOperatorId($value)
    {
        $this->operatorid = $value;
        return $this;
    }

    /**
     * @return number
     */
    public function getShortcodeId()
    {
        return $this->shortcodeid;
    }

    /**
     * @param number $value
     * @return $this
     */
    public function setShortcodeId($value)
    {
        $this->shortcodeid = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setText($value)
    {
        $this->text = $value;
        return $this;
    }
}