<?php 
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
}

include("db_conn.php");
require_once("admin/data/Post.php");

$posts = getAll($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home - My Blog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <style>
    .post-card {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 20px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
    }
    .post-card img {
      max-width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 6px;
    }
  </style>
</head>
<body>

<?php include("inc/NavBar.php"); ?>

<div class="container mt-5">
  <h2 class="mb-4 text-center">📰 Latest Blog Posts</h2>
  <div class="row">
    <?php if ($posts && is_array($posts)): ?>
      <?php foreach($posts as $post): ?>
        <div class="col-md-4">
          <div class="post-card">
            <img src="upload/blog/<?= htmlspecialchars($post['cover_url'] ?? 'default.jpg') ?>" 
            alt="<?= htmlspecialchars($post['post_title'] ?? 'Image') ?>">
            <h5 class="mt-3"><?= htmlspecialchars($post['post_title'] ?? 'No Title') ?></h5>
            <p>
              <?= isset($post['post_text']) 
                   ? htmlspecialchars(substr(strip_tags($post['post_text']), 0, 100)) . '...' 
                   : 'No content available.'; ?>
            </p>

            <?php if ($logged): ?>
              <a href="single_post.php?id=<?= $post['post_id'] ?>" class="btn btn-sm btn-outline-primary">Read More</a>
            <?php else: ?>
              <a href="signup.php" class="btn btn-sm btn-outline-warning">Login to Read</a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-center">No blog posts available.</p>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
