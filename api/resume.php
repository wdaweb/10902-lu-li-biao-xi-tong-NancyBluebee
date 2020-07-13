<?php
include_once "db_info.php";

function randomnum($length) {
    global $pdo;
    $num="";
    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz   
               ABCDEFGHIJKLOMNOPQRSTUVWXYZ";  
    for($i=0;$i<$length;$i++) {   
        $num .= $pattern{mt_rand(0,35)}; 
    }
    $page=hash("sha256", $num);
    $id=$_SESSION['id'];
    $sql="UPDATE `user` SET `page`='$page' WHERE `id`='$id'";
    // echo $sql;
    $pdo->exec($sql);
    return $page;
}   

$p=randomnum(8);

header("location:../myresume.php?p=$p");

?>