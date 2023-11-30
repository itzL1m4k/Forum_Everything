<!DOCTYPE html>
<html lang="pl-PL">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="css/global_styles.css" />
  <link rel="stylesheet" href="css/new_post_styles.css">
  <title>Forum Everything</title>
</head>

<body>
  <button id="to-top-btn" onclick="scrollToTop()" class="btn btn-primary">
    <img id="arrow-up" src="assets/img/arrow_up.svg" alt="strzałka do góry" />
  </button>
  <div class="container">
    <div class="logo text-center mt-3">
      <h1 class="display-4"><a href="index.php" class="text-decoration-none">Forum Everything</a></h1>
    </div>
    <header class="d-flex mt-3">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item"><a href="index.php" class="nav-link">Wpisy</a></li>
              <li class="nav-item"><a href="https://github.com/itzL1m4k/Forum_Everything" target="_blank" rel="noopener" class="nav-link">Dokumentacja</a></li>
              <li class="nav-item"><a href="about_code_2.html" class="nav-link">Kod JavaScript</a></li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item login-nav"><a href="user_authentication.php?config=login" class="nav-link">Zaloguj się</a></li>
              <li class="nav-item login-nav"><a href="user_authentication.php?config=register" class="nav-link">Zarejestruj się</a></li>
              <li class="nav-item yourAccount hidden"><a href="user_profile.php" class="nav-link">Twoje konto</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <section class="content">
      <div class="show-new-post hidden">
        <button type="button" id="post-button" class="btn btn-primary">Utwórz Post</button>
      </div>
      <div class="create-new-post hidden">
        <form action="php/new_post_handler.php" method="POST" enctype="multipart/form-data">
          <label for="post-title" class="form-label">Tytuł:</label>
          <input type="text" id="post-title" name="post-title" placeholder="Napisz tutaj tytuł swojego postu!" required>
          <label for="post-content" class="form-label">Treść:</label>
          <textarea id="post-content" name="post-content" placeholder="Napisz treść swojego postu!" required></textarea>
          <label for="image-input" class="form-label">Obrazek: &lt; 3Mb </label>
          <input type="file" name="post-image" accept="image/*" id="image-input" onchange="validateImageSize(this)">
          <button type="submit" class="btn btn-primary">Dodaj post</button>
          <button type="reset" class="btn btn-secondary">Wyczyść</button>
          <button type="button" id="post-button-decline" class="btn btn-danger">Anuluj</button>
        </form>
      </div>
      <?php
      function generateForm($order, $showUserPosts, $showAllPosts)
      {
      ?>
        <form class="form-bg" method="post" action="">
          <label class="list-choose" for="order">Sortuj według </label>
          <select name="order" id="order" onchange="this.form.submit()">
            <?php
            $sortOptions = [
              ['value' => 'DESC', 'label' => 'Najnowszych'],
              ['value' => 'ASC', 'label' => 'Najstarszych']
            ];
            foreach ($sortOptions as $option) {
              $selected = $order === $option['value'] ? 'selected' : '';
              echo "<option value='{$option['value']}' {$selected}>{$option['label']}</option>";
            }
            ?>
          </select>
          <label class="list-choose" for="show-posts">Pokaż posty </label>
          <select name="show-posts" id="show-posts" onchange="this.form.submit()">
            <?php
            $showOptions = [
              ['value' => 'all', 'label' => 'Wszystkie'],
              ['value' => 'mine', 'label' => 'Moje']
            ];
            foreach ($showOptions as $option) {
              $selected = ($showAllPosts && $option['value'] === 'all') || ($showUserPosts && $option['value'] === 'mine') ? 'selected' : '';
              echo "<option value='{$option['value']}' {$selected}>{$option['label']}</option>";
            }
            ?>
          </select>
        </form>
      <?php
      }

      function generateDeleteScript($postId, $commentId = null)
      {
      ?>
        <script>
          function deletePost(postId) {
            Swal.fire({
              title: 'Czy na pewno chcesz usunąć ten post?',
              icon: 'question',
              showCancelButton: true,
              confirmButtonText: 'Tak, usuń',
              cancelButtonText: 'Anuluj',
              customClass: {
                popup: 'my-custom-popup-class',
                title: 'my-custom-title-class',
                content: 'my-custom-content-class',
                confirmButton: 'my-custom-button-class',
                cancelButton: 'my-custom-button-class',
              },
            }).then((result) => {
              if (result.isConfirmed) {
                var url = 'php/delete_post.php?id=' + postId;
                window.location.href = url;
              }
            });
          }

          function deleteComment(commentId) {
            Swal.fire({
              title: 'Czy na pewno chcesz usunąć ten komentarz?',
              icon: 'question',
              showCancelButton: true,
              confirmButtonText: 'Tak, usuń',
              cancelButtonText: 'Anuluj',
              customClass: {
                popup: 'my-custom-popup-class',
                title: 'my-custom-title-class',
                content: 'my-custom-content-class',
                confirmButton: 'my-custom-button-class',
                cancelButton: 'my-custom-button-class',
              },
            }).then((result) => {
              if (result.isConfirmed) {
                var url = 'php/delete_comment.php?id=' + commentId;
                window.location.href = url;
              }
            });
          }
        </script>
        <?php
      }

      require_once("php/database_connection.php");
      session_start();

      $currentUserId = $_SESSION['user_id'] ?? null;
      $order = $_POST['order'] ?? 'DESC';
      $showPostsOption = $_POST['show-posts'] ?? '';
      $showUserPosts = $showPostsOption === 'mine';
      $showAllPosts = $showPostsOption === 'all';
      $whereClause = '';

      if ($showUserPosts && $currentUserId && !$showAllPosts) {
        $whereClause = " WHERE wpisy.autor_id = $currentUserId";
      }

      $sql = "SELECT wpisy.*, uzytkownicy.nickname FROM wpisy JOIN uzytkownicy ON wpisy.autor_id = uzytkownicy.user_id" . $whereClause . " ORDER BY wpisy.data_publikacji $order";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        generateForm($order, $showUserPosts, $showAllPosts);

        foreach ($rows as $row) {
        ?>

          <div class='post-section'>
            <h2> <?= $row["tytul"] ?> </h2>
            <p><strong>Autor: </strong> <?= $row["nickname"] ?> </p>
            <p> <?= $row["tresc"] ?> </p>
            <div class='image-container'>
              <img src='data:image/jpeg;base64,<?= base64_encode($row['obrazek']) ?>' alt='' class='post-image' onclick='showImage(this)'>
            </div>
            <div id="overlay" onclick="hideImage()">
              <img id="enlarged-image" src="" alt="Powiększony obrazek">
            </div>
            <p><strong>Data publikacji: </strong> <?= $row["data_publikacji"] ?> </p>

        <?php
          if ($currentUserId == $row["autor_id"]) {
            echo "<button class='edit-any'><a href='php/edit_post.php?id=" . $row["id"] . "'>Edytuj</a></button>";
            echo "<button class='edit-any' onclick='deletePost(" . $row["id"] . ")'>Usuń</button>";

            generateDeleteScript($row["id"]);
          }
          echo "</div>";
          echo "<div class='title-comment'><h3>Komentarze</h3></div>";

          $comments_sql = "SELECT komentarze.*, uzytkownicy.nickname FROM komentarze JOIN uzytkownicy ON komentarze.autor_id = uzytkownicy.user_id WHERE wpis_id = " . $row["id"] . " ORDER BY komentarze.data_publikacji DESC";
          $comments_result = mysqli_query($conn, $comments_sql);

          echo '<div class="comment-add comment-add-' . $row["id"] . ' hidden">';
          echo '<form method="POST" action="php/add_comment.php">';
          echo '<input type="hidden" name="wpis_id" value="' . $row["id"] . '">';
          echo '<textarea name="tresc" required placeholder="Napisz swoją opinie na temat tego postu!"></textarea>';
          echo '<br>';
          echo '<input type="submit" value="Dodaj komentarz">';
          echo '</form>';
          echo '</div>';

          if (mysqli_num_rows($comments_result) > 0) {
            while ($comment_row = mysqli_fetch_assoc($comments_result)) {
              echo "<div class='comment hidden' data-post-id='" . $row["id"] . "'>";
              echo "<p><strong>Autor:</strong> " . $comment_row["nickname"] . "</p>" . "<br>";
              echo "<p>" . $comment_row["tresc"] . "</p>" . "<br>";
              echo "<p><strong>Data publikacji:</strong> " . $comment_row["data_publikacji"] . "</p>";

              if ($currentUserId == $comment_row["autor_id"]) {
                echo "<button class='edit-any'><a href='php/edit_comment.php?id=" . $comment_row["id"] . "'>Edytuj</a></button>";
                echo "<button class='edit-any' onclick='deleteComment(" . $comment_row["id"] . ")'>Usuń</button>";
                generateDeleteScript($comment_row["id"]);
              }
              echo "</div>";
            }
          }
          echo '<button class="show-comments" data-post-id="' . $row["id"] . '">Pokaż komentarze</button>';
          echo "<hr>";
        }
      } else {
        echo "<div class='non-posts'>";
        echo "<span class='message-posts'>Nie ma żadnych wpisów :c</span>";
        echo "</div>";
      }
      mysqli_close($conn);
        ?>
    </section>
    <footer class="mt-3">
      <p>&copy; Copyright by <span><a href="https://github.com/itzL1m4k">Kamil Popiołek</a></span></p>
    </footer>
  </div>
  <div id="cookies">
    <p>Strona wykorzystuje pliki cookies. Klikając "<b>Akceptuję</b>", zgadzasz się na ich użycie.</p>
    <button id="accept" class="btn btn-primary"><b>Akceptuję</b></button>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/sweetalert2.all.min.js"></script>
  <script src="js/user_content_handler.js"></script>
  <script src="js/comment_display.js"></script>
  <script src="js/smooth_scroll.js"></script>
  <script src="js/cookies_handler.js"></script>
  <script src="js/post_handler.js"></script>
  <script src="js/image_display.js"></script>
  <script src="js/image_validation.js"></script>
</body>

</html>
