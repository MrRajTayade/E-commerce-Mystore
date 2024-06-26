<div class="container mt-3">
    <h3 class="text-center text-success mt-3"> Edite Brand</h3>

    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="brand_title" class="form-lable">Brand title </label>
            <input type="text" name="brand_title" id="brand_title" class="form-control" required="required" value="
            <?php

            if (isset($_GET['edit_brand'])) {
                $get_brand_id = $_GET['edit_brand'];


                $select_brands = "select * from `brands`  where brand_id=$get_brand_id";
                $result_brand = mysqli_query($con, $select_brands);
                $row = mysqli_fetch_assoc($result_brand);
                $brand_title = $row['brand_title'];
                echo $brand_title;

            }
            ?>
">

            <input type="submit" value="Update brand" name="edit_branad" class="bg-info border-0 m-2 p-2 mt-5 ">
        </div>





    </form>




</div>



<?php

if ( isset($_POST['edit_branad'])) {
    $brand_title = $_POST['brand_title'];

    $update_query = "update `brands` set brand_title='$brand_title' where brand_id= $get_brand_id ";
    $result_brand_query = mysqli_query($con, $update_query);
    if ($result_brand_query) {
        echo "<script>
        alert('Brand updated successfully...!'),
        window.open('./index.php?view_brands','_self');
      </script>";
    }

}




?>