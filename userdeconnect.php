<?php
session_start();
include_once("include/koneksyon.php");
unset($_SESSION["user"]);
header("Location:index.php");
?>