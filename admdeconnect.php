<?php
session_start();
include_once("include/koneksyon.php");
unset($_SESSION["admin"]);
header("Location:loginadm.php");
?>