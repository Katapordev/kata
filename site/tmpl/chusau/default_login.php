<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
$user = Factory::getUser();
$cookieLogin = $user->get('cookieLogin');
$document = Factory::getDocument();
$renderer = $document->loadRenderer('module');
$modules  = ModuleHelper::getModuleById(110);
echo JHtml::_('content.prepare', '{loadmoduleid 110}'); ?>