<?php
include ('./include/connect.php');


//getting products
function getProducts()
{
    global $con;
    // condition to check isset or not
    if (!isset($_GET['catagory'])) {
        if (!isset($_GET['brand'])) {

            $select_query = "select * from `products` order by rand() ";
            $result_query = mysqli_query($con, $select_query);
            // $row = mysqli_fetch_assoc($result_query);
            // echo $row['product_title'];
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_desp = $row['product_desp'];
                $catagory_id = $row['catagory_id'];
                $product_img1 = $row['product_img1'];
                $product_img2 = $row['product_img2'];
                $product_img3 = $row['product_img3'];
                $product_price = $row['product_price'];

                $date = $row['date'];

                echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./admin_area/product_img/$product_img1' class='card-img-top' alt=' $product_title'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_desp </p>
                <p class='card-text'>Price:$product_price/- </p>
                <a href='index.php?add_to_card=$product_id' class='btn btn-primary'>Add to Card</a>
                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
            </div>
        </div>
    </div>";

            }
        }
    }
}
// getting unique catagory

function getUniqueCatagory()
{
    global $con;
    // condition to check isset or not
    if (isset($_GET['catagory'])) {
        $catagory_id = $_GET['catagory'];
        $select_query = "select * from `products` where catagory_id= $catagory_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_row = mysqli_num_rows($result_query);
        if ($num_of_row == 0) {
            echo "<h2 class='text-center text-danger'>No stock for this catagory...!</h2>";
        }
        // $row = mysqli_fetch_assoc($result_query);
        // echo $row['product_title'];
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_desp = $row['product_desp'];
            $catagory_id = $row['catagory_id'];
            $product_img1 = $row['product_img1'];
            $product_price = $row['product_price'];
            $product_img2 = $row['product_img2'];
            $product_img3 = $row['product_img3'];
            $product_price = $row['product_price'];
            $date = $row['date'];

            echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./admin_area/product_img/$product_img1' class='card-img-top' alt=' $product_title'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_desp </p>
                <p class='card-text'>Price:$product_price/- </p>
                <a href='index.php?add_to_card=$product_id' class='btn btn-primary'>Add to Card</a>
                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
            </div>
        </div>
    </div>";

        }
    }
}

// getting unique brands 
function getUniqueBrands()
{
    global $con;
    // condition to check isset or not
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_query = "select * from `products` where brand_id= $brand_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_row = mysqli_num_rows($result_query);
        if ($num_of_row == 0) {
            echo "<h2 class='text-center text-danger'>This  brand is not avalable for sevice..!</h2>";
        }
        // $row = mysqli_fetch_assoc($result_query);
        // echo $row['product_title'];
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_desp = $row['product_desp'];
            $catagory_id = $row['catagory_id'];
            $product_img1 = $row['product_img1'];
            $product_img2 = $row['product_img2'];
            $product_img3 = $row['product_img3'];
            $product_price = $row['product_price'];

            $date = $row['date'];

            echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./admin_area/product_img/$product_img1' class='card-img-top' alt=' $product_title'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_desp </p>
                <p class='card-text'>Price:$product_price/- </p>
                <a href='index.php?add_to_card=$product_id' class='btn btn-primary'>Add to Card</a>
                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
            </div>
        </div>
    </div>";

        }
    }
}

// getting all product
function getAllProduct()
{
    global $con;
    // condition to check isset or not
    if (!isset($_GET['catagory'])) {
        if (!isset($_GET['brand'])) {

            $select_query = "select * from `products` order by rand() LIMIT 0,6";
            $result_query = mysqli_query($con, $select_query);
            // $row = mysqli_fetch_assoc($result_query);
            // echo $row['product_title'];
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_desp = $row['product_desp'];
                $catagory_id = $row['catagory_id'];
                $product_img1 = $row['product_img1'];
                $product_img2 = $row['product_img2'];
                $product_img3 = $row['product_img3'];
                $product_price = $row['product_price'];

                $date = $row['date'];

                echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./admin_area/product_img/$product_img1' class='card-img-top' alt=' $product_title'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_desp </p>
                <p class='card-text'>Price:$product_price/- </p>
                <a href='index.php?add_to_card=$product_id' class='btn btn-primary'>Add to Card</a>
                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
            </div>
        </div>
    </div>";

            }
        }
    }

}



