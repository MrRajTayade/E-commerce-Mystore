<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paid Payments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .modal-footer .btn {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h2 class="text-center text-success">Paid Payments</h2>
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th>Payment No</th>
                <th>Due Amount</th>
                <th>Invoice No</th>
                <th>Total Products</th>
                <th>Order Date</th>
                <th>Payment Type</th>
                <th>Status</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php
            $get_paid_payment = "SELECT * FROM `confirm_payment`";
            $result_payment = mysqli_query($con, $get_paid_payment);
            $num = 0;
            while ($row_count = mysqli_fetch_array($result_payment)) {
                $order_id = $row_count['order_id'];
                $invoice_no = $row_count['invoice_no'];
                $totle_products = $row_count['totle_products'];
                $amount = $row_count['amount'];
                $date = $row_count['date'];
                $status = $row_count['stetuse'];
                $payment_mode = $row_count['payment_mode'];
                $num++;
                echo "<tr>
                    <td>$num</td>
                    <td>$amount</td>
                    <td>$invoice_no</td>
                    <td>$totle_products</td>
                    <td>$date</td>
                    <td>$payment_mode</td>
                    <td>$status</td>
                    <td><a href='#' type='button' class='' data-toggle='modal' data-target='#deleteModal$order_id'><i class='fa-solid fa-trash'></i></a></td>
                </tr>
                <div class='modal fade' id='deleteModal$order_id' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h4>Are you sure you want to delete this payment?</h4>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
                                <button type='button' class='btn btn-primary'><a href='index.php?delete_paid_payment=$order_id' class='text-light text-decoration-none'>Yes</a></button>
                            </div>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </tbody>
    </table>

    <!-- Include jQuery and Bootstrap JavaScript for modal functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>
