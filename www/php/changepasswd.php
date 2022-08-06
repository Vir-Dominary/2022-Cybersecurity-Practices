<?php

    include('connect.php');
    $username=mysqli_real_escape_string($con,$_SESSION["username"]);
    require 'home.php';
    $username=$_SESSION['username'];
    if(!$username){
        alert('请登陆后使用此功能','../index.html');
        session_destroy();
        exit();
    }
    $username=mysqli_real_escape_string($con,$_SESSION['username']);
    $npassword=mysqli_real_escape_string($con,$_POST['npassword']);
    $cpassword=mysqli_real_escape_string($con,$_POST['cpassword']);
    $npassword=$_POST['npassword'];
    $cpassword=$_POST['cpassword'];

    if($npassword==NULL||$cpassword==NULL){//校验输入内容
        alert('密码不可为空，请重新输入','../change.html');
    }
    else if($npassword!=$cpassword){
        alert('两次密码输入不一致，请重新输入','../change.html');
    }
    else{//执行
        try {
            $userInfo = getUserInfoInDb($username);
            if(!empty($userInfo)){
                $check = changePassword($username,$npassword); 
                if($check){
                    alert('修改密码成功，请重新登录','../index.html');
                    session_destroy();
                }
                else{
                    alert('密码修改失败，将重定向回主页','./php/home.php');
                    exit();
                }
            }
            else{
                alert('获取用户信息失败','../index.html');
            }
        } catch(PDOException $e) {
            throw $e;
        }
    }
?>