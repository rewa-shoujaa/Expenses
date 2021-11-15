<?php

include("connection.php");

if (isset($_POST["email"]) && $_POST["email"] != "") {
	$email = $_POST["email"];
}
else {
	die("Don't try to mess around bro ;)");
}


if (isset($_POST["name"]) && $_POST["name"] != "") {
	$Name = $_POST['name'];
}
else {
	die("Don't try to mess around bro ;)");
}

if (isset($_POST["pass"]) && $_POST["pass"] != "") {
	$password = hash('sha256', $_POST['pass']);
}
else {
	die("Don't try to mess around bro ;)");
}


$id = uniqid();

$x = $connection->prepare("select * from users_tbl where user_email=?");
$x->bind_param("s", $email);
$x->execute();
$result = $x->get_result(); // get the mysqli result
//print_r($result);
//print_r(mysqli_num_rows($result));
//$user = $result->fetch_assoc(); // fetch data   
if (mysqli_num_rows($result) == 0) {
	$y = $connection->prepare("INSERT INTO users_tbl (user_id, user_email, user_name, user_password) VALUES (?, ?, ?, ?)");
	$y->bind_param("ssss", $id, $email, $Name, $password);
	$y->execute();
	//$y->close();

	$y->close();
	$x->close();
	$connection->close();
	header("Location:index.html");
}
else {
	//echo '<script>alert("User already registered!")</script>';
	echo '<script type="text/javascript">';
	echo 'alert("User already registered!");';
	echo 'window.location.href = "sign_up.html";';
	echo '</script>';
	$x->close();
	$connection->close();
//header("Location:sign_up.html");
//echo '<script>alert("User already registered!")</script>';

}




?>