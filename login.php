<?php
session_start();


if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php"); 
    exit();
}


$db_name = "rental_system"; ame
$conn = mysqli_connect("localhost", "root", "", $db_name);
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$email = $password = "";
$email_error = $password_error = $login_error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($email)) $email_error = "Email is required";
    if (empty($password)) $password_error = "Password is required";

    if ($email_error == "" && $password_error == "") {
        
        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])) {
            
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                
                if ($user['role'] == 'admin') {
                    header("Location: admin_dashboard.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit();
            } else {
                $login_error = "Incorrect password";
            }
        } else {
            $login_error = "Email not registered";
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Rental System</title>
    <link rel="stylesheet" href="sign_up_style.css">
</head>
<body>
<form method="POST" class="contact-card">
    <h2>🔑 Login</h2>

    <?php if ($login_error != "") { ?>
        <div class="error"><?php echo $login_error; ?></div>
    <?php } ?>

    <label>📧 Email</label>
    <input type="email" name="email" value="<?php echo $email; ?>">
    <small class="error"><?php echo $email_error; ?></small>

    <label>🔒 Password</label>
    <input type="password" name="password">
    <small class="error"><?php echo $password_error; ?></small>

    <button class="btn-send">Login</button>
    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
</form>
</body>
</html>
