<?php

namespace ManiaLib\XML\Tests;

class Config
{

	protected $examplePaths;

	function __construct()
	{
		$this->examplePaths = array(
			__DIR__.'/../../../../examples/',
		);
	}

	public function getExamplePaths()
	{
		return $this->examplePaths;
	}

}
