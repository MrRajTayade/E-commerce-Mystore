<?php
include ('../include/connect.php');
// session_start();

$uername = $_SESSION['username'];
$get_user = "SELECT * FROM `user_table` WHERE user_name='$uername'";
$result_query = mysqli_query($con, $get_user);
$row_fetch = mysqli_fetch_assoc($result_query);
$user_id = $row_fetch['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All My Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>

    <h3 class="text-center text-success">All my orders</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info text-center">
            <?php
            $get_order_details = "SELECT * FROM `user_orders` WHERE user_id=$user_id";
            $result_orders_query = mysqli_query($con, $get_order_details);
            $row_count = mysqli_num_rows($result_orders_query);

            if ($row_count == 0) {
                echo "<h3 class='text-center text-danger mt-5'>Not ordered.....!</h3>";
            } else {
                echo "<tr>
                    <th>Sl No</th>
                    <th>Amount Dues</th>
                    <th>Total Products</th>
                    <th>Invoice Numbers</th>
                    <th>Date</th>
                    <th>Complete/Incomplete</th>
                    <th>Status</th>
                    <th>Delete</th>
                </tr>";
            }
            ?>
        </thead>
        <tbody class="text-center">
            <?php
            $number = 1;
            while ($row_ordes = mysqli_fetch_assoc($result_orders_query)) {
                $order_id = $row_ordes['order_id'];
                $order_amount = $row_ordes['amount'];
                $totle_products = $row_ordes['totle_products'];
                $invoice_no = $row_ordes['invoice_no'];
                $order_date = $row_ordes['order_date'];
                $order_status = $row_ordes['order_status'];
                $order_payment = $row_ordes['order_payment'];

                if ($order_status === 'pending') {
                    $order_status = "Incomplete";
                } else {
                    $order_status = "Complete";
                    $order_payment = "payment Paid";
                }
                ?>
                <tr>
                    <td><?php echo $number ?></td>
                    <td><?php echo $order_amount ?></td>
                    <td><?php echo $totle_products ?></td>
                    <td><?php echo $invoice_no ?></td>
                    <td><?php echo $order_date ?></td>
                    <td><?php echo $order_status ?></td>
                    <td>
                        <?php
                        if ($order_payment === '') {
                            echo "<a href='confirm_pyment.php?order_id=$order_id' class='text-decoration-none'>Confirm</a>";
                        } else {
                            echo "Paid";
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($order_payment === '') {
                            echo "<a href='' type='button' data-toggle='modal' data-target='#deleteModal' data-orderid='$order_id'><i class='fa-solid fa-trash'></i></a>";
                        } else {
                            echo "Paid";
                        }
                        ?>
                    </td>
                </tr>
                <?php
                $number++;
            }
            ?>
        </tbody>
    </table>

    <!-- Delete confirmation modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Are you sure you want to delete your Order?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hidden form for deletion -->
    <form id="deleteForm" method="POST" action="delete_order.php">
        <input type="hidden" name="order_id" id="order_id">
    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var orderId = button.data('orderid');
            var modal = $(this);
            modal.find('#confirmDelete').data('orderid', orderId);
        });

        document.getElementById('confirmDelete').addEventListener('click', function () {
            var orderId = $(this).data('orderid');
            document.getElementById('order_id').value = orderId;
            document.getElementById('deleteForm').submit();
        });
    </script>
</body>

</html>
