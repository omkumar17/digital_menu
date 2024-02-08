<?php
include_once 'connection.php';

$count="SELECT COUNT('id') FROM `menu`";
// $menu="SELECT * FROM `menu`";
$cres=$conn->query($count);
// $menur=$conn->query($menu);
$crow=$cres->fetch_assoc();

$len=$crow["COUNT('id')"];
echo $len;
if(isset($_GET['hid'])){
    $i=1;
    while($i<=$len){
    // $s="size".$i;
    $f="full".$i;
    $h="half".$i;
    $q="qty".$i;
    if(isset($_GET[$q])){
        if(isset($_GET[$f])){
            $size=$_GET[$f];
        }
       else if(isset($_GET[$h])){
            $size=$_GET[$h];
        }
    // $size=$_GET[$s];
    $qty=$_GET[$q];
    $id=$i;
    echo $qty;
    if($qty!=0 && $qty!=""){
        $sql1="INSERT INTO `cart`(`size`, `qty`, `oid`, `pid`) VALUES ('$size','$qty','$oid','$id')";
        $res=$conn->query($sql1);
    }
}
    $i=$i+1;
}
header("Location:index.php?flag=1");
}
?>