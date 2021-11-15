<?php

include("connection.php");
$userID = $_GET["id"];
$response = array();
$sql = 'SELECT sum(expenses_tbl.expense_amount), categories_tbl.cat_name FROM expenses_tbl inner join categories_tbl on expenses_tbl.category_id=categories_tbl.cat_id where expenses_tbl.user_id="' . $userID . '" group by categories_tbl.cat_id';
$result = mysqli_query($connection, $sql);
if ($result) {
    header("Content-Type: JS");
    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $response[$i]['Sum'] = $row['sum(expenses_tbl.expense_amount)'];
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