<?php
namespace IVIR3zaM\SimpleMoPortfolio\Models;

use DateTime;

trait MoModelTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $auth_token;

    /**
     * @var string
     */
    protected $created_at;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->auth_token;
    }

    /**
     * @param string $token
     * @return $this
     */
    public function setAuthToken($token)
    {
        $this->auth_token = (string) $token;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return new DateTime($this->created_at);
    }

    /**
     * @param DateTime $date
     * @return $this
     */
    public function setCreatedAt(DateTime $date)
    {
        $this->created_at = $date->format('Y/m/d H:i:s');
        return $this;
    }
}