var app = angular.module("AnhSon", []);
app.filter('ASTRANGTHAI',function(){
     return function(input)
        {
		 var result = 'bg-secondary text-dark';
		 	if(input == 1)
				{
					result = 'bg-success text-white';
				}
		 else if(input==2)
			 {
				 result = 'bg-warning text-white';
			 }
		else if(input==3)
			{
				 result = 'bg-danger text-white';
			 }
			else
			{
			result;
			}
		 return result;
        }
});
 app.controller("AnhSon",function($scope, $http,$compile,$filter) {
	 $scope.limit = 100;
	 $scope.offset =0;
	 $scope.newbtn = 'd-block'; 
	 $scope.updatebtn = 'd-none'; 
	 $scope.status = 'd-none'; 
	$scope.empty = {};
	var empty = angular.copy($scope.empty); 
	 $scope.AnHienTaoMoi = 'd-block';
	  $scope.AnHienTable = 'col-sm-8';
	 $scope.flag = 'd-none';
	$scope.AnTaoMoi = function(){
		 $scope.AnHienTaoMoi = 'd-none';
		  $scope.AnHienTable = 'col-sm-12';
		$scope.flag = 'd-block';
	 }	 
	$scope.HienTaoMoi = function(){
		 $scope.AnHienTaoMoi = 'd-block';
		  $scope.AnHienTable = 'col-sm-8';
		$scope.flag = 'd-none';
	 }	 	 
	 
$scope.TT1=0;
$scope.TT2=0;
$scope.TT3=0;
	$scope.AnhsonRead = function(){
		   $http.post("index.php?option=com_katas&task=Anhson.AnhsonRead&format=raw")  
			.then(function(response) { 
			$scope.Anhsons = response.data; 
			angular.forEach($scope.Anhsons, function (detail) {
				if(detail.Trangthai==1)
					{
				$scope.TT1++;		
					}
				else if(detail.Trangthai==2)
					{
				$scope.TT2++;		
					}
				else if(detail.Trangthai==3)
					{
				$scope.TT3++;		
					}
                })		   
			   console.log(response.data);
			}); 
	 }
           
	$scope.AnhsonCreate = function(){
		   $http.post("index.php?option=com_katas&task=Anhson.AnhsonCreate&format=raw",{'dulieu':$scope.dulieu,'idUser':$scope.idUser})  
			.then(function(response) { 
			   console.log(response);
			   $scope.AnhsonRead();
			  $scope.Reset();
			 $scope.loai = response.data.loai; 
			  $scope.noidung = response.data.noidung; 
			  $scope.status = 'd-block'; 
			}); 
	 }
	
	$scope.AnhsonUpdate = function(){
		   $http.post("index.php?option=com_katas&task=Anhson.AnhsonUpdate&format=raw",{'dulieu':$scope.dulieu})  
			.then(function(response) { 
			   console.log(response);
			   $scope.AnhsonRead();
			$scope.Reset();
			 $scope.loai = response.data.loai; 
			  $scope.noidung = response.data.noidung; 
			  $scope.status = 'd-block'; 
			}); 
			console.log($scope.dulieu);
	 }	
	$scope.AnhsonRemove = function(dulieu){
		   $http.post("index.php?option=com_katas&task=Anhson.AnhsonRemove&format=raw",{'dulieu':dulieu})  
			.then(function(response) { 
			  $scope.AnhsonRead();
			  $scope.loai = response.data.loai; 
			  $scope.noidung = response.data.noidung; 
			  $scope.status = 'd-block';
			  $scope.Reset();	

			}); 
	 }	
	
	
	$scope.Reset = function(){
     $scope.dulieu = angular.copy(empty); 
	 $scope.newbtn = 'd-block'; 
	 $scope.updatebtn = 'd-none'; 
	 $scope.status = 'd-none'; 	
		
	 }
	
	$scope.edit = function(id){
			$scope.mauedit = "text-danger";
			$scope.dulieu =  $scope.Anhsons.find(result => result.id === id);
			$scope.updatebtn = 'd-block'; 
			$scope.newbtn = 'd-none';
	 }
	
	
//	$scope.all = function(){
//		var i;
//		for (i = 0; i < $scope.Anhsons.length; i++) {
//			$scope.edit(i)
//		 $scope.AnhsonUpdate();
//		}
//			
//	 }	

 });