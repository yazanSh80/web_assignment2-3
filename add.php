<?php
require_once 'dbconfig.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pdo = db_connect();

    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $rating = $_POST['rating'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare("INSERT INTO Product (Name, Price, Category, Rating, Description, Quantity, productImage)
                           VALUES (:name, :price, :category, :rating, :description, :quantity, '')");

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':rating', $rating);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':quantity', $quantity);

    if ($stmt->execute()) {
        $productId = $pdo->lastInsertId();

        $imageExt = strtolower(pathinfo($_FILES['productImage']['name'], PATHINFO_EXTENSION));
        if ($imageExt === 'jpeg' || $imageExt === 'jpg') {
            $imageFileName = "{$productId}.jpeg";
            $imagePath = "images/$imageFileName";
            move_uploaded_file($_FILES['productImage']['tmp_name'], $imagePath);

            $updateStmt = $pdo->prepare("UPDATE Product SET productImage = :img WHERE productId = :id");
            $updateStmt->execute([':img' => $imageFileName, ':id' => $productId]);

            header("Location: products.php");
            exit;
        } else {
            echo "Only JPEG images are allowed.";
        }
    } else {
        echo "Error adding product.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>
<header>
    <h1>Al Sharif Store</h1>
    <figure>
        <img src="images/clothing-store-logo.jpg" alt="Store Image" width="150" height="150" class="logo">
    </figure>
    <nav>
        <ul>
            <li><a href="contactUsPage.html" class="link">Contact Us Page</a></li>
            <li><a href="add.php" class="link">Add Product</a></li>
        </ul>
    </nav>
</header>
<hr>

<h1>Product Record</h1>
<form method="POST" action="add.php" enctype="multipart/form-data">
<fieldset>
<legend>Product Record</legend>
    <label>Product Name: <input type="text" name="name" required></label><br><br>

    <label>Category:
        <select name="category" required>
            <option value="">Select Category</option>
            <option value="T-Shirts">T-Shirts</option>
            <option value="Shirts">Shirts</option>
            <option value="Jeans">Jeans</option>
            <option value="Pants">Pants</option>
            <option value="Shorts">Shorts</option>
            <option value="Jackets">Jackets</option>
            <option value="Dresses">Dresses</option>
            <option value="Shoes">Shoes</option>
            <option value="Accessories">Accessories</option>
        </select>
    </label><br><br>

    <label>Price: <input type="number" step="0.01" name="price" required></label><br><br>
    <label>Quantity: <input type="number" name="quantity" required></label><br><br>
    <label>Rating: <input type="number" step="0.1" name="rating" required></label><br><br>
    <label>Description: <textarea name="description" required></textarea></label><br><br>
    <label>Product Image: <input type="file" name="productImage" accept="image/jpeg" required></label><br><br>
    <button type="submit">INSERT</button>
</fieldset>
</form>

<footer>
    <p>&copy; 2025 My Clothing Store. All rights reserved.</p>
    <nav>
        <ul>
            <li><a href="contactUsPage.html" class="link_footer">Contact Us</a></li>
        </ul>
    </nav>
    <ul>
        <li><p>Last updated: <?php echo date("Y-m-d"); ?></p></li>
        <li><em>Email: alshareefy99@gmail.com</em></li>
        <li>Address: School Street, Kafr Aqab</li>
        <li>Phone: 0532304296</li>
    </ul>
</footer>
</body>
</html>
