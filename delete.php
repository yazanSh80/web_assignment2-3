<?php
require_once 'dbconfig.inc.php';

$pdo = db_connect();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // استرجاع اسم الصورة من جدول Product
    $stmt = $pdo->prepare("SELECT productImage FROM Product WHERE productId = :id");
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch();

    if ($product) {
        $image = $product['productImage'];

        // حذف الصورة من مجلد images إذا كانت موجودة
        if (file_exists("images/$image")) {
            unlink("images/$image");
        }

        // حذف المنتج من جدول Product
        $stmt = $pdo->prepare("DELETE FROM Product WHERE productId = :id");
        $stmt->execute([':id' => $id]);

        echo "Product deleted successfully! <a href='products.php'>Back to Products</a>";
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid request.";
}
?>
