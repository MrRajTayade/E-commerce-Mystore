<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Payments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .modal-footer .btn {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h3 class="text-center text-success">All Payments</h3>
    <table class="table table-bordered mt-3">
        <thead class="text-center">
            <?php
            $get_amunt = "SELECT * FROM `user_payment`";
            $get_result = mysqli_query($con, $get_amunt);
            $row_count = mysqli_num_rows($get_result);
            if ($row_count == 0) {
                echo "<h2 class='text-center text-danger'>No Payment yet...!</h2>";
            } else {
                echo "<tr>
                    <th>PayId</th>
                    <th>Invoice No</th>
                    <th>Amount</th>
                    <th>Date/Time</th>
                    <th>Payment Mode</th>
                    <th>Delete</th>
                </tr>";
            }
            ?>
        </thead>
        <tbody class="text-center">
            <?php
            $num = 0;
            while ($row = mysqli_fetch_assoc($get_result)) {
                $payment_id = $row['payment_id'];
                $invoice_no = $row['invoice_no'];
                $amount = $row['amount'];
                $payment_mode = $row['payment_mode'];
                $date = $row['date'];
                $num++;
                echo "<tr>
                    <td>$num</td>
                    <td>$invoice_no</td>
                    <td>$amount</td>
                    <td>$date</td>
                    <td>$payment_mode</td>
                    <td><a href='#' type='button' class='' data-toggle='modal' data-target='#deleteModal$payment_id'><i class='fa-solid fa-trash'></i></a></td>
                </tr>
                <div class='modal fade' id='deleteModal$payment_id' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h4>Are you sure you want to delete this payment?</h4>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
                                <button type='button' class='btn btn-primary'><a href='index.php?delete_payment=$payment_id' class='text-light text-decoration-none'>Yes</a></button>
                            </div>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this payment?</h4>
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