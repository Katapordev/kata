<?php
/**
 * @package     Katas.Administrator
 * @subpackage  com_katas
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Kata\Component\Katas\Administrator\Helper;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

/**
 * Katas component helper.
 *
 * @since  4.0
 */
class KatasHelper
{
	public static function getWalkTitle($id)
	{
		if (empty($id))
		{
			// throw an error or ...
			return false;
		}
		$db = Factory::getDbo();
		$query = $db->getQuery(true);
		$query->select('title');
		$query->from('#__katas');
		$query->where('id = ' . $id);
		$db->setQuery($query);
		return $db->loadObject();
	}
}