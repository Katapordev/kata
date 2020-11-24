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
	$scope.FieldsRead = function(){
		   $http.post("index.php?option=com_katas&task=Anhson1.FieldsRead&format=raw")  
			.then(function(response) { 
			$scope.Fields = response.data; 
			angular.forEach($scope.Fields, function (detail) {
				if(detail.field10==1)
					{
				$scope.TT1++;		
					}
				else if(detail.field10==2)
					{
				$scope.TT2++;		
					}
				else if(detail.field10==3)
					{
				$scope.TT3++;		
					}
                })		   
			   console.log(response.data);
			}); 
	 }
           
	$scope.FieldsCreate = function(){
		   $http.post("index.php?option=com_katas&task=Anhson1.FieldsCreate&format=raw",{'dulieu':$scope.dulieu,'idUser':$scope.idUser})  
			.then(function(response) { 
			   console.log(response);
			   $scope.FieldsRead();
			  $scope.Reset();
			 $scope.loai = response.data.loai; 
			  $scope.noidung = response.data.noidung; 
			  $scope.status = 'd-block'; 
			}); 
	 }
	
	$scope.FieldsUpdate = function(){
		   $http.post("index.php?option=com_katas&task=Anhson1.FieldsUpdate&format=raw",{'dulieu':$scope.dulieu})  
			.then(function(response) { 
			   console.log(response);
			   $scope.FieldsRead();
			$scope.Reset();
			 $scope.loai = response.data.loai; 
			  $scope.noidung = response.data.noidung; 
			  $scope.status = 'd-block'; 
			}); 
			console.log($scope.dulieu);
	 }	
	$scope.FieldsRemove = function(dulieu){
		   $http.post("index.php?option=com_katas&task=Anhson1.FieldsRemove&format=raw",{'dulieu':dulieu})  
			.then(function(response) { 
			  $scope.FieldsRead();
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
			$scope.dulieu =  $scope.Fields.find(result => result.id === id);
			$scope.updatebtn = 'd-block'; 
			$scope.newbtn = 'd-none';
	 }
	


 });