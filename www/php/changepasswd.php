<?php
    include('connect.php');
    $username=$_SESSION["username"];
    if(!$username){
        alert('请登陆后使用此功能','../index.html');
        session_abort();
        exit();
    }
    $username=$_SESSION['username'];
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
            $userInfo = getUserInfoInDb($name);
            if(!empty($userInfo)){
                $check = changePassword($username,$npassword); //读取数据库信息
                if($check){
                    alert('修改密码成功，请重新登录','../index.html');
                    session_abort();
                    exit();
                }
                else{
                    alert('密码修改失败，将重定向回主页','/home.php');
                    exit();
                }
            }
            else{
                echo"<script>alert('获取用户信息失败');</script>";
            }
        } catch(PDOException $e) {
            throw $e;
        }
    }
?>