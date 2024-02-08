<?php
include_once 'connection.php';
$del="DELETE FROM `cart` where `oid`='$oid'";
$delres=$conn->query($del);
header("Location:index.php");
?>