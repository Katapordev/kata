<?php
namespace Kata\Component\Kata\Site\Controller;
defined('_JEXEC') or die;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Router\Route;
class DisplayController extends BaseController

{
	public function display($cachable = false, $urlparams = array())
	{
		$cachable = true;

		$safeurlparams = array(
			'f'    => 'INT',
			'lang' => 'CMD'
		);

		return parent::display($cachable, $safeurlparams);
	}

}

