<?php
namespace IVIR3zaM\SimpleMoPortfolio\Tests\Response;

use IVIR3zaM\SimpleMoPortfolio\Response\Output;
use IVIR3zaM\SimpleMoPortfolio\Response\OutputInterface;
use \PHPUnit_Framework_TestCase;

/**
 * Class OutputTest
 * @package IVIR3zaM\SimpleMoPortfolio\Tests\Response
 */
class OutputTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var OutputInterface
     */
    private $output;

    public function setUp()
    {
        $this->output = new Output();
    }

    public function testConstruct()
    {
        $input = ['Foo' => 'Bar'];
        $this->output = new Output($input);

        $this->assertEquals($input, $this->output->toArray());
    }

    public function testSetFromInput()
    {
        $input = ['Foo' => 'Bar'];
        $this->output->setFromInput($input);

        $this->assertEquals($input, $this->output->toArray());
    }

    public function testSetGetUnsetParameters()
    {
        $input = 'SomeData';
        $this->output->test = $input;
        $this->assertEquals($input, $this->output->test);

        unset($this->output->test);
        $this->assertNull($this->output->test);
    }

    public function testJsonOutput()
    {
        $this->output->Foo = 'Bar';

        $this->assertEquals(json_encode(['Foo' => 'Bar']), (string) $this->output);
    }

    public function testNestedInput()
    {
        $input = [
            'Foo' => 'Bar',
            'Nested' => [
                'Bar' => 'Foo',
            ],
            'Lorem Ipsum',
        ];
        $this->output->setFromInput($input);

        $this->assertEquals($input, $this->output->toArray());
        $this->assertEquals(json_encode($input), (string) $this->output);
    }
}