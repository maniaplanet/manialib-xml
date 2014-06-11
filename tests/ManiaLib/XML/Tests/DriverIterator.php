<?php

namespace ManiaLib\XML\Tests;

class DriverIterator implements \Iterator
{

    protected $drivers = array();
    protected $currentIndex = 0;

    function __construct(array $drivers = array())
    {
        if(!$drivers)
        {
            $this->drivers[] = '\ManiaLib\XML\Rendering\Drivers\XMLWriterDriver';
            $this->drivers[] = '\ManiaLib\XML\Rendering\Drivers\DOMDocumentDriver';
        }
    }

    public function current()
    {
        return $this->drivers[$this->currentIndex];
    }

    public function key()
    {
        return $this->currentIndex;
    }

    public function next()
    {
        $this->currentIndex++;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid()
    {
        return array_key_exists($this->currentIndex, $this->drivers);
    }

}
