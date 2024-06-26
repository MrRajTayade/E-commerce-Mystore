<div class="container mt-3">
    <h3 class="text-center text-success mt-3"> Edite Categories</h3>
    <form action="" method="post" class="text-center">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="catagory_title" class="form-lable">Catagory title </label>
            <input type="text" name="catagory_title" id="catagory_title" class="form-control " required="required"
                value="<?php

                // To display data 
                if (isset($_GET['edite_catagory'])) {
                    $get_id = $_GET['edite_catagory'];

                    $get_catagory = "Select * from `catagories` where catagory_id= $get_id ";
                    $result_catagory = mysqli_query($con, $get_catagory);
                    $row = mysqli_fetch_assoc($result_catagory);
                    $catagory_title = $row['catagory_title'];
                    echo $catagory_title;
                }




                ?>">
        </div>
        <input type="submit" value="Update catagory" name="edit_catagory" class="bg-info border-0 m-2 p-2 ">


    </form>

</div>



<?php

if (isset($_POST['edit_catagory'])) {
    $cat_title = $_POST['catagory_title'];
    $updte_query = "update  `catagories` set catagory_title='$cat_title' where catagory_id= $get_id ";
    $result_catagory_update = mysqli_query($con, $updte_query);
    if ($result_catagory_update) {
        echo "<script>
                alert('Category updated successfully...!');
                window.open('./index.php?view_catagories','_self');
              </script>";
    }

}

?>