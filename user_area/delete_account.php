<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Delete Account</title>
</head>

<body>

    <h3 class="text-center text-success mb-4">Delete Account</h3>
    <form id="deleteForm" action="" method="post" class="mt-5">
        <div class="form-outline mb-5">
            <button type="button" class="form-control w-50 mt-5 m-auto text-danger" data-toggle="modal"
                data-target="#confirmModal">Delete Account</button>
        </div>
        <div class="form-outline">
            <input type="submit" class="form-control w-50 m-auto mt-5" name="dont_delete" value="Don't Delete Account">
        </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h4>Are you sure you want to delete your account?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    //session_start();  // Ensure session is started
    include ('../include/connect.php');  // Ensure connection to the database
    
    $username_session = $_SESSION['username'];

    if (isset($_POST['delete'])) {
        $delete_query = "DELETE FROM `user_table` WHERE user_name='$username_session'";
        $result = mysqli_query($con, $delete_query);
        if ($result) {
            session_destroy();
            echo "<script>alert('Account deleted successfully'); window.open('../index.php','_self');</script>";
        } else {
            echo "<script>alert('Error deleting account');</script>";
        }
    }

    if (isset($_POST['dont_delete'])) {
        echo "<script>window.open('profile.php','_self');</script>";
    }
    ?>

    <!-- JavaScript dependencies for Bootstrap -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script> -->

    <script>
        document.getElementById('confirmDelete').addEventListener('click', function () {
            // Set a hidden input to indicate deletion
            const form = document.getElementById('deleteForm');
            let deleteInput = document.createElement('input');
            deleteInput.type = 'hidden';
            deleteInput.name = 'delete';
            deleteInput.value = 'true';
            form.appendChild(deleteInput);
            form.submit();
        });
    </script>

</body>

</html>