
<?php
if (isset($_GET['delete_brand'])) {
    $delete_brand_id = $_GET['delete_brand'];
    if (!empty($delete_brand_id)) {
        $delete_brand = "DELETE FROM `brands` WHERE brand_id=$delete_brand_id";
        $result_brand = mysqli_query($con, $delete_brand);
        if ($result_brand) {
            echo "<script>
                alert('Brand deleted successfully');
                window.open('./index.php?view_brands', '_self');
            </script>";
        } else {
            echo "<script>
                alert('Error deleting brand');
                window.open('./index.php?view_brands', '_self');
            </script>";
        }
    } else {
        echo "<script>
            alert('Error: delete_brand ID is not set.');
            window.open('./index.php?view_brands', '_self');
        </script>";
    }
}
?>
