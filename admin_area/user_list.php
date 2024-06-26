<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .modal-footer .btn {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h3 class="text-center text-success">User List</h3>
    <table class="table table-bordered mt-3">
        <thead class="text-center">
            <?php
            $get_user = "SELECT * FROM `user_table`";
            $user_result = mysqli_query($con, $get_user);
            $count_row = mysqli_num_rows($user_result);
            if ($count_row == 0) {
                echo "<h2 class='text-center text-danger'>No Users Registered...!</h2>";
            } else {
                echo "<tr>
                    <th>User No</th>
                    <th>User Name</th>
                    <th>Email ID</th>
                    <th>User Address</th>
                    <th>Contact No</th>
                    <th>Delete</th>
                </tr>";
            }
            ?>
        </thead>
        <tbody class="text-center">
            <?php
            $num = 0;
            while ($row = mysqli_fetch_assoc($user_result)) {
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_address = $row['user_address'];
                $user_no = $row['user_no'];
                $user_email = $row['user_email'];
                $num++;
                echo "<tr>
                    <td>$num</td>
                    <td>$user_name</td>
                    <td>$user_email</td>
                    <td>$user_address</td>
                    <td>$user_no</td>
                    <td><a href='#' type='button' class='' data-toggle='modal' data-target='#deleteModal$user_id'><i class='fa-solid fa-trash'></i></a></td>
                </tr>
                <div class='modal fade' id='deleteModal$user_id' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <h4>Are you sure you want to delete this user?</h4>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>No</button>
                                <button type='button' class='btn btn-primary'><a href='index.php?delete_user=$user_id' class='text-light text-decoration-none'>Yes</a></button>
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

