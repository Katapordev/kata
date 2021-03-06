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
<div class="container-fluid" ng-controller="Dashboard">
<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="home">...</div>
  <div class="tab-pane container fade" id="menu1">...</div>
  <div class="tab-pane container fade" id="menu2">...</div>
</div>	
<form>
	<input ng-model="sql" class="form-control" />
	<button class="btn btn-primary mt-3" ng-click="CreateSQL(sql)">Gửi</button>
	</form>
</div>