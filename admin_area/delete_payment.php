

<?php
if (isset($_GET['delete_payment'])) {
    $get_payment_id = $_GET['delete_payment'];
    if (!empty($get_payment_id)) {
        $delete_payment = "DELETE FROM `user_payment` WHERE payment_id=$get_payment_id";
        $result_payment = mysqli_query($con, $delete_payment);
        if ($result_payment) {
            echo "<script>
                alert('Payment deleted successfully');
                window.open('./index.php?all_payment', '_self');
            </script>";
        } else {
            echo "<script>
                alert('Error deleting payment');
                window.open('./index.php?all_payment', '_self');
            </script>";
        }
    } else {
        echo "<script>
            alert('Error: Payment ID is not set.');
            window.open('./index.php?all_payment', '_self');
        </script>";
    }
}
?>
