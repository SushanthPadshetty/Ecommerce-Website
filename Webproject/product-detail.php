<?php
session_start();
$pageTitle = "Product Details - ShopEasy";
include 'header.php';
include 'db.php';

$product = null;
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM products WHERE id = $id");
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    }
}
?>

<div class="container">
    <?php if ($product): ?>
    <div class="product-detail-container">
        <div class="product-detail-image">
            <img src="assets/images/products/<?php echo ($product['image']); ?>" alt="<?php echo ($product['name']); ?>">
        </div>
        <div class="product-detail-info">
            <h2><?php echo($product['name']); ?></h2>
            <p class="price">₹<?php echo number_format($product['price'], 2); ?></p>
            <p class="desc"><?php echo($product['description']); ?></p>
            <a href="cart.php?id=<?php echo $product['id']; ?>&add=true" class="btn">Add to Cart</a>
        </div>
    </div>
    <?php else: ?>
    <p>Product not found.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
