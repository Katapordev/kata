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
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
$params = Factory::getApplication()->getParams();
$user = Factory::getUser();
$admin = $user->authorise('core.admin');
$cookieLogin = $user->get('cookieLogin');
$document = Factory::getDocument();
$renderer = $document->loadRenderer('module');
$modules  = ModuleHelper::getModuleById(110);
HTMLHelper::_('behavior.core');

HTMLHelper::_('script','https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('script','https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.8.0/angular-sanitize.min.js', array('version' =>'auto'),array('defer' => 'true'));

HTMLHelper::_('script','components/com_katas/js/'.$params->get('database').'.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('stylesheet','components/com_katas/css/edit.css', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('stylesheet','components/com_katas/css/anhson.css', array('version' =>'auto'),array('defer' => 'true'));
?>
<div ng-app="Chusau" ng-controller="Chusau" class="container-fluid">
 CSDL : <?php print_r($params->get('database')); ?>	
	<button class="btn btn-primary {{AnHienTaoMoi}}" ng-click="AnTaoMoi()">Ẩn</button>
	<button class="btn btn-primary {{flag}}" ng-click="HienTaoMoi()">Hiện</button>
   <div class="row">
      <div class="col-sm-4 col-12 {{AnHienTaoMoi}}">
         <div class="my-2 px-5">
            <form class="row">
               <div class="col-12">
                  <h1 class="text-center">Tạo Mới</h1>
               </div>
               <div class="form-group col-12">
				   <fieldset class="border p-2">
				   <legend  class="w-auto"><?php print_r($params->get('field1')); ?></legend>
				   
				<textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('field1')); ?>" ng-model="dulieu.field1">
					</textarea>	   
					   
				</fieldset>
				   
                     
               </div>
				
				
               <div class="form-group col-12">
				   <fieldset class="border p-2">
				   <legend  class="w-auto"><?php print_r($params->get('field2')); ?></legend>
				<textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('field2')); ?>" ng-model="dulieu.field2">
					</textarea>
					   
				</fieldset>
                     
               </div>
               <div class="form-group col-12">
				 	<fieldset class="border p-2">
				   <legend  class="w-auto"><?php print_r($params->get('field3')); ?></legend>
					<textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('field3')); ?>" ng-model="dulieu.field3">
					</textarea>
				</fieldset>  
                     
               </div>
               <div class="form-group col-12">
			<fieldset class="border p-2">
				   <legend  class="w-auto"><?php print_r($params->get('field4')); ?></legend>	
		<textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('field4')); ?>" ng-model="dulieu.field4"> 
			</textarea>		
				
				</fieldset>	   
                 
               </div>
               <div class="form-group col-12">
				 			<fieldset class="border p-2">
				   <legend  class="w-auto"><?php print_r($params->get('field5')); ?></legend>
				 <textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('field5')); ?>" ng-model="dulieu.field5"> 
			</textarea>							
				</fieldset>	   
				   
		 
               </div>
<div class="form-group col-12">	
	<fieldset class="border p-2">
				   <legend  class="w-auto"><?php print_r($params->get('field6')); ?></legend>
				 <textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('field6')); ?>" ng-model="dulieu.field6"> </textarea>
			</fieldset>	 	
				</div>
				
				
               <div class="form-group col-12">
			<fieldset class="border p-2">		   
				   <legend  class="w-auto"><?php print_r($params->get('field7')); ?></legend>
			 <textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('field7')); ?>" ng-model="dulieu.field7"></textarea>
			</fieldset>	 	
				</div>	
				   
				   
    <div class="form-group col-12">
			<fieldset class="border p-2">		   
				<legend  class="w-auto"><?php print_r($params->get('field8')); ?></legend>
		 <textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('field8')); ?>" ng-model="dulieu.field8"> 
			</textarea>		
					</fieldset>			   
               </div>

    <div class="form-group col-12">
			<fieldset class="border p-2">		   
				<legend  class="w-auto"><?php print_r($params->get('field9')); ?></legend>
		 <textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('field9')); ?>" ng-model="dulieu.field9"> 
			</textarea>		
					</fieldset>			   
               </div>				   				   
            </form>
