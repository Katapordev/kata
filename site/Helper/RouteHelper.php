<?php
namespace Kata\Component\Kata\Site\Helper;
defined('_JEXEC') or die;
use Joomla\CMS\Categories\CategoryNode;
use Joomla\CMS\Language\Multilanguage;
abstract class RouteHelper
{
	public static function getWalkRoute($id, $slug, $language = 0, $layout = null)

	{
		$link = 'index.php?option=com_kata&view=kata&id=' . $id . '&slug=' . $slug;
		if ($language && $language !== '*' && Multilanguage::isEnabled())
		{
			$link .= '&lang=' . $language;
		}
		if ($layout)

		{

			$link .= '&layout=' . $layout;

		}



		return $link;

	}

	public static function getKataRoute($language = 0, $layout = null)

	{



		$link = 'index.php?option=com_content&view=kata';



		if ($language && $language !== '*' && Multilanguage::isEnabled())

		{

			$link .= '&lang=' . $language;

		}



		if ($layout)

		{

			$link .= '&layout=' . $layout;

		}



		return $link;

	}

}

