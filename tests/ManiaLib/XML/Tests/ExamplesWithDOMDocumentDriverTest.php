<?php

namespace ManiaLib\XML\Tests;

use ManiaLib\XML\Rendering\Drivers\DOMDocumentDriver;

class ExamplesWithDOMDocumentDriverTest extends AbstractExamplesText
{

	protected function getDriver()
	{
		return new DOMDocumentDriver();
	}

}
