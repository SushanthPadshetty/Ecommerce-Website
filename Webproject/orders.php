<?php
session_start();
$pageTitle = "My Orders - ShopEasy";
include 'header.php';
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$orders = $conn->query("SELECT * FROM orders WHERE user_id = $userId ORDER BY created_at DESC");
?>

<div class="container">
    <h2>My Orders</h2>

    <?php if ($orders && $orders->num_rows > 0): ?>
        <?php while ($order = $orders->fetch_assoc()): ?>
            <?php $oid = $order['id']; ?>
            <div style="margin-bottom: 30px; padding: 20px; background: #fff; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <h3>Order #<?php echo $oid; ?> - ₹<?php echo number_format($order['total'], 2); ?></h3>
                <small>Placed on: <?php echo $order['created_at']; ?></small>

                <?php
                $items = $conn->query("SELECT p.name, oi.quantity, oi.price 
                                       FROM order_items oi 
                                       JOIN products p ON oi.product_id = p.id 
                                       WHERE oi.order_id = $oid");
                ?>
                <ul style="margin-top: 10px;">
                    <?php while ($item = $items->fetch_assoc()): ?>
                        <li>
                            <?php echo $item['quantity']; ?> × <?php echo ($item['name']); ?> 
                            - ₹<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>

</div>

<?php include 'footer.php'; ?>
