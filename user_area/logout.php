<?php
session_start();
session_unset();
session_destroy();

echo "<script>alert('logout sucessfully')
window.open('../index.php','_self')</script>";
?>