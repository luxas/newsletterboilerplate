<?php

//CHOOSE THREE LANGAUGES
$langs = array(
	0 => array(
		"prefix" => "SV",
		"langName" => "SVENSKA"
	),
	1 => array(
		"prefix" => "EN",
		"langName" => "ENGLISH"
	),
	2 => array(
		"prefix" => "FI",
		"langName" => "SUOMEA"
	)
);


//WHICH OF THEM SHOULD BE DEFAULT, OR SOME CALCULATION
$defaultLangIndex = 1;
//FOR EXAMPLE YOU COULD DO THIS, (OR SOME DYNAMIC ARRAY CALCULATION)
//$defaultLangIndex = $_GET["lang"] == "en" ? 1 : $_GET["lang"] == "sv" ? 0 : 2

//INDICATES IF LANGAUGES SHOULD BE PRESENT ON PAGE
$viewLang = true;

//UP TO THREE QUESTIONS
$questions = array(
	0 => array(
		"questionName" => "alright",
		"type" => "radio",
		"optionsNames" => array(
			0 => "yes",
			1 => "no",
			2 => "maybe"
		)
	),
	1 => array(
		"questionName" => "likesPHP",
		"type" => "check"
	),
	2 => array(
		"questionName" => "comments",
		"type" => "text"
	)
);


//WHERE SHOULD WE REDIRECT AFTER SUCCESSFUL INPUT?
$redirectTo = "thanks.php";


//MYSQL CONNECTION PARAMETERS
$mysql_host = "localhost";
$mysql_login_user_name = "root";
$mysql_login_password = "password_here";
$mysql_db_name = "your_db";

?>