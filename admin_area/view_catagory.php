<h3 class="text-center text-success">All Categories</h3>
<table class="table table-bordered mt-5">
    <thead>
        <?php
        $get_catagory = "SELECT * FROM `catagories`";
        $catroy_result = mysqli_query($con, $get_catagory);
        $num_row = mysqli_num_rows($catroy_result);
        if ($num_row == 0) {
            echo "<h2 class='text-center text-danger'>No categories inserted...!</h2>";
        } else {
            echo "<tr class='text-center'>
                <th>slno</th>
                <th>Category Title</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>";
        }
        ?>
    </thead>
    <tbody>
        <?php
        $num = 0;
        while ($row = mysqli_fetch_assoc($catroy_result)) {
            $catagory_title = $row['catagory_title'];
            $catagory_id = $row['catagory_id'];
            $num++;
        ?>
            <tr class="text-center">
                <td><?php echo $num ?></td>
                <td><?php echo $catagory_title ?></td>
                <td><a href='index.php?edit_catagory=<?php echo $catagory_id ?>'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td><a href='#' type="button" data-toggle="modal" data-target="#exampleModalCenter<?php echo $catagory_id ?>"><i class='fa-solid fa-trash'></i></a></td>
            </tr>
            <div class="modal fade" id="exampleModalCenter<?php echo $catagory_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4>Are you sure you want to delete this category?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary"><a href='index.php?delete_catagory=<?php echo $catagory_id ?>' class="text-light text-decoration-none">Yes</a></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </tbody>
</table>

