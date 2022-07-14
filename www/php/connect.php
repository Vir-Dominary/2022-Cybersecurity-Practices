<?php   //此文件用于链接数据库和声明弹窗
    header('Content-Type:text/html;charset=utf-8');//头部文件声明

    //连接数据库
    $servername='localhost';
    $username='root1';
    $password='123456';
    $dbname='www';
    $con=mysqli_connect($servername,$username,$password,$dbname);//创建连接
    //验证数据库连接
    if(!$con){
        die('Fail to connect database server:'.mysqli_connect_error());
    }
    
    //定义弹窗
    function alert($str,$url){
        echo '<script> alert("'.$str.'");location.href="'.$url.'";</script>';
    }
    //建立会话，接收登陆界面传来的数据
    session_start();
?>