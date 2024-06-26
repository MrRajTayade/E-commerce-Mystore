<?php
if (isset($_GET['edit_products'])) {
    $edit_id = $_GET['edit_products'];

    $get_products = "Select * from `products`where product_id=$edit_id";
    $result_query = mysqli_query($con, $get_products);

    $row = mysqli_fetch_assoc($result_query);
    $product_title = $row['product_title'];
    $product_desp = $row['product_desp'];
    $product_keywords = $row['product_keywords'];
    $brand_id = $row['brand_id'];
    $catagory_id = $row['catagory_id'];
    $product_img1 = $row['product_img1'];
    $product_img2 = $row['product_img2'];
    $product_img3 = $row['product_img3'];
    $product_price = $row['product_price'];


    //fetching catagory
    $select_catagory = "Select * from `catagories` where catagory_id=$catagory_id";
    $result_catagroy_query = mysqli_query($con, $select_catagory);
    $row_catagroy = mysqli_fetch_assoc($result_catagroy_query);
    $catagory_title = $row_catagroy['catagory_title'];



    //fetching brands
    $select_brands = "Select * from `brands` where brand_id=$brand_id";
    $result_brands_query = mysqli_query($con, $select_brands);
    $row_brands = mysqli_fetch_assoc($result_brands_query);
    $brand_title = $row_brands['brand_title'];
}

?>
<style>
    .img {
        width: 100px;
        height: 100px;
        object-fit: contain;

    }
</style>





<div class="continer mt-5">
    <h1 class="text-center  ">Edit Product</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-outline w-50 m-auto">
            <label for="product_title" class="form_lable"> Prodcut Title</label>
            <input type="text" name="product_title" value="<?php echo $product_title ?>" id="product_title"
                class="form-control">
        </div>

        <div class="form-outline w-50 m-auto mt-4">
            <label for="product_description" class="form_lable"> Prodcut Description</label>
            <input type="text" name="product_description" id="product_description" class="form-control" value="<?php
            echo $product_desp ?>">
        </div>



        <div class="form-outline w-50 m-auto mt-4">
            <label for="product_keywords" class="form_lable"> Prodcut Keywords</label>
            <input type="text" name="product_keywords" id="product_keywords" class="form-control"
                value="<?php echo $product_keywords ?>">
        </div>


        <div class="form-outline w-50 m-auto mt-4">
            <label for="product_catagory" class="form_lable"> Prodcut Catagory</label>
            <select name="product_catagory" class="form-select">
                <option value="<?php echo $catagory_title ?>"><?php echo $catagory_title ?> </option>

                <?php

                //fetching catagory
                $select_catagory_all = "Select * from `catagories`";
                $result_catagroy_query_all = mysqli_query($con, $select_catagory_all);
                while ($row_catagroy_all = mysqli_fetch_assoc($result_catagroy_query_all)) {
                    $catagory_title = $row_catagroy_all['catagory_title'];
                    $catagory_id = $row_catagroy_all['catagory_id'];
                    echo "<option value='$catagory_id'>$catagory_title </option>";
                }
                ?>


            </select>

        </div>

        <div class="form-outline w-50 m-auto mt-4">
            <label for="product_brands" class="form_lable"> Prodcut brand</label>
            <select name="product_brands" class="form-select">
                <option value="<?php echo $brand_id ?>"><?php echo $brand_title ?> </option>
                <?php


                $select_brands_all = "Select * from `brands`";
                $result_brands_query_all = mysqli_query($con, $select_brands_all);

                while ($row_brands_all = mysqli_fetch_assoc($result_brands_query_all)) {
                    $brand_id = $row_brands_all['brand_id'];
                    $brand_title = $row_brands_all['brand_title'];
                    echo "<option value=' $brand_id'>  $brand_title</option>";

                }
                ?>


            </select>

        </div>

        <div class="form-outline w-50 m-auto mt-4">
            <label for="product_img1" class="form_lable"> Prodcut img 1</label>
            <div class="d-flex">
                <input type="file" name="product_img1" id="product_img1" class="form-control">
                <img src="./product_img/<?php echo $product_img1 ?>" alt="" class="img">
            </div>
        </div>


        <div class="form-outline w-50 m-auto mt-4">
            <label for="product_img2" class="form_lable"> Prodcut img 2</label>
            <div class="d-flex">
                <input type="file" name="product_img2" id="product_img2" class="form-control">
                <img src="./product_img/<?php echo $product_img2 ?>" alt="" class="img">
            </div>
        </div>



        <div class="form-outline w-50 m-auto mt-4">
            <label for="product_img3" class="form_lable"> Prodcut img 3</label>
            <div class="d-flex">
                <input type="file" name="product_img3" id="product_img3" class="form-control">
                <img src="./product_img/<?php echo $product_img3 ?>" alt="" class="img">
            </div>
        </div>


        <div class="form-outline w-50 m-auto mt-4">
            <label for="product_price" class="form_lable"> Prodcut Price</label>
            <input type="text" name="product_price" id="product_price" class="form-control"
                value="<?php echo $product_price ?>">
        </div>

        <div class="text-center">
            <input type="submit" name="edit_product" value="Update Product" class="btn btn-info mt-4 border-0 m-3">
        </div>



    </form>
</div>

<!-- Editing products -->
<?php
if (isset($_POST['edit_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_brands = $_POST['product_brands'];
    $product_catagory = $_POST['product_catagory'];
    $product_price = $_POST['product_price'];

    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_img3 = $_FILES['product_img3']['name'];

    $temp_product_img1 = $_FILES['product_img1']['tmp_name'];
    $temp_product_img2 = $_FILES['product_img2']['tmp_name'];
    $temp_product_img3 = $_FILES['product_img3']['tmp_name'];


    //checking for is empty or not 
    if ($product_title == '' or $product_description == '' or $product_keywords == '' or $product_brands == '' or $product_catagory == '' or $product_price === '' or $product_img1 == '' or $product_img2 == '' or $product_img3 == '') {
        echo "<script>alert('Please fill the all field')</script>";

    } else {
        move_uploaded_file($temp_product_img1, "./product_img/$product_img1");
        move_uploaded_file($temp_product_img2, "./product_img/$product_img2");
        move_uploaded_file($temp_product_img3, "./product_img/$product_img3");

        //updte products
        $updte_product = "update `products`set product_title='$product_title', product_desp=' $product_description',product_keywords='$product_keywords',catagory_id='$product_catagory',brand_id='$product_brands',product_img1='$product_img1',product_img2='$product_img2',product_img3='$product_img3',brand_id='$product_brands',product_price='$product_price',date=NOW() where product_id=$edit_id";


        $result_update = mysqli_query($con, $updte_product);
        if ($result_update) {
            echo "<script>alert('Product updated successfully'),
            windows.open('insert_product.php','_self')
            </script>";
        }


    }

}

?>