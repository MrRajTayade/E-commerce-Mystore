<?php
if (isset($_GET['delete_order'])) {
    $order_id = $_GET['delete_order'];
    if (!empty($order_id)) {
        $delete_order = "DELETE FROM `user_orders` WHERE order_id=$order_id";
        $order_result = mysqli_query($con, $delete_order);
        if ($order_result) {
            echo "<script>
                alert('Order deleted successfully');
                window.open('./index.php?list_orders', '_self');
            </script>";
        } else {
            echo "<script>
                alert('Error deleting order');
                window.open('./index.php?list_orders', '_self');
            </script>";
        }
    } else {
        echo "<script>
            alert('Error: order ID is not set.');
            window.open('./index.php?list_orders', '_self');
        </script>";
    }
}
?>