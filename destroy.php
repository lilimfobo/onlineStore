<!-- Added function to successfully logout -->

<?php
session_start();
unset($_SESSION['user']);
session_destroy();
header("location: index.php?Message=" . "Successfully logged out!");
?>

