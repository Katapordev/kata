<?php

namespace Joomla\Component\Kata\Administrator\Extension;
\defined('JPATH_PLATFORM') or die;
use Joomla\CMS\Component\Router\RouterServiceInterface;

use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\MVCComponent;
class KataComponent extends MVCComponent implements RouterServiceInterface

{
	use RouterServiceTrait;

}

