<?php
namespace IVIR3zaM\SimpleMoPortfolio\Tests;

use IVIR3zaM\SimpleMoPortfolio\Mo;
use IVIR3zaM\SimpleMoPortfolio\MoInterface;
use \PHPUnit_Framework_TestCase;

/**
 * Class MoTest
 * @package IVIR3zaM\SimpleMoPortfolio\Tests
 */
class MoTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var MoInterface
     */
    private $mo;

    public function setUp()
    {
        $this->mo = new Mo();
    }

    public function testSetterGetters()
    {
        $this->mo->setMsisdn(1);
        $this->mo->setOperatorId(2);
        $this->mo->setShortcodeId(3);
        $this->mo->setText('Some Text');

        $this->assertEquals(1, $this->mo->getMsisdn());
        $this->assertEquals(2, $this->mo->getOperatorId());
        $this->assertEquals(3, $this->mo->getShortcodeId());
        $this->assertEquals('Some Text', $this->mo->getText());
    }

    public function testSetFromArray()
    {
        $input = [
            'msisdn' => 1,
            'OperatorId' => 2,
            'shortCodeid' => 3,
            'TEXT' => 'Some Text',
        ];

        $this->mo->setFromArray($input);
        $this->assertEquals(1, $this->mo->getMsisdn());
        $this->assertEquals(2, $this->mo->getOperatorId());
        $this->assertEquals(3, $this->mo->getShortcodeId());
        $this->assertEquals('Some Text', $this->mo->getText());
    }
}