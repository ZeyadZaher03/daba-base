<?php

session_start();
// redirect if user is not logged in
if (empty($_SESSION["user_fname"])) {
  header("location: ./index.php");
}

if (isset($_POST["post_id"])) {
  include_once "./dbh.inc.php";
  include_once "./functions.inc.php";

  $user_id = $_SESSION["user_id"];
  $post_id = $_POST["post_id"];
  $shared = false;
  createPostRelationship($conn, $user_id, $post_id, $shared);
  header("location: ./../home.php");
} else {
  header("location: ./../index.php");
  exit();
}

?>
