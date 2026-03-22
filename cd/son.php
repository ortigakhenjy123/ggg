<?php
$conn = new mysqli("localhost", "root", "", "jdvpdbb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palengke Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            padding-top: 0;
            font-family: 'Inter', sans-serif;
        }

        .navbar {
            background: #212529 !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Product Cards */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 180px;
            object-fit: contain;
            padding: 20px;
        }

        /* Modal Customization */
        .modal-content {
            border-radius: 25px;
            border: none;
        }

        .modal-header {
            background: #212529;
            color: white;
            border-radius: 25px 25px 0 0;
        }

        .total-box {
            background: #e9ecef;
            padding: 15px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .total-price {
            color: #198754;
            font-weight: 800;
            font-size: 1.5rem;
        }

        .qty-input {
            width: 70px;
            text-align: center;
            border: none;
            font-weight: bold;
            background: transparent;
            font-size: 1.4rem;
        }

        .qty-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #212529;
            background: white;
            font-weight: bold;
            transition: 0.2s;
        }

        .qty-btn:hover {
            background: #212529;
            color: white;
        }

        .btn-black {
            background: #212529;
            color: white;
            border-radius: 30px;
            width: 100%;
            padding: 12px;
            font-weight: bold;
            border: none;
        }

        .btn-black:hover {
            background: #000;
            color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="home.html">PALENGKE</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.html">Back to Home</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <?php
            $result = mysqli_query($conn, "SELECT * FROM products WHERE quantity > 0");
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $price = $row['price'];
                $stock = $row['quantity'];
                $img = $row['img'];
                $name = $row['name'];
            ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100 text-center">
                        <img src="img/<?php echo $img; ?>" class="card-img-top" alt="<?php echo $name; ?>">
                        <div class="card-body">
                            <p class="fw-bold mb-1"><?php echo $name; ?></p>
                            <p class="text-muted small">Stock: <?php echo $stock; ?></p>
                            <h5 class="fw-bold mb-3">$<?php echo number_format($price, 2); ?></h5>
                            <button class="btn btn-black" data-bs-toggle="modal" data-bs-target="#buyModal<?php echo $id; ?>">Buy Now</button>
                        </div>
                    </div>

                    <div class="modal fade" id="buyModal<?php echo $id; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Order</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="buy.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                        
                                        <div class="text-center">
                                            <img src="img/<?php echo $img; ?>" style="height: 120px; object-fit: contain;" class="mb-3">
                                            <h4 class="fw-bold"><?php echo $name; ?></h4>
                                            <p class="text-muted small">Stock: <?php echo $stock; ?></p>
                                        </div>

                                        <div class="total-box text-center">
                                            <span class="text-muted small fw-bold">TOTAL AMOUNT:</span>
                                            <span class="fw-bold mb-3">$<span id="total<?php echo $id; ?>"><?php echo number_format($price, 2); ?></span></span>
                                        </div>

                                        <div class="d-flex justify-content-center align-items-center my-4">
                                            <button type="button" class="qty-btn" onclick="updateQty(<?php echo $id; ?>, -1, <?php echo $price; ?>, <?php echo $stock; ?>)">−</button>
                                            <input type="number" name="quantity" id="qty<?php echo $id; ?>" value="1" readonly class="qty-input">
                                            <button type="button" class="qty-btn" onclick="updateQty(<?php echo $id; ?>, 1, <?php echo $price; ?>, <?php echo $stock; ?>)">+</button>
                                        </div>

                                        

                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Name:</label>
                                            <input type="text" name="user_name" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Address:</label>
                                            <input type="text" name="address" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Mobile Number:</label>
                                            <input type="number" name="mobile_number" class="form-control" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Payment Method:</label>
                                            <select name="payment_method" class="form-select" onchange="togglePaymentFields(this, <?php echo $id; ?>)" required>
                                                <option value="COD">Cash on Delivery (COD)</option>
                                                <option value="GCash">GCash Payment</option>
                                                <option value="Bank Transfer">Bank Transfer</option>
                                            </select>
                                        </div>

                                        <div id="gcash_field<?php echo $id; ?>" class="mb-3" style="display: none;">
                                            <label class="form-label small fw-bold">GCash Registered Number:</label>
                                            <input type="number" name="gcash_num" class="form-control">
                                        </div>

                                        <div id="bank_field<?php echo $id; ?>" class="mb-3" style="display: none;">
                                            <label class="form-label small fw-bold">Bank Account Number:</label>
                                            <input type="number" name="bank_code" class="form-control">
                                        </div>

                                        <button type="submit" name="place_order" class="btn btn-black mt-3">Place Order</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <script>
        // Function to update Quantity and Total Price
        function updateQty(id, delta, price, maxStock) {
            const qtyInput = document.getElementById('qty' + id);
            const totalDisplay = document.getElementById('total' + id);
            
            let currentQty = parseInt(qtyInput.value);
            let newQty = currentQty + delta;

            // Validation: Cannot go below 1, Cannot exceed stock
            if (newQty < 1) return;
            if (newQty > maxStock) {
                alert("Sorry, only " + maxStock + " units left in stock.");
                return;
            }

            // Update Input
            qtyInput.value = newQty;

            // Update Total Price Display
            let newTotal = newQty * price;
            totalDisplay.innerText = newTotal.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        // Function to show/hide payment details based on selection
        function togglePaymentFields(selectElement, id) {
            const gcash = document.getElementById('gcash_field' + id);
            const bank = document.getElementById('bank_field' + id);
            const val = selectElement.value;

            gcash.style.display = (val === 'GCash') ? 'block' : 'none';
            bank.style.display = (val === 'Bank Transfer') ? 'block' : 'none';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>