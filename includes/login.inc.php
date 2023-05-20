<?php

if (isset($_POST["submit"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  include_once "./dbh.inc.php";
  include_once "./functions.inc.php";

  if (emptyInputLogin($email, $password) !== false) {
    header("location: ./../index.php?error=1");
    exit();
  }

  loginUser($conn, $email, $password);
} else {
  header("location: ./../index.php");
  exit();
} ?>
