<?php
    include('connect.php'); //连接数据库

    $username=$_POST['username'];
    $password=$_POST['password'];  //接收用户名密码

    //验证登录
    $sql="SELECT * from user where username='$username' and password='$password'"; //读取数据库信息
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){ //验证
        $_SESSION['username']=$username;
        alert('登陆成功！','home.php'); //home.php个人主页
    }
    else{
        alert('登陆失败，请重新确认用户名密码','../index.html');
    }
?>