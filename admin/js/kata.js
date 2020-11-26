angular.module('Admin', []);
angular.module('Admin').controller('Dashboard', function($scope, $http ,$window) {

$scope.notinewhv = function(hoten,sdt)
{
	 var data = {hoten:hoten, sdt: sdt,status:1};
    $scope.notificaHVs.$add(data);	
	console.log('Them Ok');
}
	
	
$scope.CreateSQL = function(dulieu)
{
	   $http.post("index.php?option=com_kata&task=Kata.CreateTable&format=raw",{'dulieu':dulieu})  
    .then(function(data) { 
  		console.log(data);

    });
	
}
	
	
$scope.CheckPass = function(dulieu) {
	console.log(dulieu);
	
	
//   $http.post("/index.php?option=com_timona&task=Dangkyhoc.CheckPass&format=raw",{'dulieu':dulieu})  
//    .then(function(data) { 
//  		console.log(data);
//	  // $scope.notify = data.data.status;
//	  // $scope.content = data.data.content;
//    }); 
  }; 
	
	
});