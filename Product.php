<?php
class Product {
    private $id, $name, $category, $description, $price, $rating, $quantity, $image;

    public function __construct($id, $name, $category, $description, $price, $rating, $quantity, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->description = $description;
        $this->price = $price;
        $this->rating = $rating;
        $this->quantity = $quantity;
        $this->image = $image;
    }

    public function displayInTable() {
        return "
        <tr>
            <td><img src='images/{$this->image}' alt='{$this->name}' width='50'></td>
            <td><a href='view.php?id={$this->id}'>{$this->id}</a></td>
            <td>{$this->name}</td>
            <td>{$this->category}</td>
            <td>{$this->price}</td>
            <td>{$this->quantity}</td>
            <td>
                <a href='edit.php?id={$this->id}'><img src='images/edit.png' alt='Edit' /></a>
                <a href='delete.php?id={$this->id}'><img src='images/delete.png' alt='Delete' /></a>
            </td>
        </tr>
        ";
    }

    public function displayProductPage() {
        return "
        <main>
            <img src='images/{$this->image}' alt='{$this->name}' width='200'><br><br>
            <h1>{$this->name} (ID: {$this->id})</h1>
            <ul>
                <li><strong>Price:</strong> {$this->price}</li>
                <li><strong>Category:</strong> {$this->category}</li>
                <li><strong>Rating:</strong> {$this->rating}</li>
                <li><strong>Quantity:</strong> {$this->quantity}</li>
            </ul>
            <h3>Description:</h3>
            <p>{$this->description}</p>
        </main>
        ";
    }
}
?>
