var app = angular.module("Kata", ['ui.tinymce','ngSanitize']);
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
 app.controller("Kata",function($scope, $http,$compile) {
    $scope.tinymceOptions = {
        plugins: 'code',
    };
	 $scope.limit = 100;
	 $scope.offset =0;
	 $scope.newbtn = 'd-block'; 
	 $scope.updatebtn = 'd-none'; 
	 $scope.status = 'd-none'; 
	$scope.empty = {};
	 $scope.code ='';
	var empty = angular.copy($scope.empty);
	 
	$scope.OpenFile = function(index)
	{
		$scope.dulieu = $scope.Files[index];
	 }	 
	  
	$scope.EditorCreate = function(dulieu)
	{
		$http.post("index.php?option=com_katas&task=Kata.EditorCreate&format=raw",{'dulieu':dulieu})  
			.then(function(response) { 
			 $scope.Reset();
			   console.log(response);		
			}); 
	 }
	$scope.CSDLCreate = function()
	{
		$http.post("index.php?option=com_katas&task=Kata.CSDLCreate&format=raw")  
			.then(function(response) { 
			   console.log(response);		
			}); 
	 }	
	$scope.EditorRead = function(){
		   $http.post("index.php?option=com_katas&task=Kata.EditorRead&format=raw")  
			.then(function(response) { 
			   console.log(response);
			 $scope.Files = response.data; 
			}); 
	 }
	
	$scope.EditorUpdate = function(dulieu){
		   $http.post("index.php?option=com_katas&task=Kata.EditorUpdate&format=raw",{'dulieu':dulieu})  
			.then(function(response) { 
			   console.log(response);
			   $scope.Reset();
			}); 
	 }	
	
	
	$scope.EditorDelete = function(dulieu){
		   $http.post("index.php?option=com_katas&task=Kata.EditorDelete&format=raw",{'dulieu':dulieu})  
			.then(function(response) { 
			  $scope.Reset();
			}); 
	 }	
	
	
	$scope.Reset = function(){
     $scope.dulieu = angular.copy(empty); 
	 $scope.EditorRead();	
		
	 }
	
	$scope.edit = function(index){
			$scope.mauedit = "text-danger";
			$scope.dulieu = $scope.Anhsons[index];
			$scope.updatebtn = 'd-block'; 
			$scope.newbtn = 'd-none';
	 }	

 });