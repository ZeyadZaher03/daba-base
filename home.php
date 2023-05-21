
<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="description" content="Portfólio João Enrique">
  <meta charset="UTF-8"/>
  <link class="imgtitulo" rel="icon" type="imagem/png" href="imagens/icccccccccc.png">
  <title>Facebook</title>
  <link href="./css/style.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
      <a class="navbar-logo" href="./home.php">
        <!-- logo icon -->
        <svg xmlns="http://www.w3.org/2000/svg" width="37" height="37" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
          <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
        </svg>
        
      </a>
      <div class="nav-items">
        <div class="nav-item">
            <span >
              <?php
              session_start();
              echo $_SESSION["user_fname"] . " " . $_SESSION["user_lname"];
              ?>
            </span>
        </div>
        <div class="nav-item">
            <a href="./includes/logout.inc.php" class="logout">logout</a>
        </div>
      </div>
    </nav>
    <form method="post" action="./includes/post.inc.php">
      <div class="wrapper">
        <section class="create-post">
          <h3>Create post</h3>
          <input class="craete-post-input" type="text" required="true" name="title" placeholder="write what's on your mind"/>
          <button class="post-button" type="submit" name="submit">Post</a>
        </section>
      </div>
    </form>
    <div class="post-wrapper">
    <?php
    include_once "./includes/dbh.inc.php";
    include_once "./includes/functions.inc.php";

    $resultData = getPosts($conn);
    while ($row = mysqli_fetch_assoc($resultData)) {

      $post_id = $row["PostId"];
      $title = $row["title"];
      $likes = $row["likes"];
      ?>
        <div class="post">
          
          <p class="title"><?php echo $title; ?></p>

          <div>
            <p>likes: <?php echo (string) $likes; ?></p>
            <p>shares: <?php echo (string) $likes; ?></p>
          </div>
        </div>
    <?php
    }
    ?>
    </div>
</body>
</html>