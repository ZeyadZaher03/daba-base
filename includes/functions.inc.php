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
  $cpassword
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
  $sql = "SELECT * FROM login WHERE email = ?";
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

function createLogin($conn, $email, $password)
{
  $sql = "INSERT INTO login(email, password) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ./../index.php?error=createUser");
    exit();
  }

  $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

  mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPwd);

  mysqli_stmt_execute($stmt);
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
  createLogin($conn, $email, $password);
  $login_id = mysqli_insert_id($conn);
  $date = $year . "-" . $month . "-" . $day;
  $sql =
    "INSERT INTO user_(Fname, Lname, DOB, password, login_id) VALUES (?, ?, ?, ?, ?);";
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
    $login_id
  );

  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  $uidExists = uidExists($conn, $email);
  session_start();
  $_SESSION["user_id"] = $uidExists["id"];
  $_SESSION["user_fname"] = $uidExists["Fname"];
  $_SESSION["user_lname"] = $uidExists["Lname"];
  $_SESSION["user_email"] = $email;
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
    "INSERT INTO sharing_activity(UserId, PostId, IsCreated) VALUES (?, ?, ?);";
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
  $sql = "INSERT INTO post(Title, CreatedBy) VALUES (?, ?);";
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
    "SELECT " . "post.PostId, " . "post.title, " . "post.likes " . "FROM post ";

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
