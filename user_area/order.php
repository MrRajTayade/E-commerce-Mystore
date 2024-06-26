<?php
include ('../include/connect.php');

function getIPAddress()
{
    // Check if the IP is from the shared internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    // Check if the IP is from a proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    // Get the remote IP address
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    echo "<script>alert('User ID not provided');</script>";
    exit();
}

// Get the IP address
$get_ip_add = getIPAddress();
$totle_price = 0;

// Select items from cart
$select_card_query = "SELECT * FROM `card_details` WHERE ip_address='$get_ip_add'";
$result_card_price = mysqli_query($con, $select_card_query);
$count_product = mysqli_num_rows($result_card_price);

// Check if the cart is empty
if ($count_product == 0) {
    echo "<script>alert('Cart is empty');</script>";
    echo "<script>window.open('../index.php', '_self');</script>";
    exit();
}

$invoice_no = mt_rand();
$stetuse = 'pending';

// Calculate total price
while ($row_price = mysqli_fetch_array($result_card_price)) {
    $product_id = $row_price['product_id'];
    $select_product_query = "SELECT * FROM `products` WHERE product_id=$product_id";
    $run_price_query = mysqli_query($con, $select_product_query);
    while ($row_product_price = mysqli_fetch_array($run_price_query)) {
        $pruduct_price = $row_product_price['product_price'];
        $totle_price += $pruduct_price;
    }
}

// Get quantity from cart
$get_card = "SELECT * FROM `card_details` WHERE ip_address='$get_ip_add'";
$run_query_card = mysqli_query($con, $get_card);

$subtotle = 0;
while ($get_item_quentity = mysqli_fetch_array($run_query_card)) {
    $quantity = $get_item_quentity['quantity'];
    if ($quantity == 0) {
        $quantity = 1;
    }
    $subtotle += $totle_price * $quantity;
}

// Insert into user orders
$insert_order = "INSERT INTO `user_orders` (user_id, amount, invoice_no, totle_products, order_date, order_status) VALUES ($user_id, $subtotle, $invoice_no, $count_product, NOW(), '$stetuse')";
$result = mysqli_query($con, $insert_order);
if ($result) {
    echo "<script>alert('Order submitted successfully');</script>";
    echo "<script>window.open('profile.php', '_self');</script>";
} else {
    echo "<script>alert('Error submitting order');</script>";
    exit();
}

// Insert into pending orders
$run_query_card = mysqli_query($con, $get_card); // Re-run query to reset pointer
while ($get_item_quentity = mysqli_fetch_array($run_query_card)) {
    $product_id = $get_item_quentity['product_id'];
    $quantity = $get_item_quentity['quantity'];
    if ($quantity == 0) {
        $quantity = 1;
    }
    $insert_order_pending = "INSERT INTO `order_pending` (user_id, invoice_no, product_id, quantity, order_status) VALUES ($user_id, $invoice_no, $product_id, $quantity, '$stetuse')";
    $result_pending_orders = mysqli_query($con, $insert_order_pending);
}

// Delete items from cart
$emty_card = "DELETE FROM `card_details` WHERE ip_address='$get_ip_add'";
$result_delete = mysqli_query($con, $emty_card);

?>