<?php
session_start();
require 'config.php'; // Περιλαμβάνει τη σύνδεση με τη βάση δεδομένων

// Έλεγχος αν ο χρήστης είναι συνδεδεμένος
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Ανάκτηση πληροφοριών χρήστη από τη βάση δεδομένων
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password_hash = !empty($password) ? password_hash($password, PASSWORD_BCRYPT) : null;

    // Ενημέρωση πληροφοριών χρήστη στη βάση δεδομένων
    if ($password_hash) {
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        $success = $stmt->execute([$username, $email, $password_hash, $user_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $success = $stmt->execute([$username, $email, $user_id]);
    }

    if ($success) {
        $_SESSION['username'] = $username;
        // Ανακατεύθυνση μετά την ενημέρωση
        header('Location: index.php');
        exit();
    } else {
        echo "Update failed.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Account</title>
    <link rel="stylesheet" type="text/css" href="styling.css">
    <style>
        .password-wrapper {
            display: flex;
            align-items: center;
        }
        .password-wrapper input[type="password"] {
            flex: 1;
        }
        .password-wrapper .toggle-password {
            cursor: pointer;
            padding: 0 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Edit Account</h2>
    </div>
    <form method="post" action="edit-account.php">
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div class="input-group">
            <label>New Password (leave blank to keep current password)</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password">
                <span class="toggle-password" onclick="togglePasswordVisibility()">Show</span>
            </div>
        </div>
        <div class="input-group">
            <button type="submit" class="btn">Update</button>
        </div>
    </form>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var toggleButton = document.querySelector(".toggle-password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.textContent = "Hide";
            } else {
                passwordField.type = "password";
                toggleButton.textContent = "Show";
            }
        }
    </script>
</body>
</html>
