var app = angular.module("myApp", []);

app.directive('users', function ($http){    
  return {
    restrict: 'E', // if it's element
    templateUrl: 'modules/mod_nhanghi/data.html',  // example template
    link: function($scope){
      	 $http.post("index.php?option=com_ajax&module=nhanghi&method=hoadon&format=raw",{"trangthai":1,"offset":$scope.offset})  
		.then(function(response) { 
		$scope.offset += 10;	 
		$scope.hoadondtt1 = response.data.details;  
		   console.log(response);
		}); 
    }
  };
});
app.filter('sumOfValue', function () {
        return function (data, key) {        
            if (angular.isUndefined(data) || angular.isUndefined(key))
                return 0;        
            var sum = 0;        
            angular.forEach(data,function(value){
                sum = sum + parseInt(value[key], 10);
            });        
            return sum;
        };
});
app.filter('Conlai', function () {
        return function (data, key1, key2) {        
            if (angular.isUndefined(data) || angular.isUndefined(key1)  || angular.isUndefined(key2)) 
             return 0;        
            var sum = 0;
            angular.forEach(data,function(value){
                sum = sum + (parseInt(value[key1], 10) - parseInt(value[key2], 10));
            });
            return sum;
        };
});	




 app.controller("myCtrl",function($scope, $http,$compile) {
	 $scope.limit = 100;
	 $scope.offset =0;
	$scope.TazaRead = function(limit,offset){
		   $http.post("index.php?option=com_katas&task=Taza.TazaRead&format=raw",{"limit":limit,"offset":offset})  
			.then(function(response) { 
			$scope.nhanviens = response.data.details; 
			   console.log(response);
			}); 
	 }
	$scope.TazaReadFN = function(limit,offset){
		   $http.post("index.php?option=com_katas&task=Taza.TazaReadFN&format=raw",{"limit":limit,"offset":offset})  
			.then(function(response) { 
			$scope.nhanviens = response.data.details; 
			   console.log(response);
			}); 
	 }	
	$scope.TazaUpdate = function(){
		   $http.post("index.php?option=com_katas&task=Taza.TazaUpdate&format=raw")  
			.then(function(response) { 
			$scope.nhanviens = response.data.details; 
			   console.log(response);
			}); 
	 }	 
	$scope.on = function(id,phong)
	{
		$scope.idsp = id;
		$scope.tenphong = phong;
	}  
	
	$scope.loadmore = function()
	{
		angular.element(document.getElementsByClassName('dathanhtoan')).append($compile("<users></users>")($scope));
		
	} 
	
	$scope.GhiBill = function()
	{
		$scope.GhiBillStyle = {"display" : "none"};
		 $http.post("index.php?option=com_ajax&module=nhanghi&method=ghibill&format=raw",{"idsp":$scope.idsp,"tenkh":$scope.tenkh,"cmnd":$scope.cmnd,"sdt":$scope.sdt})  
		.then(function(response) { 
		//$scope.content = response.data.details;     
		console.log(response); 
		setTimeout(location.reload(), 3000);
		});
	}
	
	$scope.hoadonchuathanhtoan = function()
	{
		var offset=0;
	   $http.post("index.php?option=com_ajax&module=nhanghi&method=hoadon&format=raw",{"trangthai":0,"offset":offset})  
		.then(function(response) { 
		$scope.hoadonctt = response.data.details; 

		 //  console.log(response);
		}); 
	}
	$scope.hoadondathanhtoan = function()
	{
	   var offset=0;
	   $http.post("index.php?option=com_ajax&module=nhanghi&method=hoadon&format=raw",{"trangthai":1,"offset":offset})  
		.then(function(response) { 
		$scope.hoadondtt = response.data.details;    
		 //  console.log(response);
		}); 
	} 
	$scope.thanhtoan = function(id,idsp)
	{
		 $http.post("index.php?option=com_ajax&module=nhanghi&method=thanhtoan&format=raw",{"id":id,"idsp":idsp})  
		.then(function(response) {    
		setTimeout(location.reload(), 3000);
		});
	}
	$scope.inbill = function(id) {
			var ten = "inbill"+id;;
			var innerContents = document.getElementById(ten).innerHTML;
			var popupWinindow = window.open('', '_blank', 'width=600,height=700,scrollbars=no,menubar=no,toolbar=no,location=no,status=no,titlebar=no');
			popupWinindow.document.open();
			popupWinindow.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css" /></head><body onload="window.print()"><div><span>Nhà Nghỉ Xuân Hằng</span><p><span>Địa Chỉ : 08 Tôn Thất Tùng, Trà Bá, Pleiku, Gia Lai</span</div>' + innerContents + '</html>');
			popupWinindow.document.close();
		  }
	

 });