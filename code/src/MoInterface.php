<?php
namespace IVIR3zaM\SimpleMoPortfolio;

/**
 * Interface MoInterface
 * Global Mo object interface
 * @package IVIR3zaM\SimpleMoPortfolio
 */
interface MoInterface
{
    /**
     * @param array $data An associative array with keys equals to getter-setters
     * @return $this
     */
    public function setFromArray($data);

    /**
     * @return array An associate array of this Mo properties
     */
    public function getArray();

    /**
     * @return number
     */
    public function getMsisdn();

    /**
     * @param number $value
     * @return $this
     */
    public function setMsisdn($value);

    /**
     * @return number
     */
    public function getOperatorId();

    /**
     * @param number $value
     * @return $this
     */
    public function setOperatorId($value);

    /**
     * @return number
     */
    public function getShortcodeId();

    /**
     * @param number $value
     * @return $this
     */
    public function setShortcodeId($value);

    /**
     * @return string
     */
    public function getText();

    /**
     * @param string $value
     * @return $this
     */
    public function setText($value);
}