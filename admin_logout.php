<?php
session_start();
session_destroy();
header("Location: lecturer_login.php");

?>