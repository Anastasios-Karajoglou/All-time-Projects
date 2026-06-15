<?php
session_start();
include('eshop_users.php'); // Include the users database configuration

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $users_db_conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user['id']; // Store the user ID in session
        header("Location: index.php");
        exit();
    } else {
        $error = "Λανθασμένος κωδικός ή όνομα χρήστη.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="styling.css">
</head>
<body>
  <div class="header">
    <h2>Login</h2>
  </div>
  <form method="post" action="login.php">
    <?php
      if (isset($error_message)) {
        echo '<div class="error">' . htmlspecialchars($error_message) . '</div>';
      }
    ?>
    <div class="input-group">
      <label>Username or Email</label>
      <input type="text" name="username" required>
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password" required>
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <p>
      Not yet a member? <a href="register.php">Sign up</a>
    </p>
  </form>
</body>
</html>
