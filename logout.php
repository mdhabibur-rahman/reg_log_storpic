<?php
session_start();

// Destroy the session to log out
session_unset();
session_destroy();

echo "You have been logged out. <a href='login.php'>Login again</a>";
?>
