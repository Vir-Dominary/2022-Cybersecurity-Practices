<?php
    include('connect.php');
    $username=$_SESSION["username"];
    if(!$username){
        alert('请登陆后使用此功能','../index.html');
        exit();
    }
    $username=$_SESSION['username'];
    $npassword=$_POST['npassword'];
    $cpassword=$_POST['cpassword'];

    if($npassword==NULL||$cpassword==NULL){
        alert('密码不可为空，请重新输入','../change.html');
    }
    else if($npassword!=$cpassword){
        alert('两次密码输入不一致，请重新输入','../change.html');
    }
    else{
        $sql="UPDATE user SET password = '$npassword' where username='$username'"; //读取数据库信息
        if(mysqli_query($con,$sql)){
            alert('修改密码成功，请重新登录','../index.html');
        }
        else{
            alert('密码修改失败，将重定向回主页','/home.php');
        }
    }
    
?>