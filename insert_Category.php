<?php

include("connection.php");
$userID = $_GET["id"];
$category = $_POST['category'];



$y = $connection->prepare("INSERT INTO categories_tbl (user_id, cat_name) VALUES (?, ?)");
$y->bind_param("ss", $userID, $category);
$y->execute();
//$y->close();
$id = $y->insert_id;


$y->close();
$connection->close();
$result = [];
$result["id"] = $id;


echo json_encode($result, JSON_PRETTY_PRINT);
