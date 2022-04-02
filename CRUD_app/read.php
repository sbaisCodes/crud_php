<?php
include 'functions.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
/*
------------------------------------------------------------------------------------------------------
// isset() returns true if the variable exists and is not NULL otherwise return false
 Returns a bool (true or false)
 EXAMPLE -----------------
isset($x);

$x = 'myValue';
if(isset($x)){
	echo 'x is set';
}

this will echo out 'x is set'

-----------------------------------------------------------------------------------------------------------
*/


// Number of records to show on each page
$records_per_page = 5;

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
/*
-----------------------------------------------------------------------------------------------------------
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


++++++++++++++++++++++++

Prepared statements are so useful that they are the only feature that PDO will emulate for drivers that don't support them. 
This ensures that an application will be able to use the same data access paradigm regardless of the capabilities of the database.
----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
*/ 
$stmt = $pdo->prepare('SELECT * FROM contacts ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT); // PDO::PARAM_INT (int) Represents the SQL INTEGER data type
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
/*
--------------------------------------------------------------------------------------
FOR MORE INFORMATION ABOUT PDO CONSTANTS : https://www.php.net/manual/en/pdo.constants.php

PDO::FETCH_ASSOC (int)
Specifies that the fetch method shall return each row as an array indexed by column name as returned in the corresponding result set. 
If the result set contains multiple columns with the same name, 
PDO::FETCH_ASSOC returns only a single value per column name.
--------------------------------------------------------------------------------------
*/ 

// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM contacts')->fetchColumn();
?>

<?=template_header('Read')?>

<div class="content read">
	<h2>Read Contacts</h2>
	<a href="create.php" class="create-contact">Create Contact</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Job</td>
                <td>Created Date</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?=$contact['id']?></td>
                <td><?=$contact['name']?></td>
                <td><?=$contact['email']?></td>
                <td><?=$contact['phone']?></td>
                <td><?=$contact['title']?></td>
                <td><?=$contact['created']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$contact['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$contact['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_contacts): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>