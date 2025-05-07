<?php
session_start();
$pageTitle = "Your Cart - ShopEasy";
include 'header.php';
include 'db.php';

// Add to cart
if (isset($_GET['add']) && $_GET['add'] === "true" && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM products WHERE id = $id");
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }
}

// Remove from cart
if (isset($_GET['remove']) && isset($_GET['id'])) {
    unset($_SESSION['cart'][intval($_GET['id'])]);
}

// Fetch cart items
$cartItems = [];
$total = 0;

if (!empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $result = $conn->query("SELECT * FROM products WHERE id IN ($ids)");
    while ($row = $result->fetch_assoc()) {
        $row['quantity'] = $_SESSION['cart'][$row['id']];
        $row['total_price'] = $row['quantity'] * $row['price'];
        $total += $row['total_price'];
        $cartItems[] = $row;
    }
}
?>

<div class="container">
    <h1>Your Shopping Cart</h1>

    <?php if ($cartItems): ?> 
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price (₹)</th>
                    <th>Quantity</th>
                    <th>Total (₹)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?php echo($item['name']); ?></td>
                    <td>₹<?php echo number_format($item['price'], 2); ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>₹<?php echo number_format($item['total_price'], 2); ?></td>
                    <td><a href="cart.php?id=<?php echo $item['id']; ?>&remove=true" class="btn btn-secondary">Remove</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="cart-summary">
            <div class="summary-row total">
                <span>Grand Total:</span>
                <span>₹<?php echo number_format($total, 2); ?></span>
            </div>
            <div style="margin-top: 20px;">
                <a href="checkout.php" class="btn">Proceed to Checkout</a>
            </div>
        </div>

    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>

</div>

<?php include 'footer.php'; ?>
