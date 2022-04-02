<!-- Our CRUD app's home page  -->


<!-- MODIFY THIS PAGE -->

<?php
include 'functions.php';
?>

<?=template_header('Home')?>

<div class="content">
	<h2>Home Page</h2>
</div>

<div class="btns">
    <div class="btn-left"><a href="read.php"><i class="fas fa-book"> </i> READ</a></div>
    <div class="btn-right"><a href="create.php"><i class="fas fa-user"> </i> CREATE</a></div>
</div>

<?=template_footer()?>