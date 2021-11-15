<?php

include("connection.php");
$userID = $_GET["id"];
$amount = $_POST['amount'];
$CategoryID = $_POST['CategoryID'];
$Date = $_POST['Date'];


$y = $connection->prepare("INSERT INTO expenses_tbl (user_id, category_id, expense_amount, expense_date) VALUES (?, ?, ?, ?)");
$y->bind_param("siis", $userID, $CategoryID, $amount, $Date);
$y->execute();
//$y->close();
$id = $y->insert_id;


$y->close();
$connection->close();
$result = [];
$result["id"] = $id;


echo json_encode($result, JSON_PRETTY_PRINT);
