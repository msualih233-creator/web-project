<?php
session_start();

// If user already signed up/logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // change to your dashboard page
    exit();
}

// Database connection
$db_name = "rental_system"; // your database name
$conn = mysqli_connect("localhost", "root", "", $db_name);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Create 'users' table if it doesn't exist
$usersTable = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $usersTable);

// Variables
$success = "";
$username = $email = $password = $confirm_password = "";
$username_error = $email_error = $password_error = $confirm_error = "";

// Form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation
    if (empty($username)) $username_error = "Username is required";
    if (empty($email)) $email_error = "Email is required";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $email_error = "Invalid email format";
    if (empty($password)) $password_error = "Password is required";
    elseif (strlen($password) < 6) $password_error = "Password must be at least 6 characters";
    if ($password !== $confirm_password) $confirm_error = "Passwords do not match";

    // Insert if no errors
    if ($username_error == "" && $email_error == "" && $password_error == "" && $confirm_error == "") {
        // Check if email exists
        $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check_email) > 0) {
            $email_error = "Email already registered";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username','$email','$hashed_password')";
            if (mysqli_query($conn, $sql)) {
                $success = "Signup successful! You can now login.";
                $username = $email = $password = $confirm_password = "";

                // Optional: log in automatically
                $user_id = mysqli_insert_id($conn);
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
            } else {
                $success = "Error: " . mysqli_error($conn);
            }
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Rental System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="POST" class="contact-card">
    <h2>📝 Sign Up</h2>

    <?php if ($success != "") { ?>
        <div class="success-message"><?php echo $success; ?></div>
    <?php } ?>

    <label>👤 Username</label>
    <input type="text" name="username" value="<?php echo $username; ?>">
    <small class="error"><?php echo $username_error; ?></small>

    <label>📧 Email</label>
    <input type="email" name="email" value="<?php echo $email; ?>">
    <small class="error"><?php echo $email_error; ?></small>

    <label>🔒 Password</label>
    <input type="password" name="password" value="<?php echo $password; ?>">
    <small class="error"><?php echo $password_error; ?></small>

    <label>🔒 Confirm Password</label>
    <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
    <small class="error"><?php echo $confirm_error; ?></small>

    <button class="btn-send">Sign Up</button>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</form>
</body>
</html>
