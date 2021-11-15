<?php

include("connection.php");
$userID = $_GET["id"];
$response = array();
$sql = 'select * from expenses_tbl inner join categories_tbl on expenses_tbl.category_id=categories_tbl.cat_id where expenses_tbl.user_id="' . $userID . '"';
$result = mysqli_query($connection, $sql);
if ($result) {
    header("Content-Type: JS");
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $response[$i]['expense_id'] = $row['expense_id'];
        $response[$i]['category_id'] = $row['category_id'];
        $response[$i]['category'] = $row['cat_name'];
        $response[$i]['amount'] = $row['expense_amount'];
        $response[$i]['date'] = $row['expense_date'];


        $i++;

    }
    //$array=json_encode($response);
    //print(gettype($response[0]['image']));
    //print_r($response);
    echo json_encode($response, JSON_PRETTY_PRINT);
//print_r(json_encode($response, JSON_PRETTY_PRINT));
}

?>