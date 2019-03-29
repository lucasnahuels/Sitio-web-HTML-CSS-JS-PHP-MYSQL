<?php
session_start();

unset($_SESSION['logingym']);
header("location: logingym.php");
?>