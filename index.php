<?php
session_start();
require_once 'config.php';

$sql = "SELECT posts.*, users.username FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">My Blog</h1>
    <?php if(isset($_SESSION['user_id'])): ?>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! 
           <a href="post.php" class="btn btn-primary">New Post</a> 
           <a href="logout.php" class="btn btn-secondary">Logout</a>
        </p>
    <?php else: ?>
        <p><a href="login.php" class="btn btn-primary">Login</a></p>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="blog-post">
                <div class="blog-title"><?php echo htmlspecialchars($row['title']); ?></div>
                <div class="blog-meta">Posted by <?php echo htmlspecialchars($row['username']); ?> on <?php echo date("F j, Y, g:i a", strtotime($row['created_at'])); ?></div>
                <div class="blog-description"><?php echo nl2br(htmlspecialchars($row['description'])); ?></div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No blog posts yet.</p>
    <?php endif; ?>
</div>
</body>
</html>
<?php $conn->close(); ?>
