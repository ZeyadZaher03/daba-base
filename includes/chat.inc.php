<?php

session_start();
// redirect if user is not logged in
if (empty($_SESSION["user_fname"])) {
  header("location: ./index.php");
}

if (isset($_POST["submit"])) {
  include_once "./dbh.inc.php";
  include_once "./functions.inc.php";

  $sender_id = $_SESSION["user_id"];
  $reciver_id = $_POST["reciver_id"];
  $message = $_POST["title"];
  echo $sender_id;
  echo $reciver_id;
  createMessage($conn, $sender_id, $reciver_id, $message);
  header("location: ./../chat.php?id=$reciver_id");
} else {
  header("location: ./../index.php");
  exit();
}

?>
