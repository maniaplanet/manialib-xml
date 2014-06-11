<?php

namespace ManiaLib\XML\Tests;

use ManiaLib\XML\NodeInterface;
use ManiaLib\XML\Rendering\DriverInterface;
use ManiaLib\XML\Rendering\Renderer;
use PHPUnit_Framework_TestCase;

class ExamplesTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Renderer
     */
    protected $renderer;

    protected function setUp()
    {
        $this->renderer = new Renderer();
    }

    public function getNodes()
    {
        $exampleIterator = new ExampleIterator();
        $driverIterator = new DriverIterator();

        $tests = array();
        foreach($exampleIterator as $name => $example)
        {
            foreach($driverIterator as $driver)
            {
                $tests[$name.'|'.$driver] = array_merge(array(new $driver()), $example);
            }
        }
        return $tests;
    }

    /**
     * @dataProvider getNodes
     */
    public function testExample(DriverInterface $driver, NodeInterface $node, $expectedResult)
    {
        $this->renderer->setRoot($node);
        $driver->setEventDispatcher($this->renderer->getEventDispatcher());
        $this->renderer->setDriver($driver);
        $this->assertXmlStringEqualsXmlFile($expectedResult, $this->renderer->getXML());
    }

}
