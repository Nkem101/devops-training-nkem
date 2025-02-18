<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Blogging App</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-5">Login</h2>
    <form action="authenticate.php" method="POST">
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
         <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required>
         </div>
         <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>
