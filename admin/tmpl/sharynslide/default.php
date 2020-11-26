<?php
defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;
use Joomla\String\Inflector;
HTMLHelper::_('behavior.multiselect');
$app       = Factory::getApplication();
$user      = Factory::getUser();
$userId    = $user->get('id');
HTMLHelper::_('script','https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('script','administrator/components/com_kata/js/kata.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('stylesheet','administrator/components/com_kata/css/kata.css', array('version' =>'auto'),array('defer' => 'true'));
?>
<div class="container">
<form>
	<textarea ng-model="sql"></textarea>
	</form>
</div>
