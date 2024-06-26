<?php
if (isset($_GET['delete_catagory'])) {
    $delete_catagory_id = $_GET['delete_catagory'];

    if (!empty($delete_catagory_id)) {
        $get_catagory = "SELECT * FROM `catagories` WHERE catagory_id=$delete_catagory_id";
        $catroy_result = mysqli_query($con, $get_catagory);

        if ($catroy_result && mysqli_num_rows($catroy_result) > 0) {
            $row = mysqli_fetch_assoc($catroy_result);

            if (!is_null($row)) {
                $delete_catagory = "DELETE FROM `catagories` WHERE catagory_id=$delete_catagory_id";
                $result_catagory = mysqli_query($con, $delete_catagory);

                if ($result_catagory) {
                    echo "<script>
                        alert('Category deleted successfully');
                        window.open('./index.php?view_catagories', '_self');
                    </script>";
                } else {
                    echo "<script>
                        alert('Error deleting category');
                        window.open('./index.php?view_catagories', '_self');
                    </script>";
                }
            } else {
                echo "<script>
                    alert('Error: Fetched row is null.');
                    window.open('./index.php?view_catagories', '_self');
                </script>";
            }
        } else {
            echo "<script>
                alert('Error: No category found with id $delete_catagory_id');
                window.open('./index.php?view_catagories', '_self');
            </script>";
        }
    } else {
        echo "<script>
            alert('Error: delete_catagory_id is not set.');
            window.open('./index.php?view_catagories', '_self');
        </script>";
    }
}
?>
