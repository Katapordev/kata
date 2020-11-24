<?php

/**

 * @package     Mywalks.Site

 * @subpackage  com_mywalks

 *

 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.

 * @license     GNU General Public License version 2 or later; see LICENSE.txt

 */



namespace Kata\Component\Katas\Site\Controller;



defined('_JEXEC') or die;



use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Router\Route;

/**

 * Mywalks Component Controller

 *

 * @since  1.5

 */

class DisplayController extends BaseController

{

	/**

	 * Method to display a view.

	 *

	 * @param   boolean  $cachable   If true, the view output will be cached

	 * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link \JFilterInput::clean()}.

	 *

	 * @return  static  This object to support chaining.

	 *

	 * @since   1.5

	 */

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

