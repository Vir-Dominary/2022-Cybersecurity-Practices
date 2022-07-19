<?php
    include('connect.php');
    
    $addr=$_POST['address'];
    $user=$_SESSION['username'];
    
    $sql="DELETE from image where address='$addr'";
    mysqli_query($con, $sql);
    
    if(mysqli_query($con, $sql) && unlink($addr)){ //删除服务器和数据库中图片的痕迹
        alert("删除成功", "home.php");
    }
    else{
        alert("删除失败", "home.php");
    }
    
    