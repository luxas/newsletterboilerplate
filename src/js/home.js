angular.module("nl", []).controller("MainCtrl", ["$scope", "$http", function ($scope, http) {

	//DEFAULT MALE
	$scope.gender = "Male"

	//IF LANGAUGES SHOULD BE VIEWED
	$scope.viewLangs = _viewLangs;

	//THE ARRAY OF LANGAUGES, DEFINED IN CONFIG.PHP
	$scope.langs = _langs


	$scope.langs[_defLang].data = _lang;

	$scope.lang = $scope.langs[_defLang].data;

	$scope.switchLang = function (lang) {
		if(!lang.data){
			http.get('locales/' + lang.prefix.toLowerCase() + ".json").
			  success(function(data, status, headers, config) {
			    lang.data = data;

			    if(lang.data)
		    		$scope.lang = lang.data;
			  })
		}
		else{
			$scope.lang = lang.data;
		}
	}
	$scope.curLang = function () {
		var prefix = ""
		$scope.langs.forEach(function (l) {
			if(l.data == $scope.lang) prefix = l.prefix;
		})
		return prefix.toLowerCase();
	}

	$scope.questions = _questions;
}])