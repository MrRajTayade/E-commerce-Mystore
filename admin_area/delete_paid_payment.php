<?php
if (isset($_GET['delete_paid_payment'])) {
    $order_id = $_GET['delete_paid_payment'];
    if (!empty($order_id)) {
        $delete_payment = "DELETE FROM `confirm_payment` WHERE order_id=$order_id";
        $result_payment = mysqli_query($con, $delete_payment);
        if ($result_payment) {
            echo "<script>
                alert('Payment deleted successfully');
                window.open('./index.php?paid_payment', '_self');
            </script>";
        } else {
            echo "<script>
                alert('Error deleting payment');
                window.open('./index.php?paid_payment', '_self');
            </script>";
        }
    } else {
        echo "<script>
            alert('Error: Payment ID is not set.');
            window.open('./index.php?paid_payment', '_self');
        </script>";
    }
}
?>