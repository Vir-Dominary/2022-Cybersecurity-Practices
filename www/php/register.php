<?php
    include('connect.php'); //连接数据库

    //接收注册界面传来的数据
    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $check=mysqli_query($con,"SELECT * from user where username='$username'"); 

    $imgaddr='../image/'; //数据库图片总文件夹
    
    //确认密码
    if($username==NULL||$password==NULL||$cpassword==NULL){
        alert('用户名密码不可为空，请重新输入','../register.html');
    }
    else if($password!=$cpassword){
        alert('两次输入密码不一致，请重新输入','../register.html');
    }
    else if(mysqli_num_rows($check)>0){
        alert('用户名已存在，请重新输入','../register.html');
    }
    else{
        $sql="INSERT into user(username,password) values('$username','$password')";
        mkdirs($imgaddr, $username); //在image下建立以该用户为名称的文件夹用于存储上传的图片
        if(mysqli_query($con,$sql)){
            alert('注册成功，请重新登录','../index.html');
        }
    }
?>