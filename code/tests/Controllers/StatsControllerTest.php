<?php
namespace IVIR3zaM\SimpleMoPortfolio\Tests\Controllers;

use Phalcon\Http\Request;
use IVIR3zaM\SimpleMoPortfolio\Reporters\MoReporter;

/**
 * Class StatsControllerTest
 * @package IVIR3zaM\SimpleMoPortfolio\Tests\Controllers
 */
class StatsControllerTest extends AbstractControllersTestCase
{
    public function testSummaryAction()
    {
        $count = 125;
        $span = ['1986-11-20 05:23:23', '2017-04-28 08:41:29'];

        $reporter = $this->getMockBuilder(MoReporter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $reporter->expects($this->any())
            ->method('getLastMoCount')
            ->will($this->returnValue($count));

        $reporter->expects($this->any())
            ->method('getTimeSpan')
            ->will($this->returnValue($span));

        $this->getDI()->setShared('reporter', function () use ($reporter) {
            return $reporter;
        });

        $response = $this->callController('stats', 'summary');
        $this->assertJson(json_encode([
            'last_15_min_mo_count' => $count,
            'time_span_last_10k' => $span,
        ]), $response);
    }
}