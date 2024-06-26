<?php
include ('../include/connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = intval($_POST['order_id']);

    // Delete order from the database
    $delete_order_query = "DELETE FROM `user_orders` WHERE order_id=$order_id";
    $result_delete = mysqli_query($con, $delete_order_query);

    if ($result_delete) {
        echo "<script>alert('Order deleted successfully'); window.location.href='profile.php?my_orders';</script>";
    } else {
        echo "<script>alert('Failed to delete the order'); window.location.href='profile.php?my_orders';</script>";
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href='profile.php?my_orders';</script>";
}
?>