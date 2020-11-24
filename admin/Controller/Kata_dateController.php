<?php
/**
 * @package     Katas.Administrator
 * @subpackage  com_katas
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Kata\Component\Katas\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

/**
 * Controller for a single Katas
 *
 * @since  1.6
 */
class Kata_dateController extends FormController
{
	public function cancel($key = null) {
		$this->setRedirect('index.php?option=com_katas&view=kata_dates');
	}
}
