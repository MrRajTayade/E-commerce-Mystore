<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .modal-footer .btn {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h3 class="text-center text-success">Order list</h3>
    <table class="table table-bordered mt-3">
        <thead class="bg-info">
            <?php
            $get_data = "SELECT * FROM `user_orders`";
            $result = mysqli_query($con, $get_data);
            $row_count = mysqli_num_rows($result);
            if ($row_count == 0) {
                echo "<h2 class='bg-danger text-center'>No orders yet</h2>";
            } else {
                echo "<tr class='text-center'>
                    <th>Sl No</th>
                    <th>Due Amount</th>
                    <th>Invoice No</th>
                    <th>Total Products</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Delete</th>
                </tr>";
            }
            ?>
        </thead>
        <tbody class="text-center">
            <?php
            $num = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $amount = $row_data['amount'];
                $invoice_no = $row_data['invoice_no'];
                $totle_products = $row_data['totle_products'];
                $order_date = $row_data['order_date'];
                $order_status = $row_data['order_status'];
                $num++;
                echo "<tr>
                    <td>$num</td>
                    <td>$amount</td>
                    <td>$invoice_no</td>
                    <td>$totle_products</td>
                    <td>$order_date</td>
                    <td>$order_status</td>
                    <td><a href='#' type='button' class='' data-toggle='modal' data-target='#deleteModal$order_id'><i class='fa-solid fa-trash'></i></a></td>
                </tr>
                <div class='modal fade' id='deleteModal$order_id' tabindex='-1' role='dialog' aria-labelledby='deleteModalTitle' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h4>Are you sure you want to delete this order?</h4>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
                                <button type='button' class='btn btn-primary'><a href='index.php?delete_order=$order_id' class='text-light text-decoration-none'>Yes</a></button>
                            </div>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this order?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary"><a href='#'
                            class="text-light text-decoration-none">Yes</a></button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>