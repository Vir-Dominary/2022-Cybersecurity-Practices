<?php
    include('connect.php');
    $username=$_POST['username'];
    $question=$_POST['question'];
    $answer=$_POST['answer'];
    $sql="SELECT question FROM user WHERE username='$username'AND question='$question'";
    $check=mysqli_query($con, $sql);
    if(mysqli_num_rows($check)==0){
        alert('密保问题不正确','../reset.html');
    }
    else if($answer==NULL||$username==NULL){
        alert('用户名或密保答案不能为空','../reset.html');
    }
    $sql="SELECT * FROM user WHERE username='$username' AND answer ='$answer'";
    $check=mysqli_query($con, $sql);
    if(mysqli_num_rows($check)==0){
        alert('密保答案错误','../reset.html');
    }
    else{
        $sql="UPDATE user SET password='123456' WHERE username='$username'";
        if(mysqli_query($con, $sql)){
            alert('密码已重置为123456，请重新登录，登录后请及时修改密码！','../index.html');
        }
        else{
            alert('密码重置失败！将重新返回登录页面','../index.html');
        }
    }
?>