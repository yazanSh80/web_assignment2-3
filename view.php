<?php 
require_once 'dbconfig.inc.php';
require_once 'Product.php';

$pdo = db_connect();

if (!isset($_GET['id'])) {
    echo "<h1>Invalid Product ID</h1>";
    exit;
}

$productId = $_GET['id'];
$sql = "SELECT * FROM Product WHERE productId = :productId";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "<h1>Product not found</h1>";
    exit;
}

$prod = new Product(
    $product['productId'],
    $product['Name'],
    $product['Category'],
    $product['Description'],
    $product['Price'],
    $product['Rating'],
    $product['Quantity'],
    $product['productImage']
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($product['Name']) ?> - Al Sharif Store</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<header class="main-header">
    <img src="images/al sharif.png" alt="Logo" class="logo">

    <a href="products.php" class="nav-link">Home</a>
    <h1 class="system-title">Al Sharif store</h1>
    <a href="my_cart.php" class="nav-link">Cart</a>
        <a href="contactUsPage.html" class="nav-link">Contact us</a>
</header>
<body>


<hr>

<main class="product-details">
    <img src="images/<?= htmlspecialchars($product['productImage']) ?>" alt="<?= htmlspecialchars($product['Name']) ?>">
    
    <div class="product-info">
        <h2><?= htmlspecialchars($product['Name']) ?></h2>
        
        <div class="category-badge"><?= htmlspecialchars($product['Category']) ?></div>
        
        <p class="description"><?= htmlspecialchars($product['Description']) ?></p>
        
        <div class="price">$<?= number_format($product['Price'], 2) ?></div>
        
 
        <div class="<?= $product['Quantity'] <= 5 ? 'low-quantity' : 'quantity' ?>">
            Quantity: <?= $product['Quantity'] ?>
        </div>
        
        <form method="POST" action="add_to_cart.php">
            <input type="hidden" name="productId" value="<?= $product['productId'] ?>">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</main>

<footer>
    <section>
        <img src="images/al sharif.png" alt="Logo" class="footer-logo">
    </section>
    <section class="footer-text">
        <p>&copy; 2025 Al Sharif Flat Rent. All rights reserved.</p>
        <address>
            <p><em>Email:</em> alshareefy99@gmail.com</p>
            <p><em>Address:</em> School Street, Kafr Aqab</p>
            <p><em>Phone:</em> 0532304296</p>
        </address>
    </section>
</footer>
</footer>

</body>
</html>