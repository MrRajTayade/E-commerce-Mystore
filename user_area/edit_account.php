<?php



if (isset($_GET['Edit_account'])) {
    $user_session_name = $_SESSION['username'];
    $select_query = "Select * from `user_table`where user_name='$user_session_name' ";
    $result_query = mysqli_query($con, $select_query);
    $row_fetch = mysqli_fetch_assoc($result_query);
    $user_id = $row_fetch['user_id'];
    $user_name = $row_fetch['user_name'];
    $user_email = $row_fetch['user_email'];
    $user_pass = $row_fetch['user_pass'];
    // $user_img = $row_fetch['user_img'];
    $user_address = $row_fetch['user_address'];
    $user_no = $row_fetch['user_no'];
}
if (isset($_POST['user_upadate'])) {
    $update_id = $user_id;
    //  $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    // $user_no = $_POST['user_no'];

    $user_img = $_FILES['user_img']['name'];
    $user_img_temp = $_FILES['user_img']['tmp_name']; // Corrected from 'temp' to 'tmp_name'
    move_uploaded_file($user_img_temp, "./user_img/$user_img");


    //update Query
    $upadte_data = "update `user_table` set user_name='$user_name',user_email='$user_email',user_img='$user_img',user_address='$user_address',user_no='$user_no' where user_id= $update_id";
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
        .user_edit_img {
            width: 100px;
            height: 100px;
            object-fit: contain;

        }
    </style>
</head>

<body>
    <h3 class="text-center text-success mt-3 mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multipart/form-data" class="text-center">
        <div class="form-outline mb-4">
            <input type="text" value="<?php echo $user_name ?>" class="form-control w-50 m-auto" name="user_name"
                required="required">
        </div>
        <div class="form-outline mb-4">
            <input type="email" value="<?php echo $user_email ?>" class="form-control w-50 m-auto" name="user_email"
                required="required">
        </div>
        <div class="form-outline mb-4 d-flex  w-50 m-auto">
            <input type="file" class="form-control " name="user_img" required="required">
            <img src="./user_img/<?php echo $user_img_fetch ?>" class="user_edit_img" alt="">
        </div>
        <div class="form-outline mb-4">
            <input type="text" value="<?php echo $user_address ?>" class="form-control w-50 m-auto" name="user_address"
                required="required">
        </div>
        <div class="form-outline mb-4">
            <input type="text" value="<?php echo $user_no ?>" class="form-control w-50 m-auto" name="user_mobile"
                required="required">

        </div>
        <input type="submit" value="Update" class="bg-info py-2 px-3 boarder-0" name="user_upadate">


    </form>
</body>

</html>