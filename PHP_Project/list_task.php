<?php
include 'olddbconfig.php';
global $conn;

$query = "SELECT * FROM tasks WHERE status='pending'";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<div class='history-item'>
            <span>{$row['task_name']}</span><br/>
            <span>{$row['task_description']}</span><br/>
            <span>Task ID: {$row['id']}</span>
            
            <div class='task-actions'>
                <a href='operationData.php?edit={$row['id']}'>Edit</a> |
                <a href='operationData.php?complete={$row['id']}'>Complete</a> |
                <a href='operationData.php?delete={$row['id']}'>Delete</a>
            </div>
          </div>";
    
    echo "<section class='product-detail'>
        <div class='product-image'>
            <img src='Assets/product1.jpg' alt='Product Image'>
        </div>
        <div class='product-info'>
            <h2>Product Name 1</h2>
            <p>$100.00</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. This product is crafted with the highest quality materials.</p>
            <button class='add-to-cart'>Add to Cart</button>
        </div>
    </section>";
}
?>
