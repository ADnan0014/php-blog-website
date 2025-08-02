<?php
session_start();

// ✅ Check if user is logged in
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
} else {
    // ✅ Redirect if not logged in
    header("Location: signup.php");
    exit;
}

include("db_conn.php");
require_once("admin/data/Post.php");

// ✅ Validate post_id
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid Post ID";
    exit;
}

$post_id = $_GET['id'];
$post = getById($conn, $post_id);

if (!$post) {
    echo "Post not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($post['post_title']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include("inc/NavBar.php"); ?>

<div class="container mt-5">
  <h2><?= htmlspecialchars($post['post_title']) ?></h2>
  <img src="upload/blog/<?= htmlspecialchars($post['cover_url']) ?>" class="img-fluid my-3" alt="Blog Cover">

  <div>
    <?= $post['post_text'] ?>
  </div>

  <a href="index.php" class="btn btn-secondary mt-4">⬅ Back to Home</a>
</div>


</body>
</html>
