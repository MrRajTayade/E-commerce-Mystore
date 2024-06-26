<?php
include ('../include/connect.php');
if (isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title'];

    //  select data from database
    $select_query = "select * from `brands`  where 
    brand_title	='$brand_title'";
    $result_select = mysqli_query($con, $select_query);
    $numbers = mysqli_num_rows($result_select);
    if ($numbers > 0) {
        echo "<script>
    alert('This Brand is already inserted ')
    </script>";

    } else {




        $inser_query = "insert into `brands`(brand_title) values('$brand_title')";
        $result = mysqli_query($con, $inser_query);
        if ($result) {
            echo "<script>
        alert('Brands has been inserted sucessfully')
        </script>";
        }
    }

}
?>
<h2 class="text-center">Insert Brands</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" id="brand" placeholder="Insert Brands"
            aria-label="brands" aria-describedby="basic-addon1" required="required">
    </div>
    <div class="input-group w-10 mb-2 m-auto">


        <input type="submit" class="  bg-info border-0 p-2 my-3" name="insert_brand" id="insert_brand"
            value="Insert Brands">
        <!-- <button class=" bg-info p-2 my-3 border-0">Insert Brands</button> -->
    </div>


</form>





<!-- <script>
        document.getElementById("brand").addEventListener("click",
            function (event) {
                var brand_input = document.getElementById("insert_brand").value;
                if (brand_input.trim())=== ""{
                    event.preventDefault();
                    alert("Plase insert values");

                }
            }
        );



    </script> -->