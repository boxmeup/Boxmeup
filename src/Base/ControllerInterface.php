<?php

namespace Boxmeup\Web\Base;

interface ControllerInterface
{
	/**
	 * Constructor.
	 *
	 * @param Application $app
	 * @return void
	 */
	public function __construct(Application $app);
}
