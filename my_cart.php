<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function calculateTotal() {
    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
    header('Location: my_cart.php');
    exit;
}

if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    if ($quantity <= 0) {
        unset($_SESSION['cart'][$product_id]);
    } else {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
    }
    header('Location: my_cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Cart</title>
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
    <section class="container">
        <aside class="search-container">

        </aside>
        <main class="cart-main">
            <h1>Your Shopping Cart</h1>

            <?php if (empty($_SESSION['cart'])): ?>
                <div class="empty-cart">
                    <p>Your cart is empty. <a href="products.php" class="link_header">Browse products</a></p>
                </div>
            <?php else: ?>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                            <tr>
                                <td><?php echo $item['name']; ?></td>
                                <td class="product-price">$<?php echo number_format($item['price'], 2); ?></td>
                                <td>
                                    <form action="my_cart.php" method="POST" class="product-actions">
                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" required>
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <button type="submit" name="update_quantity" class="add-cart-btn">Update</button>
                                    </form>
                                </td>
                                <td class="product-price">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                <td>
                                    <a href="my_cart.php?remove=<?php echo $product_id; ?>" class="delete" title="Remove Item">
    <img src="images/delete.png" alt="Remove" width="20" height="20">
</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="cart-summary">
                    <p>Total Price: <span class="product-price">$<?php echo number_format(calculateTotal(), 2); ?></span></p>
       
                </div>
            <?php endif; ?>
        </main>
    </section>
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
</body>
</html>