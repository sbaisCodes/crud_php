<!-- To avoid writing the same code each time 
i added this "functions.php". 
It includes : 
- a function to connect to the DB 
- the second one to generate the header 
- the third one to generate the footer
 -->
<!-- 
------------------------------------------------------------------------------	
- Connecting to DB function : 
Contains the PDO method which is a lean and consistent way to abstract the way we access the DB, PDO or PHP Data Object use the object oriented paradigm so it just works for PHP 5 and above and it works with multiple DB, for more information visit : 
+ https://www.w3resource.com/php/pdo/php-pdo.php
+ https://www.youtube.com/watch?v=kEW6f7Pilc4

	It contains also another use of string manipulation which is the HEREDOC for more information visit : 

+ https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc
+ https://www.exakat.io/en/fun-with-delimiters-of-heredoc-php/

------------------------------------------------------------------------------	

 -->
 <?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'phpcrud';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="./style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">

    	<div>
    		<h1>CRUD with PHP</h1>
            <a href="index.php"><i class="fas fa-home"></i>Home</a>
    		<a href="read.php"><i class="fas fa-user"></i>Contacts</a>
    	</div>
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffcb74" fill-opacity="1" d="M0,32L16,69.3C32,107,64,181,96,192C128,203,160,149,192,160C224,171,256,245,288,234.7C320,224,352,128,384,106.7C416,85,448,139,480,149.3C512,160,544,128,576,112C608,96,640,96,672,90.7C704,85,736,75,768,90.7C800,107,832,149,864,160C896,171,928,149,960,144C992,139,1024,149,1056,160C1088,171,1120,181,1152,181.3C1184,181,1216,171,1248,181.3C1280,192,1312,224,1344,240C1376,256,1408,256,1424,256L1440,256L1440,0L1424,0C1408,0,1376,0,1344,0C1312,0,1280,0,1248,0C1216,0,1184,0,1152,0C1120,0,1088,0,1056,0C1024,0,992,0,960,0C928,0,896,0,864,0C832,0,800,0,768,0C736,0,704,0,672,0C640,0,608,0,576,0C544,0,512,0,480,0C448,0,416,0,384,0C352,0,320,0,288,0C256,0,224,0,192,0C160,0,128,0,96,0C64,0,32,0,16,0L0,0Z"></path></svg>

    </nav>
EOT;
}

function template_footer() {
echo <<<EOT
    </body>

</html>
EOT;
}
?>