<?php
include ('../include/connect.php');
include ('common_function.php');

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment page</title>

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
        img {
            width: 50%;
            height: 50%;
            display: block;
            margin: auto;
        }
    </style>

</head>

<body>
    <!-- php code to aceess user id  -->
    <?php


    $user_ip = getIPAddress();
    $get_User = "Select * from `user_table` where user_ip='$user_ip' ";





    $result = mysqli_query($con, $get_User);
    $run_query = mysqli_fetch_array($result);
    $user_id = $run_query['user_id'];

    // if ($result) {
    //     $run_query = mysqli_fetch_array($result);
    //     $user_id = $run_query['user_id'];
    // } else {
    //     echo "Error: " . mysqli_error($con);
    // }
    










    ?>


    <div class="container">
        <h2 class="text-center text-info mt-3">Payment options

        </h2>
        <div class="row d-flex justify-conatent-center align-items-center my-5">
            <div class="col-md-6">
                <a href="order.php?user_id=<?php
                echo "$user_id";
                ?>"><img src="../image/upi.jpg" alt="error payment img" class="img text-center">
                    <h2 class="text-center">Click here to Pay </h3>
                </a>

            </div>
            <div class="col-md-6">
                <a href="../index.php";
                >
                    <h2 class="text-center"> Continue Shopping</h2>
                </a>

            </div>
        </div>
    </div>



    <!-- <div class="col-md-6">
        <a href="https://www.paytm.com"><img src="../image/pytm.png" alt="error payment img" class="img"></a>

    </div> -->








    <!-- bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>