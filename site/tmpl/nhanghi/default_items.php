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
HTMLHelper::_('script','https://ajax.googleapis.com/ajax/libs/angularjs/1.8.0/angular.min.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('script','components/com_katas/js/nhanghi.js', array('version' =>'auto'),array('defer' => 'true'));
HTMLHelper::_('stylesheet','components/com_katas/css/nhanghi.css', array('version' =>'auto'),array('defer' => 'true'));

?>
<div ng-app="myApp" ng-controller="myCtrl">
<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="pill" href="#home">Phòng</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="pill" href="#menu1">Bill</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="home">...</div>
  <div class="tab-pane container fade" id="menu1">
	  <div class="table-responsive" ng-init="hoadonRead()">
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
		<th>Trạng Thái</th>		  	  
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="hd in hoadons">
        <td>{{$index+1}}</td>
        <td>{{hd.tenphong}}</td>
        <td>{{hd.GioVao}}</td>
		<td>{{hd.GioRa}}</td>
		<td>{{hd.Ngay}} Ngày {{hd.Gio}} Giờ {{hd.Phut}} Phút </td>	
		<td>{{hd.TongTien}}</td>	  
		<td>{{hd.KhachHang}}</td>		
		<td>{{hd.CMND}}</td>
		<td>{{hd.SDT}}</td>  
		<td>{{hd.NhanVien}}</td>  
		<td>{{hd.TrangThai}}</td>  
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
        <h4 class="modal-title">{{tenphong}}</h4>
      </div>
      <div class="modal-body">
      <div class="giohang">
              <form class="form-horizontal" name="userForm" ng-submit="submitForm()" novalidate>
               <input type="hidden" class="form-control" ng-model="idsp">
                  <div class="form-group">
                      <input class="form-control" ng-model="tenkh" placeholder="Tên Khách Hàng">
                  </div>
                  <div class="form-group">
                      <input class="form-control" ng-model="cmnd" placeholder="Chứng Minh Nhân Dân">
                  </div>
                  <div class="form-group">
                      <input class="form-control" ng-model="sdt" placeholder="Số Điện Thoại">
                  </div>
            </form>
</div>
      </div>
      <div class="modal-footer">
      <button class="btn btn-success" ng-style="GhiBillStyle" ng-click="GhiBill()">Ghi Bill</button>
        <button class="btn btn-danger" data-dismiss="modal">Hủy Bỏ</button>
      </div>
    </div>

  </div>
</div>
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Phòng</a></li>
  <li><a data-toggle="tab" href="#menu1">Chưa TT</a></li>
  <li><a data-toggle="tab" href="#menu2">Đã TT</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active" ng-init="phongchothue()">
<div class="row col-sm-6 text-center" style="padding:10px" ng-repeat="x in content">
 	<div class="row col-sm-12"><h3><span class="text-primary">{{x.TenSP}}</span></h3></div>
    <div class="row col-sm-12" ng-show="{{x.TrangThaiSP}}" ng-click="on(x.id,x.TenSP)" data-toggle="modal" data-target="#myModal"><img ng-src="{{x.image}}"></div>
    <div class="row col-sm-12" ng-hide="{{x.TrangThaiSP}}"><img ng-src="{{x.image}}"></div>
<div ng-show="{{x.TrangThaiSP}}"><div class="row col-sm-12"><h4><span class="text-danger">Giá 1h : {{x.GiaSP1 | currency: "" : 0}}₫</span></h4></div><div class="row col-sm-12"><h4><span class="text-danger">Giá 1h - 3h : {{x.GiaSP2 | currency: "" : 0}}₫</span></h4></div><div class="row col-sm-12"><h4><span class="text-danger">Giá 3h - 5h : {{x.GiaSP3 | currency: "" : 0}}₫</span></h4></div><div class="row col-sm-12"><h4><span class="text-danger">Giá 5h - 7h : {{x.GiaSP4 | currency: "" : 0}}₫</span></h4></div><div class="row col-sm-12"><h4><span class="text-danger">Giá 1Ngày : {{x.GiaSP5 | currency: "" : 0}}₫</span></h4></div>
</div>
<div ng-hide="{{x.TrangThaiSP}}">
<h4><span class="text-danger"> Đang Thuê </span>
</h4>
     	<div class="row col-sm-12" ng-show="hello"><h3><span class="text-primary">{{x.TrangThaiSP}}</span></h3></div>
</div>
</div>
  </div>
  
  
<div id="menu1" class="tab-pane fade chuathanhtoan" ng-init="hoadonchuathanhtoan()">

    <div  class="row col-sm-12 text-left" style="padding:10px" ng-repeat="x in hoadonctt">
    <div class="row col-sm-12"><span class="text-primary">Hóa Đơn Số : {{x.id}}</span></div>
    <div class="row col-sm-12">Tên Phòng : {{x.tenphong}}</div>
    <div class="row col-sm-12">Ngày Giờ Vào : {{x.GioVao}}</div>
    <div class="row col-sm-12">Ngày Giờ Ra : Đang Thuê</div>
    <div class="row col-sm-12">Nhân Viên : {{x.NhanVien}}</div>
    <div class="row col-sm-12">Khách Hàng : {{x.KhachHang}}</div>
    <button class="btn btn-success" ng-click="thanhtoan(x.id,x.idSP)">Thanh Toán</button>
    </div>
</div>
<div id="menu2" class="tab-pane fade dathanhtoan" ng-init="hoadondathanhtoan()">

    <div class="row col-sm-12 text-left" style="padding:10px" ng-repeat="x in hoadondtt | limitTo : 30">
    <div id="inbill{{x.id}}">
    <div class="row col-sm-12"><span class="text-primary">Hóa Đơn Số : {{x.id}}</span></div>
    <div class="row col-sm-12">Tên Phòng : {{x.tenphong}}</div>
    <div class="row col-sm-12">Ngày Giờ Vào : {{x.GioVao}}</div>
    <div class="row col-sm-12">Ngày Giờ Ra : {{x.GioRa}}</div>
    <div class="row col-sm-12">Nhân Viên : {{x.NhanVien}}</div>
    <div class="row col-sm-12">Khách Hàng : {{x.KhachHang}}</div>
    <div class="row col-sm-12">Thời Gian Thuê : {{x.Ngay}} Ngày {{x.Gio}} Giờ {{x.Phut}} Phút</div>
    <div class="row col-sm-12">Tổng Tiền : {{x.TongTien | currency: "" : 0}}₫</div>
    </div>
   	<button class="btn btn-success" ng-click="inbill(x.id)">In Bill</button>
    </div>
</div>
  </div>
</div>


