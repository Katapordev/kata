var app = angular.module("myApp", []);
app.filter('Loaibg',function(){
     return function(input)
        {
		 var result =(input==1) ? "bg-success text-white" : "bg-danger text-white";
		 return result;
        }
});	

app.filter('mauloai',function(){
     return function(input)
        {
		 if(input==1){return "success";}
		 else if(input==2){return "dark";}
		else if(input==3){return "warning";}	
		 else return "primary";
		// var result =(input==1) ? "bg-success text-white" : "bg-danger text-white";
		 //return result;
        }
});
 app.controller("myCtrl",function($scope, $http,$compile) {
	 $scope.offset = 0;
	 $scope.numLimit = 20;
	 $scope.sdt = 0;
	 $scope.cmnd = 0;
	$scope.on = function(id,phong)
	{
		$scope.idsp = id;
		$scope.tenphong = phong;
	}  	 
	$scope.phongchothue = function(ChiNhanh){
   $http.post("index.php?option=com_katas&task=Nhanghi.phongRead&format=raw",{"ChiNhanh":ChiNhanh})  
    .then(function(response) { 
    $scope.content = response.data.details; 
	   console.log(response);
    }); 
		
	 }
	
	$scope.hoadonRead = function(ChiNhanh)
	{
	   $http.post("index.php?option=com_katas&task=Nhanghi.hoadonRead&format=raw",{"ChiNhanh":ChiNhanh})  
		.then(function(response) { 
		$scope.hoadons = response.data.details;    
		 console.log(response);
		}); 
	} 	
	
	 

		
	$scope.GhiBill = function()
	{
		$scope.GhiBillStyle = {"display" : "none"};
		 $http.post("index.php?option=com_katas&task=Nhanghi.ghibill&format=raw",{"idsp":$scope.idsp,"tenkh":$scope.tenkh,"cmnd":$scope.cmnd,"sdt":$scope.sdt})  
		.then(function(response) { 
		$('.close').click();	 
			 	setTimeout(location.reload(), 3000);   
		console.log(response); 
			 
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

	$scope.thanhtoan = function(id,idsp)
	{
		 $http.post("index.php?option=com_katas&task=Nhanghi.thanhtoan&format=raw",{"id":id,"idsp":idsp})  
		.then(function(response) { 
		console.log(response); 
		//$scope.hoadonRead();
		//$scope.phongchothue();	 
		setTimeout(location.reload(), 3000);
		});
	}
	$scope.inbill = function(id) {
			var ten = "inbill"+id;
			var innerContents = document.getElementById(ten).innerHTML;
			var popupWinindow = window.open('', '_blank', 'width=600,height=700,scrollbars=no,menubar=no,toolbar=no,location=no,status=no,titlebar=no');
			popupWinindow.document.open();
			popupWinindow.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css" /></head><body onload="window.print()"><div><span>Nhà Nghỉ Xuân Hằng</span><p><span>Địa Chỉ : 08 Tôn Thất Tùng, Trà Bá, Pleiku, Gia Lai</span</div>' + innerContents + '</html>');
			popupWinindow.document.close();
		  }
	

 });