<?php
include ('../include/connect.php');
include ('../user_area/common_function.php');
@session_start();

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- css file -->
    <link rel="stylesheet" href="../style.css">

    <!-- font awsome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- link insert_catagories -->
    <link rel="stylesheet" href="insert_catagories.php">

    <!-- css _link 2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



    <style>
        body {
            overflow: hidden;
        }
    </style>


</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
        <div class="row d-flex justify-content-center ">
            <div class="col-lg-6 col-xl-5 ">
                <img src="../image/login_img.png" alt="admin_login" class="img-fluid">

            </div>
            <div class="col-lg-6  col-xl-5">
                <form action="" method="post">
                    <!-- Username -->
                    <div class="form-outline mb-4">
                        <label for="admin_name" class="form-label">Admin name</label>
                        <input type="text" id="admin_name" name="admin_name" placeholder="Enter your Admin name"
                            required="required" class="form-control" autocomplete="off">
                    </div>

                    <!-- password -->
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            class="form-control" autocomplete="off">

                    </div>

                    <div>
                        <p class="small fw-bold mb-3"> <a href="#" class="text-decoration-none text-danger">Forgot
                                Password</a> <a class="text-decoration-none text-danger"
                                href="../user_area/user_login.php">/
                                User login</a></p>
                        <input type="submit" class=" bg-info py-2 px-3 border-0 " name="admin_login" value="Login">
                        <p class="small mt-2 fw-bold "> Don't you have an account ?<a href="admin_registretion.php"
                                class="text-decoration-none">Register</a> </p>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <?php



    global $con;
    if (isset($_POST['admin_login'])) {
        $admin_name = $_POST['admin_name'];
        $password = $_POST['password'];
        $admin_ip = getIPAddress();

        $select_query = "Select * from `admin_table` where admin_name='$admin_name'";
        $result = mysqli_query($con, $select_query);
        $row_count = mysqli_num_rows($result);
        $row_data = mysqli_fetch_assoc($result);
        if ($row_count > 0) {
            $admin_name = $_POST['admin_name'];
            $_SESSION['username'] = $admin_name;
            if (password_verify($password, $row_data['admin_pass'])) {
                echo "<script> alert('Login successful')
                 window.open('index.php','_self')
                </script>";


            } else {
                echo "<script>  alert('Invalid credintials')</script>";
            }

        } else {
            echo "<script>  alert('Invalid credintials')</script>";
        }
    }
    ?>























    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

</body>

</html>