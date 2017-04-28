<?php
namespace IVIR3zaM\SimpleMoPortfolio\Response;

/**
 * Class Output
 * A holder of output data for using as json api
 * @package IVIR3zaM\SimpleMoPortfolio\Response
 */
class Output implements OutputInterface
{
    /**
     * @var array
     */
    protected $object;

    /**
     * Get the input when constructing object
     * @param array $object
     */
    public function __construct($object = null)
    {
        $this->setFromInput($object);
    }

    /**
     * Get the name of the parameter and return the value
     * @param string $name
     * @return mixed The value of the parameter
     */
    public function __get($name)
    {
        if (isset($this->object[$name])) {
            return $this->object[$name];
        }
    }

    /**
     * Get the name and the value of a parameter and set into internal stack
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        if (is_array($value)) {
            $value = new self($value);
        }
        $this->object[$name] = $value;
    }

    /**
     * Get the name of the parameter and unset it from the internal stack
     * @param string $name
     * @return void
     */
    public function __unset($name)
    {
        if (isset($this->object[$name])) {
            unset($this->object[$name]);
        }
    }

    /**
     * @return string Json encoded
     */
    public function __toString()
    {
        return json_encode($this->toArray());
    }

    /**
     * @param array $object
     * @return OutputInterface
     */
    public function setFromInput($object)
    {
        $this->object = [];
        if (is_array($object)) {
            foreach ($object as $name => $value) {
                $this->__set($name, $value);
            }
        }
        return $this;
    }

    /**
     * Convert internal stack to an array
     * @return array
     */
    public function toArray()
    {
        $list = [];
        foreach ($this->object as $name => $value) {
            if (is_object($value)) {
                if (!method_exists($value, 'toArray')) {
                    continue;
                }
                $value = $value->toArray();
            }
            $list[$name] = $value;
        }
        return $list;
    }
}