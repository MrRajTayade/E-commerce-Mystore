<?php
if (isset($_GET['delete_products'])) {
    $delete_id = $_GET['delete_products'];
    if (!empty($delete_id)) {
        $delete_product = "DELETE FROM `products` WHERE product_id=$delete_id";
        $result_product = mysqli_query($con, $delete_product);
        if ($result_product) {
            echo "<script>
                alert('Product deleted successfully');
                window.open('./index.php?view_products', '_self');
            </script>";
        } else {
            echo "<script>
                alert('Error deleting product');
                window.open('./index.php?view_products', '_self');
            </script>";
        }
    } else {
        echo "<script>
            alert('Error: delete_products ID is not set.');
            window.open('./index.php?view_products', '_self');
        </script>";
    }
}
?>