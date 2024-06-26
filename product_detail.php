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
                            <a class="nav-link" href="card.php"><i class="fa-solid fa-cart-shopping"></i> <sup> <?php
                            cardItem();
                            ?></sup> </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price :<?php
                            totlePrice();
                            ?>/- </a>
                        </li>
                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
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
        <!-- calling cardfunction -->
        <?php
        // calling cardfunction
        card();
        ?>


        <!-- Third child -->
        <div class="bg-light">
            <h3 class="text-center">Big Store </h3>
            <p class="text-center">Communication is the heart of e-commerce and community</p>
        </div>

        <!-- fourth child -->
        <div class="row px-2">
            <div class="col-md-10">
                <!-- products -->
                <div class="row">
                    <!-- fetching_prodcut -->
                    <?php

                    viewDetails();
                    getUniqueCatagory();
                    getUniqueBrands();

                    searchProduct();

                    ?>

                    <!-- row endede   -->
                </div>
                <div class="row">
                    <h4 class="text-center" > Related Product</h4>
                    <?php

                    getAllProduct();
                    //getUniqueCatagory();
                    //getUniqueBrands();

                    // calling cardfunction
                   // card();









                    //                     $ip = getIPAddress();  
// echo 'User Real IP Address - '.$ip;
                    
                    ?>







                </div>

























                <!-- columng ended -->
            </div>
            <!-- side nav -->
            <div class="col-md-2 bg-secondary p-0">



                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">

                        <a href="#" class="nav-link text-light">
                            <h4>delivery Brands<h4>
                        </a>
                    </li>
                    <!-- inserting brand name from database -->
                    <?php

                    functionBrand();

                    ?>



                </ul>
                <!-- catogories -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">

                        <a href="#" class="nav-link text-light">
                            <h4> Catagories<h4>
                        </a>
                    </li>
                    <?php

                    functionCatagory();

                    ?>



                </ul>
            </div>
        </div>




















        <!-- last child -->
        <hr>
        </hr>
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