<?php
session_start();

// If user is already logged in, redirect to dashboard/home
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); // change to your dashboard page
    exit();
}

$success = "";
$username = $email = $password = $confirm_password = "";
$username_error = $email_error = $password_error = $confirm_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation
    if (empty($username)) {
        $username_error = "Username is required";
    }

    if (empty($email)) {
        $email_error = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Invalid email format";
    }

    if (empty($password)) {
        $password_error = "Password is required";
    } elseif (strlen($password) < 6) {
        $password_error = "Password must be at least 6 characters";
    }

    if ($password !== $confirm_password) {
        $confirm_error = "Passwords do not match";
    }

    // Only proceed if no errors
    if ($username_error == "" && $email_error == "" && $password_error == "" && $confirm_error == "") {
        $conn = mysqli_connect("localhost", "root", "", "rental_system");
        if (!$conn) {
            die("Database connection failed");
        }

        // Check if email already exists
        $email_check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($email_check) > 0) {
            $email_error = "Email already registered";
        } else {
            // Hash password before storing
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            if (mysqli_query($conn, $sql)) {
                $success = "Account created successfully! You can now login.";
                $username = $email = $password = $confirm_password = "";
            } else {
                $success = "Something went wrong!";
            }
        }

        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - Rental System</title>
    <link rel="stylesheet" href="sign_up _style.css">
</head>
<body>
<form method="POST" class="contact-card">
    <h2>📝 Sign Up</h2>

    <?php if ($success != "") { ?>
        <div style="color:green; margin-bottom:15px;">
            <?php echo $success; ?>
        </div>
    <?php } ?>

    <label>👤 Username</label>
    <input type="text" name="username" value="<?php echo $username; ?>">
    <small style="color:red;"><?php echo $username_error; ?></small>

    <label>📧 Email</label>
    <input type="email" name="email" value="<?php echo $email; ?>">
    <small style="color:red;"><?php echo $email_error; ?></small>

    <label>🔒 Password</label>
    <input type="password" name="password" value="<?php echo $password; ?>">
    <small style="color:red;"><?php echo $password_error; ?></small>

    <label>🔒 Confirm Password</label>
    <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
    <small style="color:red;"><?php echo $confirm_error; ?></small>

    <button class="btn-send">Sign Up</button>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</form>
</body>
</html>