<div class="d-flex">   
		<select class="form-control w-50 mr-2" ng-model="dulieu.field10" required> 
			<option value="" selected="selected">Trạng Thái</option>
			<option value="1">Xanh</option>
			<option value="2">Vàng</option>
			<option value="3">Đỏ</option>
		  </select>
	<button ng-click="Reset()" class="btn btn-info mr-auto">Reset</button>	
	<button ng-click="FieldsCreate()" class="btn btn-success {{newbtn}} ml-auto">Lưu</button><button ng-click="FieldsUpdate('<?php echo $user->id; ?>')" class="btn btn-primary {{updatebtn}} ml-auto">Cập Nhật</button>

			 </div>
         </div>
      </div>
      <div class="{{AnHienTable}} col-12">
		<div class="d-flex"><div class="ml-auto"><?php echo JHtml::_('content.prepare', '{loadmoduleid 110}'); ?></div></div>  
         <div class="p-2"> 
<div class="container">           
<div class="row text-center text-white">	<input type="text" class="form-control w-50 col-sm-6" placeholder="Tìm Kiếm" ng-model="search">
            <!--<input type="text" class="form-control" placeholder="Bắt Đầu" ng-model="offset">-->	
	<div class="col-sm-1 bg-success p-2"> {{TT1}} </div><div class="col-sm-1 bg-warning p-2">{{TT2}}</div><div class="col-sm-1 bg-danger p-2">{{TT3}}</div></div>
			 </div>
		<div class="alert alert-{{loai}} alert-dismissible my-2 {{status}}">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  {{noidung}}
		</div> 
         </div>
         <div class="table-responsive">
            <table class="table table-bordered" ng-init="FieldsRead()">
               <thead class="thead-dark">
                  <tr>
                     <th>#</th>
					<?php echo $admin==1?'<th>User</th>':'' ; ?>   
                     
                     <th><?php print_r($params->get('field1')); ?></th>
                     <th><?php print_r($params->get('field2')); ?></th>
					 <th><?php print_r($params->get('field3')); ?></th>
					 <th><?php print_r($params->get('field4')); ?></th> 
					 <th><?php print_r($params->get('field5')); ?></th>
					 <th><?php print_r($params->get('field6')); ?></th> 
                     <th><?php print_r($params->get('field7')); ?></th>
                     <th><?php print_r($params->get('field8')); ?></th>
					  <th ng-click="orderByField='field10'; reverseSort = !reverseSort"><?php print_r($params->get('field9')); ?></th>   
					 <th>Ngày Tạo</th> 
                     <th>Sửa</th>
					 <?php echo $admin==1?'<th>Xóa</th>':'' ; ?> 
					 
                  </tr>
               </thead>
               <tbody>
                  <tr ng-repeat="as in Fields | filter: search | orderBy:orderByField:reverseSort ">
                     <td class="{{as.field10 | ASTRANGTHAI}}" >{{$index+1}}</td>
			<?php echo $admin==1?'<td>{{as.name}}</td>':'' ; ?>  		  
                    
                     <td>{{as.field1}}</td>
                     <td>{{as.field2}}</td>
					 <td>{{as.field3}}</td> 
					 <td>{{as.field4}}</td> 
					 <td>{{as.field5}}</td>   
					<td>{{as.field6}}</td>  
					<td>{{as.field7}}</td>  
			       <td>{{as.field8}}</td>
				    <td class="{{as.field10 | ASTRANGTHAI}}" >{{as.field9}}</td>	
				    <td>{{as.Ngaytao}}</td>	 
                     <td>
						 <button type="button" class="btn btn-info" ng-click="edit(as.id)">Sửa</button>
					  </td>
					<?php echo $admin==1?'<td>
						  <button type="button" class="btn btn-danger" ng-click="FieldsRemove(as.id)">Xóa</button>
					  </td>':'' ; ?>  

                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>	
