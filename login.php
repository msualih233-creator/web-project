<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "rental_system");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = $_POST['role'] ?? "";

    if (empty($email) || empty($password) || empty($role)) {
        $error = "All fields are required";
    } else {

        $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            if (!password_verify($password, $user['password'])) {
                $error = "Incorrect password";
            } elseif ($role !== $user['role']) {
                $error = "Role not matched. You are not authorized as $role.";
            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin') {
                    header("Location: admin_dashboard.php");
                } else {
                    header("Location: dashboard.php");
                }
                exit();
            }
        } else {
            $error = "Account not found. Please register.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="POST" class="contact-card" id="loginForm">
    <h2>🔐 Login</h2>

    <?php if ($error != "") { ?>
        <div class="error"><?php echo $error; ?></div>
    <?php } ?>

    <label>📧 Email</label>
    <input type="email" name="email" required>

    <label>🔒 Password</label>
    <input type="password" name="password" required>

    <!-- Hidden role input -->
    <input type="hidden" name="role" id="roleInput">

    <button type="button" class="btn-send" onclick="showRoleChoice()">Login</button>

    <p>Don’t have an account? <a href="signup.php">Register</a></p>
</form>

<!-- ROLE POPUP -->
<div id="rolePopup" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">

    <div style="background:#fff; padding:30px; border-radius:10px; text-align:center; width:300px;">
        <h3>Login as</h3>
        <br>
        <button class="btn-send" onclick="selectRole('user')">User</button>
        <br><br>
        <button class="btn-send" onclick="selectRole('admin')">Admin</button>
    </div>
</div>

<script>
function showRoleChoice() {
    document.getElementById("rolePopup").style.display = "flex";
}

function selectRole(role) {
    document.getElementById("roleInput").value = role;
    document.getElementById("loginForm").submit();
}
</script>

</body>
</html>
