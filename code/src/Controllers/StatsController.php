<?php
namespace IVIR3zaM\SimpleMoPortfolio\Controllers;

use Phalcon\Http\ResponseInterface;
use DateTime;

/**
 * Class StatsController
 * @package IVIR3zaM\SimpleMoPortfolio\Controllers
 */
class StatsController extends AbstractJsonOutputController
{
    /**
     * Send a summary of the system stats to the output
     * @return ResponseInterface
     */
    public function summaryAction()
    {
        $reporter = $this->getDI()->get('reporter');

        $this->getOutput()->last_15_min_mo_count = $reporter->getLastMoCount(new DateTime('15 minutes ago'));
        $this->getOutput()->time_span_last_10k = $reporter->getTimeSpan(10000);
        return $this->initResponse();
    }
}