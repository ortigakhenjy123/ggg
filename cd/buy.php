<!DOCTYPE html>
<html>
<head>
<style>
    /* Simple CSS for Beginners */
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0; /* Light grey background */
        text-align: center;
        padding-top: 50px;
    }

    .message-card {
        background: white;
        width: 350px;
        margin: 0 auto;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 5px 15px rgba(0,0,0,0.1);
    }

    .success {
        color: #28a745; /* Green */
        font-size: 24px;
        margin-bottom: 10px;
    }

    .error {
        color: #dc3545; /* Red */
        font-size: 24px;
    }

    .btn {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #333; /* Dark button */
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .btn:hover {
        background-color: #000;
    }
</style>
</head>
<body>

<div class="message-card">
<?php
$conn = new mysqli("localhost", "root", "", "jdvpdbb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['place_order'])) {
    $product_id = $_POST['product_id'];
    $quantity_ordered = $_POST['quantity'];
    $user_name = $_POST['user_name'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile_number'];
    $payment_method = $_POST['payment_method'];

    // 1. Check current stock first to prevent "overselling"
    $check_stock = $conn->query("SELECT quantity FROM products WHERE id = $product_id");
    $product = $check_stock->fetch_assoc();

    if ($product['quantity'] >= $quantity_ordered) {
        // 2. DECREASE THE STOCK
        $update_sql = "UPDATE products SET quantity = quantity - $quantity_ordered WHERE id = $product_id";
        
        if ($conn->query($update_sql) === TRUE) {
            // 3. (Optional) Save the order to an orders table
            // $conn->query("INSERT INTO orders (product_id, customer_name, qty) VALUES ('$product_id', '$user_name', '$quantity_ordered')");

            echo "<script>
                    alert('Order Placed Successfully!');
                    window.location.href='son.php'; 
                  </script>";
        } else {
            echo "Error updating stock: " . $conn->error;
        }
    } 
}
?>
</div>

</body>
</html>