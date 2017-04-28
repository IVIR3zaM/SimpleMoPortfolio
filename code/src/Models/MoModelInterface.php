<?php
namespace IVIR3zaM\SimpleMoPortfolio\Models;

use IVIR3zaM\SimpleMoPortfolio\MoInterface;
use DateTime;

/**
 * Interface MoModelInterface
 * @package IVIR3zaM\SimpleMoPortfolio\Models
 */
interface MoModelInterface extends MoInterface
{
    public function getId();

    /**
     * @return string
     */
    public function getAuthToken();

    /**
     * @param string $token
     * @return $this
     */
    public function setAuthToken($token);

    /**
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * @param DateTime $date
     * @return $this
     */
    public function setCreatedAt(DateTime $date);
}