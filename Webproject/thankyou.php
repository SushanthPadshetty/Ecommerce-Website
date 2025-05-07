<?php
session_start();
$pageTitle = "Thank You - ShopEasy";
include 'header.php';

// Clear the cart after checkout
unset($_SESSION['cart']);
?>

<div class="container" style="text-align: center; padding: 80px 20px;">
    <h1 style="font-size: 36px; color: #7f5af0; margin-bottom: 20px;">🎉 Thank You for Your Order!</h1>
    <p style="font-size: 18px; color: #333; margin-bottom: 40px;">
        Your order has been placed successfully. A confirmation email will be sent to you shortly.
    </p>
    <a href="index_1.php" class="btn" style="margin-right: 15px;">Return to Home</a>
    <a href="orders.php" class="btn btn-secondary">View Your Orders</a>
</div>

<?php include 'footer.php'; ?>
