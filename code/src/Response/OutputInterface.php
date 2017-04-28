<?php
namespace IVIR3zaM\SimpleMoPortfolio\Response;

/**
 * Interface OutputInterface
 * @package IVIR3zaM\SimpleMoPortfolio\Response
 */
interface OutputInterface
{
    /**
     * Get the input when constructing object
     * @param array $object
     */
    public function __construct($object = null);

    /**
     * Get the name of the parameter and return the value
     * @param string $name
     * @return mixed The value of the parameter
     */
    public function __get($name);

    /**
     * Get the name and the value of a parameter and set into internal stack
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value);

    /**
     * Get the name of the parameter and unset it from the internal stack
     * @param string $name
     * @return void
     */
    public function __unset($name);

    /**
     * @return string Json encoded
     */
    public function __toString();

    /**
     * @param array $object
     * @return OutputInterface
     */
    public function setFromInput($object);

    /**
     * @return array
     */
    public function toArray();
}