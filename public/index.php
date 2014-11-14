<?php

include("config.php");

$langName = strtolower($langs[$defaultLangIndex]["prefix"]);

$firstName = $lastName = $email = $gender = $lang = $q1 = $q2 = $q3 = $a1 = $a2 = $a3 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$db = new mysqli($mysql_host, $mysql_login_user_name, $mysql_login_password, $mysql_db_name); //HUR HANTERA DETTA?

	if($db->connect_errno > 0){
	    die('Unable to connect to database [' . $db->connect_error . ']');
	}

	$firstName = convert($_POST["firstName"]);
	$lastName = convert($_POST["lastName"]);
	$email = convert($_POST["email"]);
	$gender = convert($_POST["gender"]);
	$lang = convert($_POST["lang"]);
	$q1 = convert($_POST["q1"]);
	$q2 = convert($_POST["q2"]);
	$q3 = convert($_POST["q3"]);
	$a1 = convert($_POST["a1"]);
	$a2 = convert($_POST["a2"]);
	$a3 = convert($_POST["a3"]);
	$isMale = $gender == "Male";

	$sql = "
	    INSERT INTO subscribers(nws_first_name, nws_last_name, nws_email, nws_isMale, nws_lang, nws_q1, nws_a1, nws_q2, nws_a2, nws_q3, nws_a3)
	    VALUES ('$firstName', '$lastName', '$email', '$isMale', '$lang', '$q1', '$a1', '$q2', '$a2', '$q3', '$a3')
	";

	if(!$result = $db->query($sql)){
	    die('There was an error running the query [' . $db->error . ']');
	}

	header("Location: $redirectTo");
}


function convert($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html ng-app="nl">
	<head>
		<meta charset="utf-8" />
		<!-- // This meta viewport is inserted for iPhones // -->
		<meta name="viewport" content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0">

		<!-- // This meta viewport is inserted for the Nexus S // -->
		<meta name="viewport" content="width=device-width">
		
		<title>Newsletter</title>
		<link rel="stylesheet" type="text/css", href="/dev/newsletter/public/css/home.css" />
	</head>
	<body ng-controller="MainCtrl">
		<div class="row langs" ng-show="viewLangs">
			<div class="wrapper">
				<div class="small-{{Math.floor(12 / langs.length)}} columns" ng-repeat="l in langs" ng-click="switchLang(l)">
					<span>{{l.prefix}}</span>
					<span>{{l.langName}}</span>
				</div>
			</div>
		</div>
		<div class="logo"></div>
		<div class="row">
			<h1>{{lang.header}}</h1>
			<p class="detailstext">{{lang.details}}</p>
		</div>
		<hr>
		<div class="row form-container">
			<form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="small-12 medium-10 large-6 columns small-centered" method="post">
				<h2>{{lang.formHeader}}</h2>																																																																																																																																																																																
				<div class="row">
					<div class="small-12 medium-6 columns">
						<label>{{lang.firstName}}
							<input ng-class="{ error: form.firstName.$dirty && !form.firstName.$valid }" type="text" name="firstName" ng-model="firstName" placeholder="Someone" required maxlength="20" />
							<small ng-class="{ error: form.firstName.$dirty && !form.firstName.$valid }" ng-show="form.firstName.$dirty && !form.firstName.$valid">{{lang.firstNameValidation}}</small>	
						</label>	
					</div>
					<div class="small-12 medium-6 columns">
						<label>{{lang.lastName}}
							<input ng-class="{ error: form.lastName.$dirty && !form.lastName.$valid }" type="text" name="lastName" ng-model="lastName" placeholder="Examplename" required maxlength="20" />
							<small ng-class="{ error: form.lastName.$dirty && !form.lastName.$valid }" ng-show="form.lastName.$dirty && !form.lastName.$valid">{{lang.lastNameValidation}}</small>	
						</label>
					</div>
				</div>
				<div class="row">
				    <div class="small-12 columns">
				        <label>{{lang.email}}
							<input ng-class="{ error: form.email.$dirty && !form.email.$valid }" type="email" name="email" ng-model="email" placeholder="someone@example.com" maxlength="50" />
							<small ng-class="{ error: form.email.$dirty && !form.email.$valid }" ng-show="form.email.$dirty && !form.email.$valid">{{lang.emailValidation}}</small>	
				        </label>
				    </div>
				</div>
				<small></small>
				<div class="row">
					<div class="small-12 columns">
						<label>{{lang.gender}}</label>
						<label class="inline-radio"><input type="radio" ng-model="gender" value="Male" name="gender"  />{{lang.male}}</label>
						<label class="inline-radio"><input type="radio" ng-model="gender" value="Female" name="gender" required/>{{lang.female}}</label>
					</div>
				</div>
				
				<div class="row" ng-repeat="q in questions">
					<div class="small-12 columns">
						<div ng-if="q.type == 'radio'">
							<label>{{lang[q.questionName]}}</label>
							<label class="inline-radio" ng-repeat="o in q.optionsNames"><input type="radio" name="a{{$parent.$index + 1}}" value="{{lang[o]}}">{{lang[o]}}</label>
						</div>
						<div ng-if="q.type == 'text'">
							<label>{{lang[q.questionName]}}
								<input type="text" name="a{{$index + 1}}" maxlength="40"/>
 							</label>
						</div>
						<div ng-if="q.type == 'check'">
							<label>
								<input type="checkbox" name="a{{$index + 1}}" />{{lang[q.questionName]}}
							</label>
						</div>
					</div>
					<input type="hidden" name="q{{$index + 1}}" value="{{lang[questions[$index].questionName]}}" />
				</div>

				<div class="row">
					<div class="small-12 columns">
						<label>
							<input type="checkbox" ng-model="acceptsTC" required />{{lang.terms}}
						</label>
					</div>
				</div>

				<div class="row">
					<div class="small-12 column">
						<input type="submit" value="{{lang.submit}}"/>
					</div>
				</div>

				<input type="hidden" name="lang" value="{{curLang()}}" />
			</form>
		</div>

		<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.20/angular.min.js"></script>
		<script>
			var _lang = <?php
				include("locales/{$langName}.json");
			?>;
			var _langs = <?php echo json_encode($langs); ?>;
			var _defLang = <?php echo $defaultLangIndex; ?>;
			var _questions = <?php echo json_encode($questions); ?>;
			var _viewLangs = <?php echo $viewLang; ?>;
		</script>
		<script src="/dev/newsletter/public/js/home.min.js"></script>
	</body>
</html>

