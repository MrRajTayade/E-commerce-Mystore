<?php
include ('../include/connect.php');
include ('../user_area/common_function.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin registration</title>

    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- css file -->
    <link rel="stylesheet" href="../style.css">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- link insert_categories -->
    <link rel="stylesheet" href="insert_categories.php">

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
        <h2 class="text-center mb-5">Admin Registration</h2>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <img src="../image/login_img.png" alt="admin_registration" class="img-fluid">
            </div>
            <div class="col-lg-6 col-xl-5">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- Username -->
                    <div class="form-outline mb-4">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username"
                            required="required" class="form-control" autocomplete="off">
                    </div>
                    <!-- Email -->
                    <div class="form-outline mb-4">
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" id="Email" name="Email" placeholder="Enter your email" required="required"
                            class="form-control" autocomplete="off">
                    </div>

                    <!-- Admin img -->
                    <div class="form-outline mb-4">
                        <label for="admin_img" class="form-label">Admin image</label>
                        <input type="file" id="admin_img" class="form-control" name="admin_img">
                    </div>

                    <!-- Password -->
                    <div class="form-outline mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            required="required" class="form-control" autocomplete="off">
                    </div>
                    <!-- Confirm Password -->
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password"
                            placeholder="Enter your confirm password" required="required" class="form-control"
                            autocomplete="off">
                    </div>
                    <div>
                        <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration"
                            value="Register">
                        <p class="small fw-bold ">Already have an account? <a href="admin_login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>

<?php
if (isset($_POST['admin_registration'])) {
    $username = $_POST['username'];
    $Email = $_POST['Email'];
    $password = $_POST['password'];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm_password'];

    // Accessing the img
    $admin_img = $_FILES['admin_img']['name'];
    $admin_img_temp = $_FILES['admin_img']['tmp_name'];

    $admin_ip = getIPAddress();

    // Select Query
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$username' OR admin_email='$Email'";
    $result = mysqli_query($con, $select_query);

    if (!$result) {
        die("Query Failed: " . mysqli_error($con));
    }

    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        echo "<script>alert('Admin name or email already exists')</script>";
    } else if ($password != $confirm_password) {
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        // Insert Query
        if (move_uploaded_file($admin_img_temp, "./admin_img/$admin_img")) {
            $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_pass, admin_img, admin_ip) VALUES ('$username', '$Email', '$hash_password', '$admin_img', '$admin_ip')";

            $sql_execute = mysqli_query($con, $insert_query);

            if ($sql_execute) {
                echo "<script>alert('Data inserted successfully')
                window.open('admin_login.php')
                </script>";
            } else {
                echo "<script>alert('Data insertion failed: " . mysqli_error($con) . "')</script>";
            }
        } else {
            echo "<script>alert('Image upload failed')</script>";
        }
    }
}
?>