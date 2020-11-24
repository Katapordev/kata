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
HTMLHelper::_('script','components/com_katas/js/taza.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('stylesheet','components/com_katas/css/taza.css', array('version' =>'auto'),array('defer' => 'true'));
?>
<div ng-app="myApp" ng-controller="myCtrl">
	
<div class="form-inline p-2"> 
	<input type="text" class="form-control m-auto" placeholder="Số Lượng" ng-model="limit">
	<input type="text" class="form-control m-auto" placeholder="Bắt Đầu" ng-model="offset">	
	<button class="btn btn-success" ng-click="TazaRead(limit,offset)">Load</button>	
	<button class="btn btn-info" ng-click="TazaUpdate()">Update</button>	
	</div>

	
	
<div class="table-responsive">
	<table class="table" ng-init="TazaRead(limit,offset)">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th><input type="number" class="form-control" placeholder="idCus" ng-model="idCusFil">
</th>
        <th>Phone</th>
        <th>Name</th>
        <th>Sanpham</th>
 		<th>Gia</th>		  
        <th>Paid</th>	  
      </tr>
    </thead>
    <tbody>
		<tr>
			<td colspan="7">
				Phát Sinh : {{resultValue | sumOfValue:'Gia' | currency:"":0}} - Thanh Toán : {{resultValue | sumOfValue:'Paid'| currency:"":0}} - Còn Lại
				{{ resultValue | Conlai:'Gia':'Paid' | currency:"":0}}
			</td>
		</tr>
   		<tr>
	    <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>{{resultValue | sumOfValue:'Gia' | currency:"":0}}</td>		  
        <td>{{resultValue | sumOfValue:'Paid'| currency:"":0}}</td>				
		</tr>
      <tr ng-repeat="nv in resultValue=(nhanviens|filter:{'idCus':idCusFil})">
        <td>{{$index+1}}</td>
        <td>{{nv.idCus}}</td>
        <td>{{nv.Phone}}</td>
        <td>{{nv.Name}}</td>
        <td>{{nv.Sanpham}}</td>
        <td>{{nv.Gia}}</td>		  
        <td>{{nv.Paid}}</td>			  
      </tr>

    </tbody>
  </table>
	</div>
	
	
	
<!--<div class="table-responsive">
	<table class="table" ng-init="TazaReadFN(limit,offset)">
    <thead class="thead-dark">
      <tr>
        <th>#</th>
        <th><input type="number" class="form-control" placeholder="idCus" ng-model="idCusFil">
</th>
 		<th>Gia</th>		  
        <th>Paid</th>
		<th>Còn Nợ</th>	
      </tr>
    </thead>
    <tbody>
   		
      <tr ng-repeat="nv in resultValue=(nhanviens|filter:{'idCus':idCusFil})">
        <td>{{$index+1}}</td>
        <td>{{nv.idCus}}</td>
        <td>{{nv.Gia}}</td>		  
        <td>{{nv.Paid}}</td>	
		<td>{{nv.Gia - nv.Paid}}</td>
      </tr>

    </tbody>
  </table>
	</div>-->	
	
	
</div>	
