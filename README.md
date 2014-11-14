#newsletterboilerplate


**My "PRAO"-work for Genero**

I put some demo images how it could look in /demoimages

##The task was the following:
 - Make a standalone website powered by LAMP (I've never used it before now)
 - The website features:
 	* Responsive image on the top of the page
 	* Dynamic langauge selector
 	* A form which users should sign up for a newsletter
 	* Up to three dynamic form questions
 	* Save form data to a MySQL database for querying
 	* Compatible with IE9, Firefox, Safari and Chrome
 - It should be easy to customize and ship to customers
 - It should be open-source, feel free to fork and use it

##Customizing it

1. First, download this repository
2. Install node.js
3. Install grunt-cli
4. Install ruby and sass
4. Apache and PHP and a MySQL db is certainly required
5. Run `npm install` in the root directory
6. When all required software is installed, you can easily customize it in these three locations
  * /public/config.php
  * /src/sass/theme.scss
  * /public/locales/*


### Localization

A little bit of en.json:
```
{
	"header": "Hello",
	"formHeader": "Let's get some news",
	"firstName": "First name",
	"lastName": "Last name",
	"email": "Email",
	"gender": "Gender",
	"male": "Male",
	"female": "Female",
	"terms": "I accept the Terms and Conditions",
	"submit": "Submit and get...",
}
```

You can customize the .json files in /public/locales/ this way with your own content
Available keywords: 
 - header
 - details
 - formHeader
 - firstName
 - firstNameValidation
 - lastName
 - lastNameValidation
 - email
 - emailValidation
 - gender
 - male
 - female
 - terms
 - submit

After you've written some langauge files (max 3, due css), head over to config.php 

### config.php

```
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
$defaultLangIndex = 1; //HERE ENGLISH IS DEFAULT

//FOR EXAMPLE YOU COULD DO THIS, (OR SOME DYNAMIC ARRAY CALCULATION)
//$defaultLangIndex = $_GET["lang"] == "en" ? 1 : $_GET["lang"] == "sv" ? 0 : 2

//INDICATES IF LANGAUGES SHOULD BE PRESENT ON PAGE
$viewLang = true;

//UP TO THREE QUESTIONS
$questions = array(
	0 => array(
		"questionName" => "alright", //WRITE A KEYWORD HERE, AND SPECIFY THE TEXT IN .json FILES
		"type" => "radio", //AVAILABLE TYPES: radio, text, check
		"optionsNames" => array( //IF type: radio THEN SPECIFY SOME OPTIONS
			0 => "yes", //THE SAME HERE THIS IS A KEYWORD, NOT THE TEXT
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
$redirectTo = "test.php"; //E.G A THANKS PAGE


//MYSQL CONNECTION PARAMETERS
$mysql_host = "localhost";
$mysql_login_user_name = "root";
$mysql_login_password = "password_here";
$mysql_db_name = "your_db";
```


###MySQL Database

Set up a MySQL Server and create following table
```
CREATE TABLE `subscribers` (
  `nws_id` int(11) NOT NULL AUTO_INCREMENT,
  `nws_first_name` varchar(20) NOT NULL,
  `nws_last_name` varchar(20) NOT NULL,
  `nws_email` varchar(50) NOT NULL,
  `nws_isMale` bit(1) NOT NULL,
  `nws_lang` varchar(10) NOT NULL,
  `nws_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nws_q1` varchar(20) DEFAULT NULL,
  `nws_a1` varchar(40) DEFAULT NULL,
  `nws_q2` varchar(20) DEFAULT NULL,
  `nws_a2` varchar(40) DEFAULT NULL,
  `nws_q3` varchar(20) DEFAULT NULL,
  `nws_a3` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`nws_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
SELECT * FROM newsletterDB.subscribers;
```

Remember to replace the variables in config.php to your settings


###Styling (theme.scss)

These styling options do you have with ease:

```
//THE BACKGROUND COLOR OF THE FORM
$formBG: rgba(245, 233, 11, 0.7);

//FORM TEXT COLOR
$formColor: black;

//THE SUBMIT BUTTON BACKGROUND COLOR
$submitBG: lightgreen;

//THE SUBMIT BUTTON TEXT COLOR
$submitColor: white;

//THE LANGAUGE BUTTONS' BACKGROUND COLOR
$lang1Background: blue;
$lang2Background: green;
$lang3Background: yellow;

.logo{
	//WHEN BIG SCREEN
	@media #{$large-up}{

		//GET EXTERNAL PICTURE, IF THE PAGE IS LARGE THE WHOLE TIME, THE OTHER IMAGES WILL NOT BE LOADED
		background: url("http://www.jaybeeprinters.com/img/background/ae.jpg");

		//SPECIFY FIXED HEIGHT FOR BROWSERS WHO DOESN'T SUPPORT CALC()
		height: 85px;

		//SPECIFY DYNAMIC HEIGHT OF THE PICTURE
		//calc(100vw(full page width) / (yourimg.width / yourimg.height))
		height: calc(100vw / 1.65);
	}
	@media #{$medium-only}{

		//GET INTERNAL PICTURE FROM public/img/, current directory is public/css
		background: url("../img/ribbon-banner.jpg");
		height: 110px;
		height: calc(100vw / 2);
	}
	@media #{$small-only}{ //VIA FOUNDATION small-up, medium-up and large-up IS AVAILABLE
		background: url("http://www.logomoose.com/wp-content/uploads/2011/10/platform.jpg");	
		height: 150px;
		height: calc(100vw / 2);
	}
}
```


##Performance and dependecies

Dependencies:
 - Foundation 5
   * Uses only Foundation Grid, Forms and Type
   * Normalize is included
   * Global is modified to not repeat the same styles over and over again to save bytes
   * Everything is compiled with grunt and sass
 - AngularJS
   * v1.2.20
   * From Google CDN for performance and caching
   * Also minimified
 - Grunt
   * Two tasks:
   	 - `grunt dev` for development
   	 - `grunt` for production
   * Libraries:
     - uglify for optimizing js
     - sass for writing and converting to css (surprise)
     - imagemin for optimizing images





##Versions

#### - 0.4.0 First stable version



##License

#####MIT License
Check out the LICENSE file in current directory

Disclaimer, 
**I do not own any of the files linked in theme.css**