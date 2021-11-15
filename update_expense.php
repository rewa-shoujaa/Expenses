<?php

include("connection.php");

$expenseID = $_GET["id"];
$amount = $_POST['amount'];
$Date = $_POST['Date'];


$y = $connection->prepare("UPDATE expenses_tbl SET expense_amount = ?, expense_date = ? WHERE expense_id=?;");
$y->bind_param("isi", $amount, $Date, $expenseID);
$y->execute();
//$y->close();



$y->close();
$connection->close();
