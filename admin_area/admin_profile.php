<?php



if (isset($_GET['admin_profile'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "Select * from `admin_table`where admin_name='$user_session_name' ";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $admin_id = $row_fetch['admin_id'];
    $admin_name = $row_fetch['admin_name'];
    $admin_email = $row_fetch['admin_email'];
    // $admin_pass = $row_fetch['admin_pass'];
    // $user_img = $row_fetch['user_img'];

}
if (isset($_POST['admin_upadate'])) {
    $update_id = $admin_id;
    //  $user_id = $_POST['user_id'];
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    //$admin_pass = $_POST['admin_pass'];
    // $hash_password = password_hash($admin_pass, PASSWORD_DEFAULT);


    // $user_no = $_POST['user_no'];

    $admin_img = $_FILES['admin_img']['name'];
    $admin_img_temp = $_FILES['admin_img']['tmp_name']; // Corrected from 'temp' to 'tmp_name'
    move_uploaded_file($admin_img_temp, "./admin_img/$admin_img");


    //update Query
    $upadte_data = "update `admin_table` set admin_name='$admin_name',admin_email='$admin_email',admin_img='$admin_img'  where admin_id= $update_id";
    $result_upadate_query = mysqli_query($con, $upadte_data);
    if ($result_upadate_query) {
        echo "<script>alert('Data updated successfully')</script>";
        echo "<script>window.open('logout.php','_self')</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit account</title>

    <style>
        .admin_edit_img {
            width: 100px;
            height: 100px;
            object-fit: contain;

        }
    </style>
</head>

<body>
    <h3 class="text-center text-success mt-3 mb-4">Edit Account</h3>
    <form id="deleteForm" action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" value="<?php echo $admin_name ?>" class="form-control w-50 m-auto" name="admin_name"
                required="required" placeholder="Enter your name">
        </div>
        <div class="form-outline mb-4">
            <input type="email" value="<?php echo $admin_email ?>" class="form-control w-50 m-auto" name="admin_email"
                required="required" placeholder="Enter your email id">
        </div>
        <div class="form-outline mb-4  d-flex  w-50 m-auto">
            <input type="file" class="form-control " name="admin_img" required="required">
            <img src="./admin_img/<?php echo $admin_img_fetch ?>" class="admin_edit_img" alt="note found">
        </div>
        <!-- <div class="form-outline mb-4 mt-3">
            <input type="password" value="" placeholder="Enter your password" class="form-control w-50 m-auto"
                name="user_password" required="required" autocomplete="off">
        </div> -->

        <div class="form-outline mb-5">
            <input type="submit" value="Update" class="bg-info py-2 px-3 border-0 mt-4 mx-3" name="admin_upadate">
            <button type="button" class=" mx-2  mt-5 m-10 py-2 px-3 text-danger border-0" data-toggle="modal"
                data-target="#confirmModal">Delete Account</button>
        </div>



    </form>
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Are you sure you want to delete your account?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    //session_start();  // Ensure session is started
    include ('../include/connect.php');  // Ensure connection to the database
    
    $username_session = $_SESSION['username'];

    if (isset($_POST['delete'])) {
        $delete_query = "DELETE FROM `admin_table` WHERE admin_name='$username_session'";
        $result = mysqli_query($con, $delete_query);
        if ($result) {
            session_destroy();
            echo "<script>alert('Account deleted successfully'); window.open('admin_login.php','_self');</script>";
        } else {
            echo "<script>alert('Error deleting account');</script>";
        }
    }

    if (isset($_POST['dont_delete'])) {
        echo "<script>window.open('profile.php','_self');</script>";
    }
    ?>

    <script>
        document.getElementById('confirmDelete').addEventListener('click', function () {
            // Set a hidden input to indicate deletion
            const form = document.getElementById('deleteForm');
            let deleteInput = document.createElement('input');
            deleteInput.type = 'hidden';
            deleteInput.name = 'delete';
            deleteInput.value = 'true';
            form.appendChild(deleteInput);
            form.submit();
        });
    </script>


</body>

</html>