<?php
include ('../include/connect.php');
session_start();

// Fetch order details if order_id is set
if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);

    // Prepare the SQL statement
    $stmt = $con->prepare("SELECT invoice_no, amount, totle_products FROM user_orders WHERE order_id = ?");

    // Check if prepare() failed
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }

    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->bind_result($invoice_no, $amount_view, $totle_product_view);
    $stmt->fetch();
    $stmt->close();
}

// Process payment confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm_payment'])) {
    $invoice_no = intval($_POST['invoice_no']);
    $amount = floatval($_POST['amount']);
    $totle_product_view = floatval($_POST['totle_products']);
    $payment_mode = $_POST['payment_mode'];

    // Insert into user_payment
    $stmt = $con->prepare("INSERT INTO user_payment (order_id, totle_products, invoice_no, amount, payment_mode) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }
    $stmt->bind_param("iiiss", $order_id, $totle_product_view, $invoice_no, $amount, $payment_mode);
    $stmt->execute();
    $stmt->close();

    // Insert into confirm_payment
    $stmt = $con->prepare("INSERT INTO confirm_payment (order_id, invoice_no, totle_products, amount, payment_mode, stetuse) VALUES (?, ?, ?, ?, ?, 'Paid')");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }
    $stmt->bind_param("iiiss", $order_id, $invoice_no, $totle_product_view, $amount, $payment_mode);
    $stmt->execute();
    $stmt->close();

    // Update user_orders
    $stmt = $con->prepare("UPDATE user_orders SET order_status='confirm', order_payment='Paid' WHERE order_id = ?");
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($con->error));
    }
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Successfully completed the payment'); window.open('profile.php?my_orders', '_self');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #6c757d;
            /* Set background color */
            min-height: 100vh;
            /* Ensure the body takes full height */
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1;
            /* Allow the container to take available space */
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center text-light mt-3">Confirm Payment</h1>
        <form action="" method="post">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="text" class="form-control w-50 m-auto" name="invoice_no"
                    value="<?php echo htmlspecialchars($invoice_no ?? ''); ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label class="text-light">Total Products</label>
                <input type="text" class="form-control w-50 m-auto" name="totle_products"
                    value="<?php echo htmlspecialchars($totle_product_view ?? ''); ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <label class="text-light">Amount</label>
                <input type="text" class="form-control w-50 m-auto" name="amount"
                    value="<?php echo htmlspecialchars($amount_view ?? ''); ?>" readonly>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <select name="payment_mode" class="form-select w-50 m-auto text-center" required>
                    <option value="" disabled selected>Select Payment Mode</option>
                    <option value="UPI">UPI</option>
                    <option value="Netbanking">Netbanking</option>
                    <option value="Paypal">Paypal</option>
                    <option value="Pay offline">Pay offline</option>
                </select>
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">
            </div>
        </form>
    </div>

    <!-- include footer -->
    <?php include ("../include/footer.php"); ?>

</body>

</html>