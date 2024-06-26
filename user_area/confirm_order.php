<?php
include ('../include/connect.php');
// session_start();
?>
<h3 class="text-center text-success">Confirm Orders</h3>
<table class="table table-bordered ">
    <thead class=" text-center">
        <tr>
            <th>SldNo</th>
            <th>Invoice numbers</th>
            <th>Totale products</th>
            <th>Amount </th>
            <th>Date</th>
            <th>Status</th>


        </tr>

    </thead>
    <tbody class="text-center">
        <?php
        $get_confirm_order = "Select * from `confirm_payment`";
        $result_confirm_order = mysqli_query($con, $get_confirm_order);
        $num = 0;
        while ($row = mysqli_fetch_assoc($result_confirm_order)) {
            $order_id = $row['order_id'];
            $invoice_no = $row['invoice_no'];
            $amount = $row['amount'];
            $payment_mode = $row['payment_mode'];
            $date = $row['date'];
            $stetuse = $row['stetuse'];
            $totle_products = $row['totle_products'];

            $num++;

            ?>
            <tr>

                <td><?php echo $num ?></td>
                <td><?php echo $invoice_no ?></td>
                <td><?php echo $totle_products ?></td>
                <td><?php echo $amount ?> </td>
                <td><?php echo $date ?></td>

                <td><?php echo $stetuse ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>



</table>