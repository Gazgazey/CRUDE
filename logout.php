<?php
session_start();
session_unset(); // Clears all session variables
session_destroy(); // Completely destroys the session
header("Location: login.php"); // Redirect to login page
exit();