//displaying side nav
function functionBrand()
{
    global $con;
    $select_brands = "select * from `brands`";
    $result_brands = mysqli_query($con, $select_brands);

    // $row_data = mysqli_fetch_assoc($result_brands);
    // echo $row_data['brand_title'];

    while ($row_data = mysqli_fetch_assoc($result_brands)) {
        $brand_title = $row_data['brand_title'];
        $brand_id = $row_data['brand_id'];
        echo "<li class='nav-item '>

        <a href='index.php ? brand=$brand_id' class='nav-link text-light'>
        $brand_title
        </a>
    </li>";

    }
}

function functionCatagory()
{
    global $con;
    $select_category = "select * from `catagories`";
    $result_category = mysqli_query($con, $select_category);//it can be use to perform a query (it can be contain 1 sql connection object and anothe variable which can be use to execute sql query).
    while ($row_data = mysqli_fetch_assoc($result_category)) {

        $catagory_title = $row_data['catagory_title'];
        $catagory_id = $row_data['catagory_id'];
        echo "<li class='nav-item '>

                        <a href='index.php ? catagory=$catagory_id' class='nav-link text-light'>
                         $catagory_title
                        </a>
                    </li>";
    }
}



//get searching product
function searchProduct()
{

    global $con;
    if (isset($_GET['search_data_product'])) {
        $search_dataValue = $_GET['search_data'];


        $search_query = "select * from `products` where product_keywords like '%$search_dataValue%'";
        $result_query = mysqli_query($con, $search_query);
        $num_of_row = mysqli_num_rows($result_query);
        if ($num_of_row == 0) {
            echo "<h2 class='text-center text-danger'>No result match ..No product found!</h2>";
        }
        // $row = mysqli_fetch_assoc($result_query);
        // echo $row['product_title'];
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_desp = $row['product_desp'];
            $catagory_id = $row['catagory_id'];
            $product_img1 = $row['product_img1'];
            $product_img2 = $row['product_img2'];
            $product_img3 = $row['product_img3'];
            $product_price = $row['product_price'];
            $date = $row['date'];

            echo "<div class='col-md-4 mb-2'>
        <div class='card'>
            <img src='./admin_area/product_img/$product_img1' class='card-img-top' alt=' $product_title'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_desp </p>
                <p class='card-text'>Price:$product_price/- </p>
                <a href='index.php?add_to_card=$product_id' class='btn btn-primary'>Add to Card</a>
                <a href='product_detail.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
            </div>
        </div>
    </div>";

        }
    }
}

//view deatails fuction 
function viewDetails()
{
    global $con;
    // condition to check isset or not
    if (isset($_GET['product_id'])) {
        if (!isset($_GET['catagory'])) {
            if (!isset($_GET['brand'])) {
                $productid = $_GET['product_id'];

                $select_query = "select * from `products` where product_id=$productid";
                $result_query = mysqli_query($con, $select_query);


                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_desp = $row['product_desp'];
                    $catagory_id = $row['catagory_id'];
                    $brand_id = $row['brand_id'];
                    $product_img1 = $row['product_img1'];
                    $product_img2 = $row['product_img2'];
                    $product_img3 = $row['product_img3'];
                    $product_price = $row['product_price'];

                    echo "<div class='col-md-4 mb-2'>
            <div class='card'>
                <img src='./admin_area/product_img/$product_img1' class='card-img-top' alt=' $product_title'>
                <div class='card-body'>
                    <h5 class='card-title'>$product_title</h5>
                    <p class='card-text'>$product_desp </p>
                    <p class='card-text'>Price:$product_price/- </p>
                    <a href='index.php?add_to_card=$product_id' class='btn btn-primary'>Add to Card</a>
                    <a href='index.php' class='btn btn-secondary'>Go Back</a>
                </div>
            </div>
        </div>
        <div class='col-md-8'>
                        <!-- relataid imgs-->
                        <div class='row'>
                            <div class='col-md-12'>
                                <h4 class='text-center mb-5'>Related Photos</h4>
                            </div>
                            <div class='col-md-6'>
                            <img src='./admin_area/product_img/$product_img2' class='card-img-top' alt=' $product_title'>
                            </div>
                            <div class='col-md-6'>
                                <img src='./admin_area/product_img/$product_img3' class='card-img-top' alt=' $product_title'>
                            </div>

                        </div>

                    </div>";

                }
            }
        }
    }
}

