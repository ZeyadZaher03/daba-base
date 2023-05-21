<?php

if (isset($_POST["submit"])) {
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email = $_POST["email"];
  $year = $_POST["year"];
  $month = $_POST["month"];
  $day = $_POST["day"];
  $password = $_POST["password"];
  $cpassword = $_POST["cpassword"];
  $gender = $_POST["gender"];

  include_once "./dbh.inc.php";
  include_once "./functions.inc.php";

  // if (
  //   emptyInputSignup(
  //     $fname,
  //     $lname,
  //     $email,
  //     $year,
  //     $month,
  //     $day,
  //     $password,
  //     $cpassword,
  //     $gender
  //   ) !== false
  // ) {
  //   header("location: ./../index.php?error=1");
  //   exit();
  // }

  // if (invalidEmail($email) !== false) {
  //   header("location: ./../index.php?error=1");
  //   exit();
  // }

  // if (pwdMatch($password, $cpassword) !== false) {
  //   header("location: ./../index.php?error=1");
  //   exit();
  // }

  // if (uidExists($conn, $email) !== false) {
  //   header("location: ./../index.php?error=1");
  //   exit();
  // }

  createUser(
    $conn,
    $fname,
    $lname,
    $email,
    $year,
    $month,
    $day,
    $password,
    $gender
  );
} else {
  header("location: ./../index.php");
  exit();
}

?>
