<?php

include("connection.php");
$expenseid = $_GET["id"];

$response = array();
$sql = 'DELETE FROM expenses_tbl where expense_id=' . $expenseid;
$result = mysqli_query($connection, $sql);



?>