<?php
session_start();

//if (isset($_SESSION['user_id'])) {
 //   header("Location: dashboard.php");
  //  exit();


$conn = mysqli_connect("localhost", "root", "", "rental_system");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$usersTable = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $usersTable);

$username = $email = $success = "";
$username_error = $email_error = $password_error = $confirm_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($username)) $username_error = "Username is required";
    if (empty($email)) $email_error = "Email is required";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $email_error = "Invalid email format";
    if (empty($password)) $password_error = "Password is required";
    elseif (strlen($password) < 6) $password_error = "Password must be at least 6 characters";
    if ($password !== $confirm_password) $confirm_error = "Passwords do not match";

    if ($username_error == "" && $email_error == "" && $password_error == "" && $confirm_error == "") {

        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>
                alert('Account already exists. Please login.');
                window.location.href = 'login.php';
            </script>";
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if (mysqli_query($conn, $sql)) {
            $success = "✅ Registration successful! You can register another account below.";
            $username = $email = $password = $confirm_password = "";
        } else {
            $email_error = "Something went wrong. Try again.";
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="POST" class="contact-card">
    <h2>📝 Sign Up</h2>

    <?php if ($success != "") { ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php } ?>

    <label>👤 Username</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
    <small class="error"><?php echo $username_error; ?></small>

    <label>📧 Email</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
    <small class="error"><?php echo $email_error; ?></small>

    <label>🔒 Password</label>
    <input type="password" name="password">
    <small class="error"><?php echo $password_error; ?></small>

    <label>🔒 Confirm Password</label>
    <input type="password" name="confirm_password">
    <small class="error"><?php echo $confirm_error; ?></small>

    <button class="btn-send">Sign Up</button>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</form>

</body>
</html>
