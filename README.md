# crud_php
TP: CRUD with PHP

![image](https://github.com/sbaisCodes/crud_php/blob/main/CRUD_app/imgs/home_page.PNG)
![image](https://github.com/sbaisCodes/crud_php/blob/main/CRUD_app/imgs/create.PNG)
![image](https://github.com/sbaisCodes/crud_php/blob/main/CRUD_app/imgs/delete.PNG)
![image](https://github.com/sbaisCodes/crud_php/blob/main/CRUD_app/imgs/update.PNG)
![image](https://github.com/sbaisCodes/crud_php/blob/main/CRUD_app/imgs/read.PNG)




### Function.php

To avoid writing the same code each time 
i added this "functions.php". 
It includes : 
- a function to connect to the DB 
- the second one to generate the header 
- the third one to generate the footer

------------------------------------------------------------------------------	
- Connecting to DB function : 
Contains the PDO method which is a lean and consistent way to abstract the way we access the DB, PDO or PHP Data Object use the object oriented paradigm so it just works for PHP 5 and above and it works with multiple DB, for more information visit : 
+ https://www.w3resource.com/php/pdo/php-pdo.php

	It contains also another use of string manipulation which is the HEREDOC for more information visit : 
+ https://www.php.net/manual/en/language.types.string.php#language.types.string.syntax.heredoc
+ https://www.exakat.io/en/fun-with-delimiters-of-heredoc-php/
------------------------------------------------------------------------------	

### Read.php

Prepared statements are so useful that they are the only feature that PDO will emulate for drivers that don't support them. 
This ensures that an application will be able to use the same data access paradigm regardless of the capabilities of the database.

for more information about prepared stmt : https://www.php.net/manual/en/pdo.prepared-statements.php

EXAMPLE -------------------
This example performs an INSERT query by substituting a name and a value for the named placeholders.
<?php
$stmt = $dbh->prepare("INSERT INTO REGISTRY (name, value) VALUES (:name, :value)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':value', $value);

// insert one row
$name = 'one';
$value = 1;
$stmt->execute();

// insert another row with different values
$name = 'two';
$value = 2;
$stmt->execute();

?>
-------------------------------------------------------------------

FOR MORE INFORMATION ABOUT PDO CONSTANTS : https://www.php.net/manual/en/pdo.constants.php

PDO::FETCH_ASSOC (int)
Specifies that the fetch method shall return each row as an array indexed by column name as returned in the corresponding result set. 
If the result set contains multiple columns with the same name, 
PDO::FETCH_ASSOC returns only a single value per column name.



