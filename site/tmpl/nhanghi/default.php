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

use Joomla\CMS\Router\Route;

use Kata\Component\Katas\Site\Helper\RouteHelper as KatasHelperRoute;
use Joomla\CMS\Factory;
HTMLHelper::_('script','https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('script','components/com_katas/js/nhanghi.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('stylesheet','components/com_katas/css/nhanghi.css', array('version' =>'auto'),array('defer' => 'true'));
$app = Factory::getApplication();
$ChiNhanh = $app->getParams()->get('ChiNhanh');
$Name = $app->getParams()->get('page_heading');
?>
<div class="text-center"><h1><?php echo $Name; ?></h1></div>
<div ng-app="myApp" ng-controller="myCtrl">
<div class="container">
<div class="m-auto p-2">	<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="pill" href="#phong">Phòng</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="pill" href="#menu1">Chưa Thanh Toán</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="pill" href="#menu2">Đã Thanh Toán</a>
  </li>	
</ul></div></div>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="phong" ng-init="phongchothue('<?php echo $ChiNhanh; ?>')">
<div class="container">
<div class="row">
<div class="col-sm-3 text-center border" style="padding:10px" ng-repeat="x in content">
<div class="m-auto"><h3><span class="text-{{x.LoaiPhong}}">{{x.TenSP}}</span></h3></div>
<div class="m-auto" ng-show="{{x.TrangThaiSP}}"><i class="fas fa-home display-4 text-{{x.LoaiPhong}}"></i></div>
<div class="m-auto" ng-hide="{{x.TrangThaiSP}}"><i class="fas fa-home display-4 text-danger"></i></div>
<div ng-show="{{x.TrangThaiSP}}">
	<div class="m-auto p-2 text-danger">
		<div class="text-danger">Giá 1h : {{x.GiaSP1 | currency: "" : 0}}₫</div>
		<div class="text-danger">Giá 1h - 3h : {{x.GiaSP2 | currency: "" : 0}}₫</div>
		<div class="text-danger">Giá 3h - 5h : {{x.GiaSP3 | currency: "" : 0}}₫</div>
		<div class="text-danger">Giá 5h - 7h : {{x.GiaSP4 | currency: "" : 0}}₫</div>
		<div class="text-danger">Giá 1Ngày : {{x.GiaSP5 | currency: "" : 0}}₫</div>
	</div>
	<button class="btn btn-{{x.LoaiPhong}}" ng-click="on(x.id,x.TenSP)" data-toggle="modal" data-target="#myModal">Thuê Phòng</button>
</div>
<div ng-hide="{{x.TrangThaiSP}}">
<h4><span class="text-danger"> Đang Thuê </span>
</h4>
     	<div class="row col-sm-12" ng-show="hello"><h3><span class="text-primary">{{x.TrangThaiSP}}</span></h3></div>
</div>
</div>
</div>	
	</div> 
  </div>
  
  


  <div class="tab-pane container fade" id="menu1">
	  <div class="table-responsive" ng-init="hoadonRead('<?php echo $ChiNhanh; ?>')">
		<div class="form-group form-inline">Hiển Thị :  <input class="form-control w-75" type="number" ng-model="numLimit" /></div>
 <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Phòng</th>
        <th>Giờ Vào</th>
		<th>Giờ Ra</th>
		<th>Thời Gian Thuê</th>
		<th>Tổng Tiền</th>	
		<th>Khách Hàng</th>	
		<th>CMND</th>	
		<th>SĐT</th>
		<th>Nhân Viên</th>
		<th><div ng-if="hd.TrangThai==0">Action</div></th>
	    <th><div ng-if="hd.TrangThai==1">In Bill</div></th>
      </tr>
    </thead>
    <tbody>
      <tr class="{{hd.TrangThai|Loaibg }}" ng-repeat="hd in hoadons | orderBy:'TrangThai' | limitTo:numLimit | filter: { TrangThai: '0' }">
        <td>{{$index+1}}</td>
        <td>{{hd.tenphong}}</td>
        <td>{{hd.GioVao}}</td>
		<td>{{hd.GioRa}}</td>
		<td>{{hd.Ngay}} Ngày {{hd.Gio}} Giờ {{hd.Phut}} Phút </td>	
		<td>{{hd.TongTien | currency: "" : 0}}₫</td>	  
		<td>{{hd.KhachHang}}</td>		
		<td>{{hd.CMND}}</td>
		<td>{{hd.SDT}}</td>  
		<td>{{hd.NhanVien}}</td>  
		<td><button ng-if="hd.TrangThai==0" class="btn btn-secondary" ng-click="thanhtoan(hd.id,hd.idSP)">Thanh Toán</button></td>
		<td>
			<div class="d-none" id="inbill{{hd.id}}">
				<div>{{hd.tenphong}}</div>
				<div>{{hd.GioVao}}</div>
				<div>{{hd.GioRa}}</div>
				<div>{{hd.Ngay}} Ngày {{hd.Gio}} Giờ {{hd.Phut}} Phút</div>
				<div>{{hd.TongTien | currency: "" : 0}}₫</div>
				<div>{{hd.KhachHang}}</div>
				<div>{{hd.NhanVien}}</div>
			</div>
			<button  ng-if="hd.TrangThai==1" class="btn btn-secondary" ng-click="inbill(hd.id)">In Bill</button></td>
      </tr>
      
      
    </tbody>
  </table>	
	</div></div>
	
<div class="tab-pane container fade" id="menu2">
	  <div class="table-responsive" ng-init="hoadonRead('<?php echo $ChiNhanh; ?>')">
		<div class="form-group form-inline">Hiển Thị :  <input class="form-control w-75" type="number" ng-model="numLimit" /></div>
 <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Phòng</th>
        <th>Giờ Vào</th>
		<th>Giờ Ra</th>
		<th>Thời Gian Thuê</th>
		<th>Tổng Tiền</th>	
		<th>Khách Hàng</th>	
		<th>CMND</th>	
		<th>SĐT</th>
		<th>Nhân Viên</th>
		<th><div ng-if="hd.TrangThai==0">Action</div></th>
	    <th><div ng-if="hd.TrangThai==1">In Bill</div></th>
      </tr>
    </thead>
    <tbody>
      <tr class="{{hd.TrangThai|Loaibg }}" ng-repeat="hd in hoadons | orderBy:'TrangThai' | limitTo:numLimit | filter: { TrangThai: '1'} ">
        <td>{{$index+1}}</td>
        <td>{{hd.tenphong}}</td>
        <td>{{hd.GioVao}}</td>
		<td>{{hd.GioRa}}</td>
		<td>{{hd.Ngay}} Ngày {{hd.Gio}} Giờ {{hd.Phut}} Phút </td>	
		<td>{{hd.TongTien | currency: "" : 0}}₫</td>	  
		<td>{{hd.KhachHang}}</td>		
		<td>{{hd.CMND}}</td>
		<td>{{hd.SDT}}</td>  
		<td>{{hd.NhanVien}}</td>  
		<td><button ng-if="hd.TrangThai==0" class="btn btn-secondary" ng-click="thanhtoan(hd.id,hd.idSP)">Thanh Toán</button></td>
		<td>
			<div class="d-none" id="inbill{{hd.id}}">
				<div>{{hd.tenphong}}</div>
				<div>{{hd.GioVao}}</div>
				<div>{{hd.GioRa}}</div>
				<div>{{hd.Ngay}} Ngày {{hd.Gio}} Giờ {{hd.Phut}} Phút</div>
				<div>{{hd.TongTien | currency: "" : 0}}₫</div>
				<div>{{hd.KhachHang}}</div>
				<div>{{hd.NhanVien}}</div>
			</div>
			<button  ng-if="hd.TrangThai==1" class="btn btn-secondary" ng-click="inbill(hd.id)">In Bill</button></td>
      </tr>
      
      
    </tbody>
  </table>	
	</div></div>	
	
	
</div>



	
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{tenphong}} {{idsp}}</h4>
      </div>
      <div class="modal-body">
      <div class="giohang">
              <form class="form-horizontal" name="userForm" ng-submit="submitForm()" novalidate>
               <input type="hidden" class="form-control" ng-model="idsp">
                  <div class="form-group">
                      <input class="form-control" ng-model="tenkh" placeholder="Tên Khách Hàng" required>
                  </div>
                  <div class="form-group">
                      CMND : <input class="form-control" ng-model="cmnd" placeholder="Chứng Minh Nhân Dân">
                  </div>
                  <div class="form-group">
                      Số Điện Thoại : <input class="form-control" ng-model="sdt" placeholder="Số Điện Thoại">
                  </div>
            </form>
</div>
      </div>
      <div class="modal-footer">
      <button class="btn btn-success" ng-style="GhiBillStyle" ng-click="GhiBill()" ng-disabled="!userForm.$dirty || (userForm.$dirty && userForm.$invalid)">Ghi Bill</button>
        <button class="btn btn-danger" data-dismiss="modal">Hủy Bỏ</button>
      </div>
    </div>

  </div>
</div>
</div>


