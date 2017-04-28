<?php
namespace IVIR3zaM\SimpleMoPortfolio;

/**
 * Class Mo
 * This is the base Mo class and have the main functionality of an Mo object
 * @package IVIR3zaM\SimpleMoPortfolio
 */
class Mo implements MoInterface
{
    use MoTrait;

    /**
     * @param null|array $data
     */
    public function __construct($data = null)
    {
        $this->setFromArray($data);
    }

    public function __sleep()
    {
        return array_keys($this->getArray());
    }
}