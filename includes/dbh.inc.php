<?php

$server_name = "localhost";
$db_user_name = "root";
$db_password = "";
$db_name = "facebook_od";

$conn = mysqli_connect($server_name, $db_user_name, $db_password, $db_name);

if (!$conn) {
  die("connect failed" . mysqli_connect_error());
}

?>
