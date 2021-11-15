<?php

include("connection.php");

if (isset($_POST["email"]) && $_POST["email"] != "") {
	$email = $_POST["email"];
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

$x = $connection->prepare("select * from users_tbl where user_email=? And user_password=?");
$x->bind_param("ss", $email, $password);
$x->execute();
$result = $x->get_result(); // get the mysqli result
//print_r(mysqli_num_rows($result));
//$user = $result->fetch_assoc(); // fetch data   
if (mysqli_num_rows($result) != 0) {
	$user = $result->fetch_assoc();
	session_start();
	$_SESSION["User_Name"] = $user['user_name'];
	$_SESSION["User_ID"] = $user['user_id'];
	echo($user['user_id']);
	$x->close();
	$connection->close();
	header("Location:expenses.php");
}
else {
	//echo '<script>alert("User already registered!")</script>';
	echo '<script type="text/javascript">';
	echo 'alert("Wrong username or password");';
	echo 'window.location.href = "index.html";';
	echo '</script>';
	$x->close();
	$connection->close();
//header("Location:sign_up.html");
//echo '<script>alert("User already registered!")</script>';

}




?>