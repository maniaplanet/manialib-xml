<?php

namespace ManiaLib\XML\Tests;

use ManiaLib\XML\Rendering\Drivers\XMLWriterDriver;

class ExamplesWithXMLWriterDriverTest extends AbstractExamplesText
{
	protected function getDriver()
	{
		return new XMLWriterDriver();
	}

}
