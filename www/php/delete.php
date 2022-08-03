<?php
    include('connect.php');
    session_start();
    $addr=$_POST['address'];
    $username=$_SESSION["username"];
    $sql="SELECT * from image where address='$addr' && username='$username'";
    if(!mysqli_query($con, $sql)){
        echo"<script>alert('你无权删除此文件');</script>";
        header('Location: ../index.html'); //跳转登录页面
        session_abort();
        exit();
    }
    $sql="DELETE from image where address='$addr'";
    mysqli_query($con, $sql);
    
    if(mysqli_query($con, $sql) && unlink($addr)){ //删除服务器和数据库中图片的痕迹
        alert("删除成功", "home.php");
    }
    else{
        alert("删除失败", "home.php");
    }
    
    


