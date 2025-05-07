<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle ?? 'ShopEasy'; ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<header style="background:#fff; padding:20px; border-bottom:1px solid #ccc;">
    <div class="container" style="display:flex; justify-content:space-between; align-items:center;">
        <h1><a href="index_1.php" style="color:#ff4d4d;">ShopEasy</a></h1>
        <nav>
            <a href="index_1.php">Home</a> |
            <a href="products.php">Products</a> |
            <a href="cart.php">Cart</a> |
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="orders.php">Orders</a> |
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a> |
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
