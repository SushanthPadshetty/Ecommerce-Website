<?php
session_start();
$pageTitle = "Checkout - ShopEasy";
include 'header.php';
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$cart = $_SESSION['cart'] ?? [];

$total = 0; // Initialize total here

// Pre-calculate the total (for showing on page)
if (!empty($cart)) {
    $ids = implode(',', array_keys($cart));
    $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");

    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $qty = $cart[$id];
        $price = $row['price'];
        $total += $qty * $price;
    }
}

// After placing order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($cart)) {
    $products = [];
    $ids = implode(',', array_keys($cart));
    $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");

    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $qty = $cart[$id];
        $price = $row['price'];
        $products[] = ['id' => $id, 'qty' => $qty, 'price' => $price];
    }

    $conn->query("INSERT INTO orders (user_id, total) VALUES ($userId, $total)");
    $orderId = $conn->insert_id;

    foreach ($products as $prod) {
        $pid = $prod['id'];
        $qty = $prod['qty'];
        $price = $prod['price'];
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ($orderId, $pid, $qty, $price)");
    }

    unset($_SESSION['cart']);
    header("Location: thankyou.php");
    exit();
}
?>

<div class="container">
    <h2>Checkout</h2>

    <?php if (!empty($cart)): ?>
        <form method="post">
            <p><b>Total Amount:</b> ₹<?php echo number_format($total, 2); ?></p>
            <button type="submit" class="btn">Place Order</button>
        </form>
    <?php else: ?>
        <p>Your cart is empty. <a href="products.php">Go back to shop</a></p>
    <?php endif; ?>

</div>

<?php include 'footer.php'; ?>