// get ip adress function
function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// card function 
function card()
{
    //when use if you want to stored data in card when the user is login 
    // if (!isset($_SESSION['username'])) {
    //     echo "<script> alert('please login')</script>";
    // } else {
    if (isset($_GET['add_to_card'])) {
        global $con;
        $get_ip_add = getIPAddress();
        $get_product_id = $_GET['add_to_card'];
        $select_query = "Select * from `card_details` where ip_address='$get_ip_add' and product_id=$get_product_id";

        $result_query = mysqli_query($con, $select_query);
        //use to check the card data
        $num_of_row = mysqli_num_rows($result_query);
        if ($num_of_row > 0) {
            echo "<script> alert('This item is already added in your card')</script>";
            echo "<script>window.open('index.php','_self') </script>";
        } else {
            $insert_query = "insert into `card_details`(product_id ,ip_address,quantity) values($get_product_id,'$get_ip_add',0)";
            echo "<script> alert('Item is added to card')</script>";
            $result_query = mysqli_query($con, $insert_query);
            echo "<script>window.open('index.php','_self') </script>";

        }
    }
}
//}

// functoin to get card item number
function cardItem()
{
    if (isset($_GET['add_to_card'])) {
        global $con;
        $get_ip_add = getIPAddress();

        $select_query = "Select * from `card_details` where ip_address='$get_ip_add'";

        $result_query = mysqli_query($con, $select_query);
        //use to check the card data
        $count_card_item = mysqli_num_rows($result_query);
    } else {
        global $con;
        $get_ip_add = getIPAddress();
        $select_query = "Select * from `card_details` where ip_address='$get_ip_add'";
        $result_query = mysqli_query($con, $select_query);
        $count_card_item = mysqli_num_rows($result_query);

    }
    echo $count_card_item;

}

// display total card price 
function totlePrice()
{

    global $con;
    $get_ip_add = getIPAddress();
    $totle_price = 0;
    $path_query = "Select * from `card_details` where ip_address='$get_ip_add'";
    $result_query = mysqli_query($con, $path_query);
    while ($row = mysqli_fetch_array($result_query)) {//one user can add mutiple item
        $product_id = $row['product_id'];
        $select_product = "Select * from `products` where  product_id='$product_id'";
        $result_Pro_query = mysqli_query($con, $select_product);
        while ($row_product_price = mysqli_fetch_array($result_Pro_query)) {
            $product_price = array($row_product_price['product_price']);
            $product_valaues = array_sum($product_price);
            $totle_price += $product_valaues;
        }
    }
    echo $totle_price;


}


// get user order details 
function get_user_order()
{
    global $con;
    $username = $_SESSION['username'];
    $get_detils = "Select * from `user_table` where user_name='$username'";
    $result_query = mysqli_query($con, $get_detils);

    while ($row_query = mysqli_fetch_array($result_query)) {
        $uer_id = $row_query['user_id'];

        if (!isset($_GET['Edit_account'])) {
            if (!isset($_GET['my_ordes'])) {
                if (!isset($_GET['delete_account'])) {
                    $get_orders = "Select * from `user_orders`  where user_id=$uer_id and order_status='pending'";
                    $result_order_query = mysqli_query($con, $get_orders);
                    $row_count = mysqli_num_rows($result_order_query);

                    if ($row_count > 0) {
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>" . $row_count . "</span> pending Orders<h3>
                      <p class='text-center'>  <a href='profile.php?my_ordes'>Order Details</a></p>";
                    } else {
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>zero</span> pending Orders<h3>
                        <p class='text-center'><a href='../index.php'>Explaore more product</a></p>";
                    }
                }
            }
        }
    }
}






?>