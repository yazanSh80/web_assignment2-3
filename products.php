<?php 
require_once 'dbconfig.inc.php';
require_once 'Product.php';

$pdo = db_connect();
$searchQuery = "";
$searchField = "Name"; 
$searchCategory = "";
$products = [];
$initialProducts = [];

try {
    $sql = "SELECT * FROM Product";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $initialProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchQuery = $_POST['search'] ?? '';
    $searchField = $_POST['field'] ?? 'Name';
    $searchCategory = $_POST['categories'] ?? '';

    $sql = "SELECT * FROM Product WHERE 1=1";

    if ($searchQuery !== "") {
        if ($searchField === "Price") {
            $sql .= " AND Price <= :searchQuery";
        } else {
            $sql .= " AND $searchField LIKE :searchQuery";
        }
    }

    if ($searchCategory !== "") {
        $sql .= " AND Category = :searchCategory";
    }

    $stmt = $pdo->prepare($sql);

    if ($searchQuery !== "") {
        if ($searchField === "Price") {
            $stmt->bindValue(':searchQuery', $searchQuery, PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':searchQuery', "%$searchQuery%", PDO::PARAM_STR);
        }
    }

    if ($searchCategory !== "") {
        $stmt->bindValue(':searchCategory', $searchCategory, PDO::PARAM_STR);
    }

    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($products)) {
        echo "<p>No items found matching your search criteria. Showing all products.</p>";
        $products = $initialProducts;
    }
} else {
    $products = $initialProducts;
}

function renderProductsTable($products) {
    $output = "<table border='1'>";
    $output .= "<tr>
        <th>Product Image</th>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Actions</th>
    </tr>";
    foreach ($products as $product) {
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
        $output .= $prod->displayInTable();
    }
    $output .= "</table>";
    return $output;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>E-Clothing Store</title>
</head>
<body>
<header>
    <h1>Al Sharif Store</h1>
    <figure>
        <img src="images/clothing-store-logo.jpg" alt="Store Image" width="150" height="150">
    </figure>
    <ul>
        <li><a href="contactUsPage.html">Contact Us Page</a></li>
        <li><a href="add.php">Add Product</a></li>
    </ul>
</header>
<hr>

<section>
    <form method="POST" action="products.php">
        <fieldset>
            <legend>Advanced Product Search</legend>
            <label><input type="radio" name="field" value="Name" checked> Name</label>
            <input type="text" name="search" placeholder="Search products">
  
            <label><input type="radio" name="field" value="Price" checked> price</label>
            <input type="text" name="search" placeholder="Search products">

            <label><input type="radio" name="field" value="Category"> Category</label>
            <select id="categories" name="categories">
                <option value="">-- Select Category --</option>
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
            <button type="submit">Filter</button>
        </fieldset>
    </form>
</section>

<section>
    <h2>Product Table Result</h2>
    <?php echo renderProductsTable($products); ?>
</section>

<footer>
    <p>&copy; 2025 My Clothing Store. All rights reserved.</p>
    <nav>
        <ul>
            <li><a href="contactUsPage.html">Contact Us</a></li>
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
