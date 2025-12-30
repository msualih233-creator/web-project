<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<h1>Welcome Admin <?php echo $_SESSION['username']; ?></h1>
