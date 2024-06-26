<?php




include ('../include/connect.php');
if (isset($_POST['insert_cat'])) {
    $catagory_title = $_POST['cat_title'];

    //  select data from database
    $select_query = "select * from `catagories`  where 
catagory_title='$catagory_title'";
    $result_select = mysqli_query($con, $select_query);
    $numbers = mysqli_num_rows($result_select);


    
    
    if ($numbers > 0 ) {
        echo "<script>
    alert('This catagory is already inserted ')
    </script>";

    } else {




        $inser_query = "insert into `catagories`(catagory_title) values('$catagory_title')";
        $result = mysqli_query($con, $inser_query);
        if ($result) {
            echo "<script>
        alert('category has been inserted sucessfully')
        </script>";
        }
    }
    }

?>
<h2 class="text-center">Insert Catagories</h2>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert catagories" aria-label="catagories"
            aria-describedby="basic-addon1" required="required">
    </div>
    <div class="input-group w-10 mb-2 m-auto">


        <input type="submit" class="  bg-info border-0 p-2 my-3" name="insert_cat" value="Insert catagories ">
        <!-- <button class=" bg-info p-2 my-3 border-0">Insert catagories</button> -->
    </div>
</form>