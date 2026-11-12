<?php
    session_start();       // 1. Find the session
    session_unset();       // 2. Clear all variables
    session_destroy();     // 3. Destroy the session completely
    
    // 4. Redirect user back to the Home Page
    header("Location: index.php");
    exit();
?>