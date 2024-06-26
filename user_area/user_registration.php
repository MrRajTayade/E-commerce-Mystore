<?php

// include();
include ('../include/connect.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>

    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS link -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../image/login_img.png" alt="admin_registration" class="img-fluid">
            </div>








            <div class="col-lg-12 col-xl-5">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Username -->
                    <div class="form-outline mb-4">
                        <label for="user_name" class="form-label">Username</label>
                        <input type="text" id="user_name" class="form-control" placeholder="Enter your Username"
                            autocomplete="off" required="required" name="user_name">
                    </div>
                    <!-- User Email -->
                    <div class="form-outline mb-4">
                        <label for="user_email" class="form-label"> E-mail</label>
                        <input type="text" id="user_email" class="form-control" placeholder="Enter your Email"
                            autocomplete="off" required="required" name="user_email">
                    </div>
                    <!-- user image -->
                    <div class="form-outline mb-4">
                        <label for="user_img" class="form-label">User image</label>
                        <input type="file" id="user_img" class="form-control" name="user_img">
                    </div>
                    <!-- user-password  -->
                    <div class="form-outline mb-4">
                        <label for="user_pass" class="form-label">Password</label>
                        <input type="password" id="user_pass" class="form-control" placeholder="Enter your password"
                            autocomplete="off" required="required" name="user_pass">
                    </div>
                    <!-- user conform-password -->
                    <div class="form-outline mb-4">
                        <label for="conf_pass" class="form-label">Confirm Password</label>
                        <input type="password" id="conf_pass" class="form-control" placeholder="Confirm your password"
                            autocomplete="off" required="required" name="conf_pass">
                    </div>
                    <!-- user address -->
                    <div class="form-outline mb-4">
                        <label for="user_address" class="form-label">Address</label>
                        <input type="text" id="user_address" class="form-control" placeholder="Enter your address"
                            autocomplete="off" required="required" name="user_address">
                    </div>
                    <!-- user contact -->
                    <div class="form-outline mb-4">
                        <label for="user_contact" class="form-label">Contact No</label>
                        <input type="text" id="user_contact" class="form-control" placeholder="Enter your contact"
                            autocomplete="off" required="required" name="user_contact">
                    </div>
                    <div class="mt-4 pt-2">
                        <input type="submit" value="Register" class="bg-info px-3 py-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-2 mb-2">Already have an account? <a href="user_login.php"
                                class="text-decoration-none text-danger">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
        <!-- include footer -->
        <?php
        include ("../include/footer.php");

        ?>
    </div>

    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>

<?php
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}




if (isset($_POST['user_register'])) {

    $user_username = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];
    $hash_password = password_hash($user_pass, PASSWORD_DEFAULT);
    $user_con_pass = $_POST['conf_pass'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    // $user_ip = $_POST['user_ip'];

    // Accessing the img
    $user_img = $_FILES['user_img']['name'];
    $user_img_temp = $_FILES['user_img']['tmp_name'];

    $user_ip = getIPAddress();

    // Select Query
    $select_query = "SELECT * FROM `user_table` WHERE user_name='$user_username' OR user_email='$user_email'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        echo "<script>alert('Username or email already exists')</script>";
    } else if ($user_pass != $user_con_pass) {
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        // Insert Query
        if (move_uploaded_file($user_img_temp, "./user_img/$user_img")) {
            $insert_query = "INSERT INTO `user_table` (user_name, user_email, user_pass, user_img, user_ip, user_address, user_no) 
                             VALUES ('$user_username', '$user_email', '$hash_password', '$user_img', '$user_ip', '$user_address', '$user_contact')";

            $sql_execute = mysqli_query($con, $insert_query);

            if ($sql_execute) {
                echo "<script>alert('Data inserted successfully')</script>";
            } else {
                echo "<script>alert('Data insertion failed: " . mysqli_error($con) . "')</script>";
            }
        } else {
            echo "<script>alert('Image upload failed')</script>";
        }

    }


    // Selecting cart items
    $select_card_item = "SELECT * FROM `card_details` WHERE ip_address='$user_ip'";
    $result_card = mysqli_query($con, $select_card_item);

    // Check if query executed successfully
    if ($result_card === false) {
        die("Error executing query: " . mysqli_error($con));
    }

    $row_count = mysqli_num_rows($result_card);

    if ($row_count > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>alert('You have an item in your cart')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    } else {
        echo "<script>window.open('../index.php','_self')</script>";
    }


























    //selecting card items
    // $select_card_iterm = "Select * from `card_details` where user_ip='$user_ip'";

    // $result_card = mysqli_query($con, $select_card_iterm);
    // $row_count = mysqli_num_rows($result_card);


    // if ($row_count > 0) {
    //     $_SESSION['username'] = $user_username;
    //     echo "<script>alert('You have a  item in your card')</script>";
    //     echo "<script>window.open('checkout.php','_self')</script>";
    // } else {
    //     echo "<script>window.open('../index.php','_self')</script>";
    // }







}
?>