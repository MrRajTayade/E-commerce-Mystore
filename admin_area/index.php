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
    <title> Welcome <?php echo $_SESSION['username'] ?></title>
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
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        .container-fluid {
            flex: 1;
        }

        .button>button {
            margin: 10px;
        }

        .footer {
            padding: 10px 0;
            text-align: center;
        }
    </style>

</head>


<!-- navbar -->
<div class="container-fluid p-0">
    <!-- first child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container-fluid">
            <img src="../image/log.png" class="logo" alt="">
            <h3 class="text-center p-2">
                Manage Details
            </h3>
            <nav class="navbar navbar-expand-lg ">

                <ul class="navbar-nav">
                    <?php
                    //this is use for to display username
                    if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'>
    <a class='nav-link' href='#'>Welcome Guest</a>
</li>";
                    } else {
                        echo "<li class='nav-item'>
    <a class='nav-link' href='#'>Welcome  " . $_SESSION['username'] . "</a>
</li>";
                    }

                    ?>



                    <!-- <li class="nav-item">
                            <a href="" class="nav-link">Welcome guest</a>
                        </li> -->
                </ul>

            </nav>

        </div>

    </nav>
    <!-- second child -->
    <div class="bg-light">
        <!-- <h3 class="text-center p-2">
            Manage Details
        </h3> -->

        <!-- third child -->
        <div class="row">
            <div class="col-md-12 bg-secondary p-1 d-flex align-items-center ">
                <div class="p-3 ">

                    <?php
                    $admin_name = $_SESSION['username'];
                    $admin_img = "select * from `admin_table` where admin_name='$admin_name'";
                    $admin_img = mysqli_query($con, $admin_img);
                    $row_img_fetch = mysqli_fetch_array($admin_img);
                    $admin_img_fetch = $row_img_fetch['admin_img'];
                    echo "<a href='index.php ? admin_profile'><img src='./admin_img/$admin_img_fetch ' alt='notfound'
                                class='admin_img'></a>
                       <a class='text-decoration-none' href='index.php ? admin_profile'> <p class='text-light text-center '>$admin_name</p></a>";



                    ?>







                </div>

                <div class="button text-center">
                    <button class="my-3"><a href="index.php ?insert_product"
                            class="nav-link text-light bg-info my-1 p-1">Insert
                            Product</a></button>
                    <button><a href="index.php?view_products" class="nav-link text-light bg-info my-1 p-1">View
                            Product</a></button>
                    <button><a href="index.php ? insert_catagories" class="nav-link text-light bg-info my-1 p-1">Insert
                            Catagories</a></button>
                    <button><a href="index.php?view_catagories" class="nav-link text-light bg-info my-1 p-1">View
                            Catagories</a></button>
                    <button><a href="index.php ? insert_brands" class="nav-link text-light bg-info my-1 p-1">Insert
                            Brands</a></button>
                    <button><a href="index.php ?view_brands" class="nav-link text-light bg-info my-1 p-1">View
                            Brands</a></button>
                    <button><a href="index.php?list_orders" class="nav-link text-light bg-info my-1 p-1">All
                            Order</a></button>
                    <button><a href="index.php?all_payment" class="nav-link text-light bg-info my-1 p-1">All
                            Payments</a></button>
                    <button><a href="index.php?paid_payment" class="nav-link text-light bg-info my-1 p-1">Paid
                            Payments</a></button>
                    <button><a href="index.php?user_list" class="nav-link text-light bg-info my-1 p-1"> users
                            List</a></button>
                    <button><a href="logout.php" class="nav-link text-light bg-info my-1 p-1">Logout</a></button>
                </div>

            </div>
        </div>


    </div>
    <!-- thikrd child -->

</div>

<!-- fourth child -->
<div class="container my-3">
    <?php
    if (isset($_GET['insert_catagories'])) {
        include ('insert_catagories.php');
    }

    if (isset($_GET['insert_brands'])) {
        include ('insert_brands.php');
    }
    if (isset($_GET['view_products'])) {
        include ('view_product.php');
    }
    if (isset($_GET['edit_products'])) {
        include ('edit_products.php');
    }
    if (isset($_GET['delete_products'])) {
        include ('delete_products.php');
    }
    if (isset($_GET['view_catagories'])) {
        include ('view_catagory.php');
    }
    if (isset($_GET['view_brands'])) {
        include ('view_brands.php');
    }
    if (isset($_GET['edite_catagory'])) {
        include ('edite_catagory.php');
    }
    if (isset($_GET['edit_brand'])) {
        include ('edit_brand.php');
    }
    if (isset($_GET['delete_brand'])) {
        include ('delete_brand.php');
    }
    if (isset($_GET['delete_catagory'])) {
        include ('delete_catagory.php');
    }
    if (isset($_GET['list_orders'])) {
        include ('list_orders.php');
    }
    if (isset($_GET['delete_order'])) {
        include ('delete_order.php');
    }
    if (isset($_GET['all_payment'])) {
        include ('all_payment.php');
    }
    if (isset($_GET['delete_payment'])) {
        include ('delete_payment.php');
    }
    if (isset($_GET['paid_payment'])) {
        include ('paid_payment.php');
    }
    if (isset($_GET['delete_paid_payment'])) {
        include ('delete_paid_payment.php');
    }

    if (isset($_GET['user_list'])) {
        include ('user_list.php');
    }
    if (isset($_GET['delete_user'])) {
        include ('delete_user.php');
    }
    if (isset($_GET['admin_profile'])) {
        include ('admin_profile.php');
    }

    if (isset($_GET['insert_product'])) {
        include ('insert_product.php');
    }
    ?>
</div>




<!-- bootstrap js link -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>


<hr>
</hr>
<!-- include footer -->
<?php
include ("../include/footer.php");

?>
</body>

</html>