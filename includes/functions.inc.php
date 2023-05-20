<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

// sign up
function emptyInputSignup(
  $fname,
  $lname,
  $email,
  $year,
  $month,
  $day,
  $password,
  $cpassword,
  $gender
) {
  $result = false;
  if (
    empty($fname) ||
    empty($lname) ||
    empty($email) ||
    empty($year) ||
    empty($month) ||
    empty($day) ||
    empty($password) ||
    empty($cpassword)
  ) {
    $result = true;
  }
  return $result;
}

function inValidEmail($email)
{
  $result = false;
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
  }
  return $result;
}

function pwdMatch($password, $cpassword)
{
  $result = false;
  if ($password !== $cpassword) {
    $result = true;
  }
  return $result;
}

function uidExists($conn, $email)
{
  $sql = "SELECT * FROM users WHERE email = ?";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ./../index.php?error=uidExists");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $email);
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($resultData)) {
    return $row;
  } else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function createUser(
  $conn,
  $fname,
  $lname,
  $email,
  $year,
  $month,
  $day,
  $password
) {
  $date = $year . "-" . $month . "-" . $day;
  $sql =
    "INSERT INTO users(firstName, lastname, DOB, password, email) VALUES (?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ./../index.php?error=createUser");
    exit();
  }

  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param(
    $stmt,
    "sssss",
    $fname,
    $lname,
    $date,
    $hashedPwd,
    $email
  );

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  $uidExists = uidExists($conn, $email);
  session_start();
  $_SESSION["user_id"] = $uidExists["id"];
  $_SESSION["user_fname"] = $uidExists["fname"];
  $_SESSION["user_lname"] = $uidExists["lname"];
  $_SESSION["user_email"] = $uidExists["email"];
  header("location: ./../home.php");
  exit();
}

// login

function emptyInputLogin($email, $password)
{
  $result = false;
  if (empty($email) || empty($password)) {
    $result = true;
  }
  return $result;
}

function loginUser($conn, $email, $password)
{
  $uidExists = uidExists($conn, $email);
  if ($uidExists === false) {
    header("location: ./../index.php?error=uidExists");
    exit();
  }

  $pwdHashed = $uidExists["password"];
  $checkPwd = password_verify($password, $pwdHashed);

  if ($checkPwd === false) {
    header("location: ./../index.php?error=pwdIncorrect");
    exit();
  } elseif ($checkPwd === true) {
    session_start();
    $_SESSION["user_id"] = $uidExists["id"];
    print_r($uidExists);
    $_SESSION["user_fname"] = $uidExists["firstName"];
    $_SESSION["user_lname"] = $uidExists["lastName"];
    $_SESSION["user_email"] = $uidExists["email"];
    header("location: ./../home.php");
    exit();
  }
}

// create post

function emptyInputPost($userId, $title)
{
  $result = false;
  if (empty($userId) || empty($title)) {
    $result = true;
  }
  return $result;
}

function createPostRelationship($conn, $userId, $postId, $is_created)
{
  $sql =
    "INSERT INTO user_post_relationship(user_id, post_id, is_created) VALUES (?, ?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ./../home.php?error=createUser");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ssi", $userId, $postId, $is_created);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  header("location: ./../home.php");
  exit();
}

function createPost($conn, $userId, $title)
{
  $sql = "INSERT INTO posts(title, creator) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ./../home.php?error=createUser");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $title, $userId);

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $post_id = mysqli_insert_id($conn);
  $is_created = true;
  createPostRelationship($conn, $userId, $post_id, $is_created);
}

function getPosts($conn)
{
  $sql =
    "SELECT " .
    "posts.post_id, " .
    "posts.title, " .
    "posts.likes, " .
    "relation.is_created, " .
    "creator.id as creator_id, " .
    "CONCAT(creator.firstName, '' ,creator.lastName) as creator_name, " .
    "CONCAT(user_activity.firstName, ' ' ,user_activity.lastName) as activity_name, " .
    "user_activity.id as activity_id " .
    "FROM posts as posts " .
    "INNER JOIN users as creator ON creator.id = posts.creator " .
    "INNER JOIN user_post_relationship as relation ON posts.post_id=relation.post_id " .
    "INNER JOIN users as user_activity ON relation.user_id=user_activity.id ";

  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ./../index.php?error=uidExists");
    exit();
  }
  mysqli_stmt_execute($stmt);

  $resultData = mysqli_stmt_get_result($stmt);

  mysqli_stmt_close($stmt);
  return $resultData;
}

?>
