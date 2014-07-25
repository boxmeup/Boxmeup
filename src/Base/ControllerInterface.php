<?php

namespace Boxmeup\Web\Base;

interface ControllerInterface
{
	/**
	 * Constructor.
	 *
	 * @param Boxmeup\Web\Application $app
	 */
	public function __construct(Application $app);
}
