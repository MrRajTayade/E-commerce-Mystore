<?php
include ('include/connect.php');
include ('fuction/common_func.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>E-commerce website</title>
<!-- bootstrap  css link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- font awesome link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- css link -->
<link rel="stylesheet" href="style.css">
<style>
    .card-img {

        width: 80px;
        height: 80px;
        object-fit: contain;
    }
</style>

</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <img src="image\log.png" class="logo" alt="not found">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Product</a>
                        </li>

                        <?php
                        if (isset($_SESSION['username'])) {
                            echo "<li class='nav-item'>
                         <a class='nav-link' href='./user_area/profile.php'>My Account</a>
                     </li>";
                        } else {
                            echo
                                "   <li class='nav-item'>
                            <a class='nav-link' href='./user_area/user_registration.php'>Register</a>
                        </li>";
                        }



                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="card.php"><i class="fa-solid fa-cart-shopping"></i> <sup>
                                    <?php
                                    cardItem();
                                    ?>
                                </sup> </a>
                        </li>


                    </ul>

                </div>
            </div>
        </nav>
        <!-- second child -->

        <nav class="navbar navbar-expand-lg navbar-dark  bg-secondary">
            <ul class="navbar-nav me-auto">


                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome Guest</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='#'>Welcome  " . $_SESSION['username'] . "</a>
                </li>";
                }




                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'> 
                        <a class='nav-link'href='user_area/user_login.php'>Login</a> </li>";
                } else {
                    echo "<li class='nav-item'>
                         <a class='nav-link'href='user_area/logout.php'>Logout</a></li>";
                }



                ?>
            </ul>
        </nav>

        <!-- Third child -->
        <div class="bg-light">
            <h3 class="text-center">Big Store </h3>
            <p class="text-center">Communication is the heart of e-commerce and community</p>
        </div>

        <!-- fourth child-table-->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <table class="table table-bordered text-center ">
                        <!-- php code for to display dynamic data  -->
                        <?php


                        global $con;
                        $get_ip_add = getIPAddress();
                        $totle_price = 0;
                        $path_query = "Select * from `card_details` where ip_address='$get_ip_add'";
                        $result_query = mysqli_query($con, $path_query);
                        $result_count = mysqli_num_rows($result_query);// for coubnting the no of rows
                        if ($result_count > 0) {
                            echo "
                                <thead>
                                    <tr>
                                        <th>Product title</th>
                                        <th>Product</th>
                                        <th>Quentity </th>
                                        <th>Total price</th>
                                        <th>Remove</th>
                                        <th collapse='2'>Operations</th>
                                    </tr>
        
                                </thead>
                                <tbody>";


                            while ($row = mysqli_fetch_array($result_query)) {//one user can add mutiple item
                                $product_id = $row['product_id'];
                                $select_product = "Select * from `products` where  product_id='$product_id'";
                                $result_Pro_query = mysqli_query($con, $select_product);
                                while ($row_product_price = mysqli_fetch_array($result_Pro_query)) {
                                    $product_price = array($row_product_price['product_price']);
                                    $price_table = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_img = $row_product_price['product_img1'];
                                    $product_valaues = array_sum($product_price);
                                    $totle_price += $product_valaues;

                                    // <?php echo $product_img
                                    ?>


                                    <tr>
                                        <td><?php echo $product_title ?></td>
                                        <td><img src="admin_area/product_img/<?php echo $product_img ?>" class="card-img"
                                                alt="not found"> </td>
                                        <td><input type="text" name="qut" class="form-input w-50"></td>

                                        <!-- updatating data  -->
                                        <?php

                                        $get_ip_add = getIPAddress();
                                        if (isset($_POST['update_card'])) {
                                            // $totle_price = 0;
                                            $quntites = $_POST['qut'];
                                            $upadte_card = "update `card_details` set quantity=$quntites where ip_address='$get_ip_add'";
                                            $result_product_query = mysqli_query($con, $upadte_card);
                                            $quntites = $row['quantity'];
                                            $totle_price = $totle_price * $quntites;

                                        }
                                        ?>
                                        <td><?php echo $price_table ?>/-</td>

                                        <td><input type="checkbox" name="remove_item[]" value="<?php echo $product_id ?>"></td>
                                        <td>

                                            <input type="submit" value="update" class="bg-info px-3 mx-3" name="update_card">

                                            <input type="submit" value="Remove" class="bg-secondary px-3 mx-3" name="remove_card">

                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>Card is empty</h2>";
                        }

                        ?>
                        </tbody>
                    </table>
                    <!-- sub-totle -->
                    <div class="d-flex mb-5">
                        <?php


                        global $con;
                        $get_ip_add = getIPAddress();
                        // $totle_price = 0;
                        $path_query = "Select * from `card_details` where ip_address='$get_ip_add'";
                        $result_query = mysqli_query($con, $path_query);
                        $result_count = mysqli_num_rows($result_query);// for coubnting the no of rows
                        if ($result_count > 0) {
                            echo "<h4 class='px-3'>Subtotal:<strong class='text-danger'>$totle_price/-</strong>
                            </h4>
                            <input type='submit' value='Continue shoping' class='bg-info px-3 mx-3' name='continue_shoping'>
                            <button class='bg-secondary px-5 mx-4 p-1'><a href='user_area/Checkout.php'class='text-decoration-none text-light '>Checkout</a></button>";

                        } else {
                            echo "<input type='submit' value='Continue shoping' class='bg-info px-3 mx-3' name='continue_shoping'> ";
                        }
                        if (isset($_POST['continue_shoping'])) {
                            echo "<script>window.open('index.php','_self')</script>";

                        }
                        ?>
                    </div>
            </div>
        </div>
        </form>
        <!-- function to remove item -->
        <?php
        function remove_item()
        {
            global $con;

            if (isset($_POST['remove_card'])) {
                if (isset($_POST['remove_item']) && is_array($_POST['remove_item'])) {
                    foreach ($_POST['remove_item'] as $remove_id) {
                        $remove_id = intval($remove_id); // Sanitizing input to prevent SQL injection
                        echo $remove_id;

                        $delete_query = "DELETE FROM `card_details` WHERE product_id = $remove_id";
                        $run_delete = mysqli_query($con, $delete_query);

                        if (!$run_delete) {
                            echo "Error deleting item with ID $remove_id: " . mysqli_error($con);
                        }
                    }

                    // Redirect after all deletions are attempted
                    echo "<script>window.open('card.php','_self')</script>";
                } else {
                    echo "<sript> <h2 class='text-center'>No items selected for removal.</h2></sript>";
                }
            }
        }

        remove_item();
        ?>

        <!-- include footer -->
        <?php
        include ("./include/footer.php");

        ?>
    </div>
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>