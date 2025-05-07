<?php
session_start();
$pageTitle = "All Products - ShopEasy";
include 'header.php';
include 'db.php';

$allProducts = [];
$result = $conn->query("SELECT * FROM products");
if ($result) {
    $allProducts = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<section class="all-products">
    <div class="container">
        <h1 class="section-title">Browse All Products</h1>

        <?php if (count($allProducts) > 0): ?>
        <div class="product-grid">
            <?php foreach($allProducts as $product): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="assets/images/products/<?php echo ($product['image']); ?>" alt="<?php echo ($product['name']); ?>">
                </div>
                <div class="product-info">
                    <h3><?php echo($product['name']); ?></h3>
                    <p class="product-price">₹<?php echo number_format($product['price'], 2); ?></p>
                    <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn btn-secondary">View Details</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <p class="no-products">No products found.</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
