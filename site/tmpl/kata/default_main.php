<?php
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
HTMLHelper::_('script','components/com_kata/js/kata.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('stylesheet','components/com_kata/css/kata.css', array('version' =>'auto'),array('defer' => 'true'));
?>
<div ng-app="AnhSon" ng-controller="AnhSon" class="container-fluid">
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
				   <legend  class="w-auto"><?php print_r($params->get('label1')); ?></legend>
				   
				<textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('label1')); ?>" ng-model="dulieu.Hoten">
					</textarea>	   
					   
				</fieldset>
				   
                     
               </div>
				
				
               <div class="form-group col-12">
				   <fieldset class="border p-2">
				   <legend  class="w-auto"><?php print_r($params->get('label2')); ?></legend>
				<textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('label2')); ?>" ng-model="dulieu.IP">
					</textarea>
					   
				</fieldset>
                     
               </div>
               <div class="form-group col-12">
				 	<fieldset class="border p-2">
				   <legend  class="w-auto"><?php print_r($params->get('label3')); ?></legend>
					<textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('label3')); ?>" ng-model="dulieu.Info">
					</textarea>
				</fieldset>  
                     
               </div>
               <div class="form-group col-12">
			<fieldset class="border p-2">
				   <legend  class="w-auto"><?php print_r($params->get('label4')); ?></legend>	
		<textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('label4')); ?>" ng-model="dulieu.SDT"> 
			</textarea>		
				
				</fieldset>	   
                 
               </div>
               <div class="form-group col-12">
				 			<fieldset class="border p-2">
				   <legend  class="w-auto"><?php print_r($params->get('label5')); ?></legend>
				 <textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('label5')); ?>" ng-model="dulieu.Gmail"> 
			</textarea>							
				</fieldset>	   
				   
		 
               </div>
<div class="form-group col-12">	
	<fieldset class="border p-2">
				   <legend  class="w-auto"><?php print_r($params->get('label6')); ?></legend>
				 <textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('label6')); ?>" ng-model="dulieu.Payoneer"> </textarea>
			</fieldset>	 	
				</div>
				
				
               <div class="form-group col-12">
			<fieldset class="border p-2">		   
				   <legend  class="w-auto"><?php print_r($params->get('label7')); ?></legend>
			 <textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('label7')); ?>" ng-model="dulieu.Cauhoi"></textarea>
			</fieldset>	 	
				</div>	
				   
				   
    <div class="form-group col-12">
			<fieldset class="border p-2">		   
				<legend  class="w-auto"><?php print_r($params->get('label8')); ?></legend>
		 <textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('label8')); ?>" ng-model="dulieu.Bank"> 
			</textarea>		
					</fieldset>			   
               </div>

    <div class="form-group col-12">
			<fieldset class="border p-2">		   
				<legend  class="w-auto"><?php print_r($params->get('label9')); ?></legend>
		 <textarea class="form-control {{mauedit}}" rows="5" placeholder="<?php print_r($params->get('label9')); ?>" ng-model="dulieu.Ghichu"> 
			</textarea>		
					</fieldset>			   
               </div>				   
				   
            </form>
<div class="d-flex">   
		<select class="form-control w-50 mr-2" ng-model="dulieu.Trangthai" required> 
			<option value="" selected="selected">Trạng Thái</option>
			<option value="1">Xanh</option>
			<option value="2">Vàng</option>
			<option value="3">Đỏ</option>
		  </select>
	<button ng-click="Reset()" class="btn btn-info mr-auto">Reset</button>	
	<button ng-click="AnhsonCreate()" class="btn btn-success {{newbtn}} ml-auto">Lưu</button><button ng-click="AnhsonUpdate('<?php echo $user->id; ?>')" class="btn btn-primary {{updatebtn}} ml-auto">Cập Nhật</button>

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
            <table class="table table-bordered" ng-init="AnhsonRead()">
               <thead class="thead-dark">
                  <tr>
                     <th>#</th>
					<?php echo $admin==1?'<th>User</th>':'' ; ?>   
                     
                     <th><?php print_r($params->get('label1')); ?></th>
                     <th><?php print_r($params->get('label2')); ?></th>
					 <th><?php print_r($params->get('label3')); ?></th>
					 <th><?php print_r($params->get('label4')); ?></th> 
					 <th><?php print_r($params->get('label5')); ?></th>
					 <th><?php print_r($params->get('label6')); ?></th> 
                     <th><?php print_r($params->get('label7')); ?></th>
                     <th><?php print_r($params->get('label8')); ?></th>
					  <th ng-click="orderByField='Trangthai'; reverseSort = !reverseSort"><?php print_r($params->get('label9')); ?></th>   
					 <th>Ngày Tạo</th> 
                     <th>Sửa</th>
					 <?php echo $admin==1?'<th>Xóa</th>':'' ; ?> 
					 
                  </tr>
               </thead>
               <tbody>
                  <tr ng-repeat="as in Anhsons | filter: search | orderBy:orderByField:reverseSort ">
                     <td class="{{as.Trangthai | ASTRANGTHAI}}" >{{$index+1}}</td>
			<?php echo $admin==1?'<td>{{as.name}}</td>':'' ; ?>  		  
                    
                     <td>{{as.Hoten}}</td>
                     <td>{{as.IP}}</td>
					 <td>{{as.Info}}</td> 
					 <td>{{as.SDT}}</td> 
					 <td>{{as.Gmail}}</td>   
					<td>{{as.Payoneer}}</td>  
					<td>{{as.Cauhoi}}</td>  
			       <td>{{as.Bank}}</td>	
				    <td class="{{as.Trangthai | ASTRANGTHAI}}" >{{as.Ghichu}}</td>	
				    <td>{{as.Ngaytao}}</td>	 
                     <td>
						 <button type="button" class="btn btn-info" ng-click="edit(as.id)">Sửa</button>
					  </td>
					<?php echo $admin==1?'<td>
						  <button type="button" class="btn btn-danger" ng-click="AnhsonRemove(as.id)">Xóa</button>
					  </td>':'' ; ?>  

                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>	
