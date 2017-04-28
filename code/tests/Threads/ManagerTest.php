<?php
namespace IVIR3zaM\SimpleMoPortfolio\Tests\Threads;

use IVIR3zaM\SimpleMoPortfolio\Threads\ManagerInterface;
use IVIR3zaM\SimpleMoPortfolio\Threads\Manager;
use \PHPUnit_Framework_TestCase;

/**
 * Class ManagerTest
 * @package IVIR3zaM\SimpleMoPortfolio\Tests\Threads
 */
class ManagerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ManagerInterface
     */
    private $manager;

    public function setUp()
    {
        $this->manager = new Manager();
    }

    public function testCurrentLoad()
    {
        $current = Manager::getLoadPercentage();
        $this->assertGreaterThanOrEqual(0, $current);
        $this->assertLessThan(10000, $current);
    }

    public function testMaxLoadChanges()
    {
        $this->manager->setMaxLoad(-1);
        $this->assertEquals(1, $this->manager->getMaxLoad());

        $this->manager->setMaxLoad(10);
        $this->assertEquals(10, $this->manager->getMaxLoad());

        $this->manager->setMaxLoad(100);
        $this->assertEquals(100, $this->manager->getMaxLoad());

        $this->manager->setMaxLoad(70);
        $this->assertEquals(70, $this->manager->getMaxLoad());

        $this->manager->setMaxLoad(200);
        $this->assertEquals(200, $this->manager->getMaxLoad());

        $this->manager->setMaxLoad(10001);
        $this->assertEquals(10000, $this->manager->getMaxLoad());
    }

    public function testMaxLoadBalance()
    {
        $current = Manager::getLoadPercentage();

        if ($current < 90) {
            $current += 9;
            $this->manager->setMaxLoad($current);
            $this->manager->setSleep(100000);
            $count = $this->manager->runCommand(PHP_BINARY . ' ' . __DIR__ . '/HeavyDuty.php', 1);
            $this->assertEquals(1, $count);
            $this->manager->runCommand(PHP_BINARY . ' ' . __DIR__ . '/HeavyDuty.php');
            $this->assertGreaterThan($current - 9, Manager::getLoadPercentage());
        } else {
            $this->markTestSkipped(sprintf('load is over 90%% (%s%%), so test skipped', $current));
        }
    }
}