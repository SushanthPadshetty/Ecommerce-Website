<?php
session_start();
$pageTitle = "Home - ShopEasy";
include 'header.php';
include 'db.php';

$featuredProducts = [];
$result = $conn->query("SELECT * FROM products LIMIT 8");
if ($result) {
    $featuredProducts = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<section class="hero">
    <div class="hero-content">
        <h1>Welcome to <span style="color:#ff4d4d;">ShopEasy</span></h1>
        <p>Discover amazing products at unbeatable prices</p>
        <a href="products.php" class="btn btn-secondary">Shop Now</a>
    </div>
</section>

<section class="featured-products">
    <div class="container">
        <div class="section-title">
            <h2>Featured Products</h2>
        </div>
        <div class="product-grid">
            <?php foreach($featuredProducts as $product): ?>
            <div class="product-card animate">
                <div class="product-image">
                    <img src="assets/images/products/<?php echo($product['image']); ?>" alt="<?php echo($product['name']); ?>">
                </div>
                <div class="product-info">
                    <h3><?php echo($product['name']); ?></h3>
                    <div class="product-price">₹<?php echo number_format($product['price'], 2); ?></div>
                    <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn btn-secondary">View Details</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
