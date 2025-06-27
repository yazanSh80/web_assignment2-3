<?php
require_once 'dbconfig.inc.php';

$pdo = db_connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $rating = $_POST['rating'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare("UPDATE Product SET quantity = :quantity, price = :price, description = :description, rating = :rating WHERE productId = :id");
    $stmt->execute([
        ':quantity' => $quantity,
        ':price' => $price,
        ':description' => $description,
        ':rating' => $rating,
        ':id' => $id
    ]);

    // رفع صورة جديدة إذا تم توفيرها
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if ($imageExt === 'jpeg' || $imageExt === 'jpg') {
            $targetFile = "images/$id.jpeg";
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

            $stmt = $pdo->prepare("UPDATE Product SET productImage = :image WHERE productId = :id");
            $stmt->execute([':image' => "$id.jpeg", ':id' => $id]);
        } else {
            echo "Only JPEG files are allowed.";
        }
    }

    echo "Product updated successfully!";
} else if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM Product WHERE productId = :id");
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch();

    if ($product) {
        echo '
        <header>
            <h1>Al Sharif Store</h1>
            <figure>
                <img src="images/clothing-store-logo.jpg" alt="Store Image" width="150" height="150">
            </figure>
            <ul>
                <li><a href="contactUsPage.html" class="link">Contact Us Page</a></li>
                <li><a href="add.php" class="link">Add Product</a></li>
            </ul>
        </header>
        <br>
        <form method="POST" action="edit.php" enctype="multipart/form-data">
            <fieldset>
            <legend>Edit Product</legend>
                <label for="id">Product Id:</label>
                <input type="text" name="id" value="' . $id . '" readonly><br>

                <label for="name">Product Name:</label>
                <input type="text" id="name" name="name" value="' . $product['Name'] . '" readonly><br>

                <label for="category">Category:</label>
                <input type="text" id="category" name="category" value="' . $product['Category'] . '" readonly><br>

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="' . $product['Price'] . '"><br>

                <label for="quantity">Quantity:</label>
                <input type="text" id="quantity" name="quantity" value="' . $product['Quantity'] . '"><br>

                <label for="rating">Rating:</label>
                <input type="text" id="rating" name="rating" value="' . $product['Rating'] . '"><br>

                <label for="description">Description:</label>
                <input type="text" id="description" name="description" value="' . $product['Description'] . '"><br>

                <label for="image">Product Image:</label>
                <input type="file" id="image" name="image"><br>

                <input type="submit" value="Update Product">
            </fieldset>
        </form>
        <footer>
            <p>&copy; 2025 My Clothing Store. All rights reserved.</p>
            <ul>
                <li><p>Last updated: ' . date("Y-m-d") . '</p></li>
                <li><em>Email: alshareefy99@gmail.com</em></li>
                <li>Address: School Street, Kafr Aqab</li>
                <li>Phone: 0532304296</li>
            </ul>
        </footer>';
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid request.";
}
?>
