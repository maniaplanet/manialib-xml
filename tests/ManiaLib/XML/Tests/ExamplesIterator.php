<?php

namespace ManiaLib\XML\Tests;

use Iterator;
use Symfony\Component\Finder\Finder;

class ExamplesIterator implements Iterator
{

	protected $tests = array();
	protected $currentIndex = null;
	protected $keys = array();

	public function __construct()
	{
		$config = new Config();
		$examplesPath = $config->getExamplePaths();
		$examplesFinder = new Finder();
		foreach($examplesPath as $path)
		{
			if(is_dir($path))
			{
				$examplesFinder->in($path);
			}
		}
		$examplesFinder->files()->name('*.php');

		foreach($examplesFinder as $file)
		{
			$expect = str_ireplace('.php', '.xml', $file->getRealpath());
			if(!file_exists($expect))
			{
				continue;
			}
			$node = require $file->getRealPath();
			$this->tests[$file->getBasename($file->getExtension())] = array($node, $expect);
			$this->currentIndex = 0;
			$this->keys = array_keys($this->tests);
		}
	}

	public function current()
	{
		return $this->tests[$this->keys[$this->currentIndex]];
	}

	public function key()
	{
		return $this->keys[$this->currentIndex];
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
		return array_key_exists($this->currentIndex, $this->keys);
	}

}
