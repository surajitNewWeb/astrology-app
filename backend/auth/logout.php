<?php
// backend/auth/logout.php
session_start();
session_unset();
session_destroy();
header("Location: ../../public/login.php");
exit();
