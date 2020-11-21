<?php
session_start();

// remove all session variables
session_unset();
// destroy the session
session_destroy();

echo "<META HTTP-EQUIV=Refresh content=0;URL=login.php>";
