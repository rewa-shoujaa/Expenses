<?php

include("connection.php");
$userID = $_GET["id"];
$response = array();
$sql = 'SELECT * FROM categories_tbl where user_id="' . $userID . '"';
$result = mysqli_query($connection, $sql);
if ($result) {
    header("Content-Type: JS");
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $response[$i]['category_ID'] = $row['cat_id'];
        $response[$i]['category'] = $row['cat_name'];


        $i++;

    }
    //$array=json_encode($response);
    //print(gettype($response[0]['image']));
    //print_r($response);
    echo json_encode($response, JSON_PRETTY_PRINT);
//print_r(json_encode($response, JSON_PRETTY_PRINT));
}

?>