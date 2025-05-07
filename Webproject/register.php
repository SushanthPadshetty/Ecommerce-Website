<?php
session_start();
$pageTitle = "Register - ShopEasy";
include 'header.php';
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $pass);
    $stmt->execute();

    header("Location: login.php");
    exit();
}
?>

<div class="container">
    <h2>Register</h2>
    <form method="post" onsubmit="return validateForm()">
        <input type="text" id="name" name="name" placeholder="Full Name" required class="form-control"><br>
        <input type="email" id="email" name="email" placeholder="Email" required class="form-control"><br>
        <input type="password" id="password" name="password" placeholder="Password" required class="form-control"><br>
        <button type="submit" class="btn">Register</button>
    </form>
</div>

<script>
function validateForm() {
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;

    const nameRegex = /^[a-zA-Z]+(?: [a-zA-Z]+)+$/;
    if (!nameRegex.test(name)) {
        alert("Please enter your full name (at least first and last name).");
        return false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    if (password.length < 8) {
        alert("Password must be at least 8 characters long.");
        return false;
    }

    return true;
}
</script>

<?php include 'footer.php'; ?>
