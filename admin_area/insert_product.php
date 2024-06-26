<?php
include ("../include/connect.php");

if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_desp = $_POST['product_desp'];
    $product_keyword = $_POST['product_keyword'];
    $product_category = $_POST['product_category'];
    $product_brands = $_POST['product_brands'];
    $product_statuse = 'true';
    $product_price = $_POST['product_price'];

    // Accessing images
    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_img3 = $_FILES['product_img3']['name'];

    // Accessing temporary names
    $temp_img1 = $_FILES['product_img1']['tmp_name'];
    $temp_img2 = $_FILES['product_img2']['tmp_name'];
    $temp_img3 = $_FILES['product_img3']['tmp_name'];

    // Checking empty conditions
    if ($product_title == '' || $product_desp == '' || $product_keyword == '' || $product_category == '' || $product_brands == '' || $product_img1 == '' || $product_img2 == '' || $product_img3 == '') {
        echo "<script>alert('Please fulfill the details');</script>";
        exit();
    } else {
        // Check for duplicate product title
        $check_query = "SELECT * FROM `products` WHERE product_title = '$product_title'";
        $check_result = mysqli_query($con, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Product with this title already exists');</script>";
        } else {
            move_uploaded_file($temp_img1, "./product_img/$product_img1");
            move_uploaded_file($temp_img2, "./product_img/$product_img2");
            move_uploaded_file($temp_img3, "./product_img/$product_img3");

            // Insert query
            $insert_product = "INSERT INTO `products` (product_title, product_desp, product_keywords, catagory_id, brand_id, product_img1, product_img2, product_img3, product_price, date, statuse) VALUES ('$product_title', '$product_desp', '$product_keyword', '$product_category', '$product_brands', '$product_img1', '$product_img2', '$product_img3', '$product_price', NOW(), '$product_statuse')";
            $result_query = mysqli_query($con, $insert_product);
            if ($result_query) {
                echo "<script>
                        alert('Product inserted successfully');
                        setTimeout(function(){
                            window.location.href = '" . $_SERVER['PHP_SELF'] . "';
                        }, 1500);
                      </script>";
                exit();
            }

        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>
    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CSS file -->
    <link rel="stylesheet" href="../style.css">
    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        html,
        body {
            height: 100%;
        }

        .footer {
            padding: 10px 0;
            text-align: center;
        }
    </style>




</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center text-success">Insert Product</h1>
        <!-- Form -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control"
                    placeholder="Enter product title" autocomplete="off" required="required">
            </div>
            <!-- Description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_desp" class="form-label">Product Description</label>
                <input type="text" name="product_desp" id="product_desp" class="form-control"
                    placeholder="Enter product description" autocomplete="off" required="required" maxlength="283">
            </div>
            <!-- Keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product Keywords</label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control"
                    placeholder="Enter product keywords" autocomplete="off" required="required">
            </div>
            <!-- Categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_category" class="form-label">Product Category</label>
                <select name="product_category" id="product_category" class="form-select">
                    <option value="">Select Category</option>
                    <?php
                    $select_query = "SELECT * FROM `catagories`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $catagory_title = $row['catagory_title'];
                        $catagory_id = $row['catagory_id'];
                        echo "<option value='$catagory_id'>$catagory_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_brands" class="form-label">Product Brands</label>
                <select name="product_brands" id="product_brands" class="form-select">
                    <option value="">Select Brands</option>
                    <?php
                    $select_query = "SELECT * FROM `brands`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- Image 1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_img1" class="form-label">Product Image 1</label>
                <input type="file" name="product_img1" id="product_img1" class="form-control" autocomplete="off"
                    required="required">
            </div>
            <!-- Image 2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_img2" class="form-label">Product Image 2</label>
                <input type="file" name="product_img2" id="product_img2" class="form-control" autocomplete="off"
                    required="required">
            </div>
            <!-- Image 3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_img3" class="form-label">Product Image 3</label>
                <input type="file" name="product_img3" id="product_img3" class="form-control" autocomplete="off"
                    required="required">
            </div>
            <!-- Price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product Price</label>
                <input type="text" name="product_price" id="product_price" class="form-control"
                    placeholder="Enter product price" autocomplete="off" required="required">
            </div>
            <!-- Button -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Insert Product">
                <!-- <button class="btn btn-info mb-3 px-3"><a href="./index.php" class="text-decoration-none text-black"> Go
                        back</a></button> -->
            </div>


        </form>
    </div>

    <!-- include footer
    //<?php
    //include ("../include/footer.php");

    ?> -->




    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>