<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <style>
        .img {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <h3 class="text-success text-center">All products</h3>
    <table class="table table-bordered mt-5">
        <thead class="text-light bg-info text-center">
            <?php
            $get_product = "SELECT * FROM `products`";
            $result_query = mysqli_query($con, $get_product);
            $num_row = mysqli_num_rows($result_query);
            if ($num_row == 0) {
                echo "<h2 class='text-center text-danger'>No Product inserted...!</h2>";
            } else {
                echo "<tr>
                    <th>Product Id</th>
                    <th>Product Title</th>
                    <th>Product Img</th>
                    <th>Product Price</th>
                    <th>Total Sold</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>";
            }
            ?>
        </thead>
        <tbody class="bg-secondary text-light text-center">
            <?php
            $num = 0;
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_img1 = $row['product_img1'];
                $product_price = $row['product_price'];
                $product_statuse = $row['statuse'];
                $get_count = "SELECT * FROM `order_pending` WHERE product_id=$product_id";
                $result_count_query = mysqli_query($con, $get_count);
                $row_count = mysqli_num_rows($result_count_query);
                echo "<tr>
                    <td>$product_id</td>
                    <td>$product_title</td>
                    <td><img src='./product_img/$product_img1' alt='not found' class='img'></td>
                    <td>$product_price</td>
                    <td>$row_count</td>
                    <td>$product_statuse</td>
                    <td><a href='index.php?edit_products=$product_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
                    <td><a href='#' type='button' class='' data-toggle='modal' data-target='#exampleModalCenter$product_id'><i class='fa-solid fa-trash'></i></a></td>
                </tr>";
                echo "<div class='modal fade' id='exampleModalCenter$product_id' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h4>Are you sure you want to delete this product?</h4>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
                                <button type='button' class='btn btn-primary'><a href='index.php?delete_products=$product_id' class='text-light text-decoration-none'>Yes</a></button>
                            </div>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
