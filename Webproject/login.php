<?php
session_start();
$pageTitle = "Login - ShopEasy";
include 'header.php';
include 'db.php';

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($pass === $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: index_1.php");
            exit();
        } else {
            $message = "Invalid credentials.";
        }
    } else {
        $message = "User not found.";
    }
}
?>

<div class="container">
    <h2>Login</h2>
    <?php if ($message): ?><p style="color:red;"><?php echo $message; ?></p><?php endif; ?>
    <form method="post">
        <input type="email" name="email" placeholder="Email" required class="form-control"><br>
        <input type="password" name="password" placeholder="Password" required class="form-control"><br>
        <button type="submit" class="btn">Login</button>
    </form>
</div>

<?php include 'footer.php'; ?>
