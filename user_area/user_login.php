<?php
include ('../include/connect.php');
// include ('../fuction/common_func.php');
@session_start();
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



?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS link -->
    <link rel="stylesheet" href="style.css">
    <!-- removing horizontal scrolbar -->
    <style>
        body {
            overflow-x: hidden;
        }
    </style>

</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-6 col-xl-5 ">
                <img src="../image/login_img.png" alt="admin_registration" class="img-fluid">
            </div>

            <div class="col-lg-12 col-xl-5">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Username -->
                    <div class="form-outline mb-4 mt-5">
                        <label for="user_name" class="form-label">Username</label>
                        <input type="text" id="user_name" class="form-control" placeholder="Enter your Username"
                            autocomplete="off" required="required" name="user_name">
                    </div>
                    <!-- user-password  -->
                    <div class="form-outline mb-4">
                        <label for="user_pass" class="form-label">Password</label>
                        <input type="password" id="user_pass" class="form-control" placeholder="Enter your password"
                            autocomplete="off" required="required" name="user_pass">
                    </div>


                    <div class="mt-4 pt-2">
                        <p class="small fw-bold   mb-2"> <a href="#" class="text-decoration-none text-danger">Forgot
                                Password </a><a href="../admin_area/admin_login.php"
                                class="text-decoration-none text-danger">/ Admin Login ?</a> </p>
                        <input type="submit" value="Login" class="bg-info mt-2 px-3 py-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-2 mb-2">Don't have an acconut ?<a href="user_registration.php"
                                class="text-decoration-none text-danger">Register</a>
                        </p>
                    </div>

                </form>
            </div>
        </div>
    </div>



    </div>
    </div>


    <!-- include footer -->
    <?php
    include ("../include/footer.php");

    ?>
</body>

</html>

<?php



global $con;
if (isset($_POST['user_login'])) {
    $user_uname = $_POST['user_name'];
    $user_pass = $_POST['user_pass'];
    $user_ip = getIPAddress();

    $select_query = "Select * from `user_table` where user_name='$user_uname'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    //card item

    $select_query_card = "Select * from `user_table` where user_ip='$user_ip'";

    $select_card = mysqli_query($con, $select_query_card);
    $row_count_card = mysqli_num_rows($select_card);







    if ($row_count > 0) {
        $user_username = $_POST['user_name'];
        $_SESSION['username'] = $user_username;
        if (password_verify($user_pass, $row_data['user_pass'])) {
            // echo "<script> alert('Login successful')</script>";

            if ($row_count == 1 and $row_count_card == 0) {
                $_SESSION['username'] = $user_username;

                echo "<script> alert('Login successful')</script>";
                echo "<script> window.open('payment.php','_self')</script>";
            } else {
                $_SESSION['username'] = $user_username;
                echo "<script> alert('Login successful')</script>";
                echo "<script> window.open('payment.php','_self')</script>";
            }


        } else {
            echo "<script>  alert('Invalid credintials')</script>";
        }

    } else {
        echo "<script>  alert('Invalid credintials')</script>";
    }
}
?>