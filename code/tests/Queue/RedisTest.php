<?php
namespace IVIR3zaM\SimpleMoPortfolio\Tests\Queue;

use IVIR3zaM\SimpleMoPortfolio\Mo;
use IVIR3zaM\SimpleMoPortfolio\Queue\Redis;
use \PHPUnit_Framework_TestCase;

/**
 * Class RedisTest
 * @package IVIR3zaM\SimpleMoPortfolio\Tests\Queue
 */
class RedisTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Redis
     */
    private $queue;

    public function setUp()
    {
        $this->queue = new Redis(['list' => 'TestingList']);
        $this->queue->clear();
    }

    public function testPushPop()
    {
        $mo = new Mo(['text' => 'Some Data']);
        $this->queue->push($mo);
        $mo = $this->queue->pop();

        $this->assertInstanceOf(Mo::class, $mo);
        $this->assertEquals('Some Data', $mo->getText());
    }

    public function testIsFIFO()
    {
        $this->queue->push(new Mo(['text' => 'First Object']))
            ->push(new Mo(['text' => 'Second Object']))
            ->push(new Mo(['text' => 'Third Object']));

        $mo = $this->queue->pop();
        $this->assertInstanceOf(Mo::class, $mo);
        $this->assertEquals('First Object', $mo->getText());

        $mo = $this->queue->pop();
        $this->assertInstanceOf(Mo::class, $mo);
        $this->assertEquals('Second Object', $mo->getText());

        $mo = $this->queue->pop();
        $this->assertInstanceOf(Mo::class, $mo);
        $this->assertEquals('Third Object', $mo->getText());
    }

    public function testCount()
    {
        $this->assertEquals(0, $this->queue->count());

        $this->queue->push(new Mo(['text' => 'First Object']));
        $this->assertEquals(1, $this->queue->count());

        $this->queue->push(new Mo(['text' => 'Second Object']));
        $this->assertEquals(2, $this->queue->count());

        $this->queue->push(new Mo(['text' => 'Third Object']));
        $this->assertEquals(3, $this->queue->count());

        $this->queue->pop();
        $this->assertEquals(2, $this->queue->count());
    }

    public function testClear()
    {
        $this->queue->push(new Mo(['text' => 'First Object']))
            ->push(new Mo(['text' => 'Second Object']))
            ->push(new Mo(['text' => 'Third Object']));
        $this->assertEquals(3, $this->queue->count());

        $this->queue->clear();
        $this->assertEquals(0, $this->queue->count());
    }

    public function testChangeListName()
    {
        $name = $this->queue->getListName();
        $this->queue->push(new Mo(['text' => 'First Object']));
        $this->assertEquals(1, $this->queue->count());

        $this->queue->setListName('FreakList');
        $this->queue->clear();
        $this->assertEquals(0, $this->queue->count());


        $this->queue->setListName($name);
        $this->assertEquals(1, $this->queue->count());
    }
}