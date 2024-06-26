

<?php
if (isset($_GET['delete_user'])) {
    $get_user_id = $_GET['delete_user'];
    if (!empty($get_user_id)) {
        $delete_user = "DELETE FROM `user_table` WHERE user_id=$get_user_id";
        $result = mysqli_query($con, $delete_user);
        if ($result) {
            echo "<script>
                alert('User deleted successfully');
                window.open('./index.php?user_list', '_self');
            </script>";
        } else {
            echo "<script>
                alert('Error deleting user');
                window.open('./index.php?user_list', '_self');
            </script>";
        }
    } else {
        echo "<script>
            alert('Error: User ID is not set.');
            window.open('./index.php?user_list', '_self');
        </script>";
    }
}
?>
