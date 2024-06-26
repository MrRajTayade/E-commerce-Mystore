<?php
include ('../include/connect.php');
include ('common_function.php');
session_start();


?>
<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome <?php echo $_SESSION['username'] ?></title>
<!-- bootstrap  css link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- font awesome link -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- css link -->

<link rel="stylesheet" href="../style.css">


<style>
    .profile_img {
        width: 90%;
        height: 90%;
        margin: auto;
        display: block;
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
                <img src="../image/log.png" class="logo" alt="not found">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Product</a>
                        </li>

                        <?php
                        if (isset($_SESSION['username'])) {
                            echo "<li class='nav-item'>
                         <a class='nav-link' href='profile.php'>My Account</a>
                     </li>";
                        } else {
                            echo
                                "   <li class='nav-item'>
                            <a class='nav-link' href='user_registration.php'>Register</a>
                        </li>";
                        }



                        ?>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../card.php"><i class="fa-solid fa-cart-shopping"></i> <sup>
                                    <?php
                                    cardItem();
                                    ?>
                                </sup> </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price :<?php
                            totlePrice();
                            ?>/-

                            </a>
                        </li>
                    </ul>
                    <form class="d-flex" action="../search_product.php" method="get">
                        <input class="form-control me-2" type="Search" placeholder="Search" aria-label="Search"
                            name="search_data">
                        <input type="submit" value="search" class="btn btn-outline-dark" name="search_data_product">
                    </form>
                </div>
            </div>
        </nav>
        <!-- second child -->

        <nav class="navbar navbar-expand-lg navbar-dark  bg-secondary">
            <ul class="navbar-nav me-auto">

                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Wlcome Guest</a>
                </li> -->
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


                //user login
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'> 
                        <a class='nav-link'href='user_login.php'>Login</a> </li>";
                } else {
                    echo "<li class='nav-item'>
                         <a class='nav-link'href='logout.php'>Logout</a></li>";
                }



                ?>
            </ul>
        </nav>

        <!-- Third child -->
        <div class="bg-light">
            <h3 class="text-center">Big Store </h3>
            <p class="text-center">Communication is the heart of e-commerce and community</p>
        </div>



        <!-- fourth child -->
        <div class="row">
            <div class="col-md-2 mb-3 ">
                <ul class="navbar-nav bg-secondary  text-center" style="height:100vh">
                    <li class="nav-item bg-info ">
                        <a class="nav-link  text-light" href="#">
                            <h4>Your Profile</h4>
                        </a>
                    </li>
                    <?php
                    $username = $_SESSION['username'];
                    $user_img = "select * from `user_table` where user_name='$username'";
                    $user_img = mysqli_query($con, $user_img);
                    $row_img_fetch = mysqli_fetch_array($user_img);
                    $user_img_fetch = $row_img_fetch['user_img'];
                    echo " <li class='nav-item  my-4 '>
                    <img src='./user_img/$user_img_fetch' class='profile_img' alt=''>
                </li>";


                    ?>


                    <li class="nav-item  ">
                        <a class="nav-link  text-light" href="profile.php">
                            Pending Orders
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a class="nav-link  text-light" href="profile.php?Edit_account">
                            Edit Account
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a class="nav-link  text-light" href="profile.php?my_ordes">
                            My Orders
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a class="nav-link  text-light" href="profile.php ? confirm_order">
                            Orders History
                        </a>
                    </li>



                    <li class="nav-item  ">
                        <a class="nav-link  text-light" href="profile.php? delete_account">
                            Delete Account
                        </a>
                    </li>
                    <li class="nav-item  ">
                        <a class="nav-link  text-light" href="logout.php">
                            Logout
                        </a>
                    </li>
                </ul>

            </div>
            <div class="col-md-10">
                <?php
                get_user_order();
                if (isset($_GET['Edit_account'])) {
                    include ('edit_account.php');

                }
                if (isset($_GET['my_ordes'])) {
                    include ('user_orders.php');

                }
                if (isset($_GET['delete_account'])) {
                    include ('delete_account.php');

                }
                if (isset($_GET['confirm_order'])) {
                    include ('confirm_order.php  ');

                }
                

                ?>
            </div>
        </div>
        <hr>

        <!-- last child -->
        </hr>

        <!-- include footer -->
        <?php
        include ("../include/footer.php");

        ?>

    </div>
    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>


    <!-- javascript model link -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>

</html>