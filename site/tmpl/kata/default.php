<?php
/**
 * @package     Mywalks.Site
 * @subpackage  com_mywalks
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
//use Joomla\CMS\Layout\LayoutHelper;

HTMLHelper::_('behavior.core');

HTMLHelper::_('script','https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('script','https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.8.0/angular-sanitize.min.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('script','media/vendor/tinymce/tinymce.min.js', array('version' =>'auto'),array('defer' => 'true'));	
HTMLHelper::_('script','components/com_katas/js/kata.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('script','components/com_katas/js/editor.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('stylesheet','components/com_katas/css/kata.css', array('version' =>'auto'),array('defer' => 'true'));
?>
<div ng-app="Kata" ng-controller="Kata">
<div ng-init="EditorRead()" class="py-2">
<button type="button" class="btn btn-primary mx-2" ng-click="OpenFile($index)" ng-repeat="x in Files">{{x.Ten}}</button>	
</div>
<div class="row">
	<div class="col-5 code border border-danger p-2">
<div class="form-group">
  <label for="comment">Code:</label>
	<input class="form-control my-2" placeholder="Tên File" ng-model="dulieu.Ten" />
  <textarea ui-tinymce="tinymceOptions" class="form-control" rows="15" ng-model="dulieu.Noidung"></textarea>
</div>
<div class="p-2"><div class="btn-group">
 <button type="button" class="btn btn-secondary mx-2" ng-click="Reset()">Reset</button>	
  <button type="button" class="btn btn-primary mx-2" ng-click="EditorCreate(dulieu)">Tạo</button>
  <button type="button" class="btn btn-info mx-2" ng-click="EditorUpdate(dulieu)">Cập Nhật</button>
  <button type="button" class="btn btn-danger mx-2" ng-click="EditorDelete(dulieu)">Xóa</button>
 <button type="button" class="btn btn-danger mx-2" ng-click="CSDLCreate()">Tạo CSDL</button>
</div></div>		
	</div>
	<div class="col-7 design border border-success p-2">
		<div ng-bind-html="dulieu.Noidung"></div>
	</div>
</div>	
	
</div>	
