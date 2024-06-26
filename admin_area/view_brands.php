<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Brands</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <h3 class="text-center text-success">All Brands</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <?php
            $get_brands = "SELECT * FROM `brands`";
            $brands_result = mysqli_query($con, $get_brands);
            $num_row = mysqli_num_rows($brands_result);
            if ($num_row == 0) {
                echo "<h2 class='text-center text-danger'>No Brands inserted...!</h2>";
            } else {
                echo "
                <tr class='text-center'>
                    <th>Slno</th>
                    <th>Brand</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>";
            }
            ?>
        </thead>
        <tbody>
            <?php
            $num = 0;
            while ($row = mysqli_fetch_array($brands_result)) {
                $brand_id = $row['brand_id'];
                $brand_title = $row['brand_title'];
                $num++;
                echo "
                <tr class='text-center'>
                    <td>$num</td>
                    <td>$brand_title</td>
                    <td><a href='index.php?edit_brand=$brand_id'><i class='fa-solid fa-pen-to-square'></i></a></td>
                    <td><a href='#' type='button' class='' data-toggle='modal' data-target='#deleteModal$brand_id'><i class='fa-solid fa-trash'></i></a></td>
                </tr>
                <div class='modal fade' id='deleteModal$brand_id' tabindex='-1' role='dialog' aria-labelledby='deleteModalTitle' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h4>Are you sure you want to delete this brand?</h4>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
                                <button type='button' class='btn btn-primary'><a href='index.php?delete_brand=$brand_id' class='text-light text-decoration-none'>Yes</a></button>
                            </div>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </tbody>
    </table>

    <!-- Modal for Deletion -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this brand?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary"><a href='#' class="text-light text-decoration-none">Yes</a></button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
