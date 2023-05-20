<?php

session_start();
// redirect if user is not logged in
if (empty($_SESSION["user_fname"])) {
  header("location: ./index.php");
}

if (isset($_POST["submit"])) {
  include_once "./dbh.inc.php";
  include_once "./functions.inc.php";

  $user_id = $_SESSION["user_id"];
  $title = $_POST["title"];
  createPost($conn, $user_id, $title);
  header("location: ./../home.php");
} else {
  header("location: ./../index.php");
  exit();
}

?>
