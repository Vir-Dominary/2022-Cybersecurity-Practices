<?php
    include('connect.php'); //连接数据库
    ob_start();
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        doRegister($_POST);
    }
    //接收注册界面传来的数据
    /*
    $username=$_POST['username'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    $question=$_POST['question'];
    $answer=$_POST['answer'];
    */
    //数据库图片总文件夹
    /*
    //确认密码
    if($username==NULL||$password==NULL||$cpassword==NULL){
        alert('用户名或密码不可为空，请重新输入','../register.html');
    }
    else if($password!=$cpassword){
        alert('两次输入密码不一致，请重新输入','../register.html');
    }
    else if(mysqli_num_rows($check)>0){
        alert('用户名已存在，请重新输入','../register.html');
    }
    else if($answer==NULL){
        alert('密保答案不可为空','../register.html');
    }
    else{
        $sql="INSERT into user(username,password,question,answer) values('$username','$password','$question','$answer')";
        mkdirs($imgaddr, $username); //在image下建立以该用户为名称的文件夹用于存储上传的图片
        if(mysqli_query($con,$sql)){
            alert('注册成功，请重新登录','../index.html');
        }
    }
*/


function doRegister($postArr)
    {
        $userName = $postArr['username'];
        $password = $postArr['password'];
        $question = $postArr['question'];
        $answer = $postArr['answer'];
        $cpassword = $postArr['cpassword'];
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $hashedAnswer = password_hash($answer,PASSWORD_DEFAULT);
        $imgaddr='../image/'; 
        if($userName==NULL||$password==NULL||$cpassword==NULL){
            alert('用户名或密码不可为空，请重新输入','../register.html');
            exit();
        }
        else if($password!=$cpassword){
            alert('两次输入密码不一致，请重新输入','../register.html');
            exit();
        }
        else if($answer==NULL){
            alert('密保答案不可为空','../register.html');
            exit();
        }
        try {
            // 检查用户名是否可用
            if(empty(checkRegisterInDb($userName))) {
              // 用户注册信息数据库写入操作
            $check = registerInDb($userName, $hashedPassword,$question,$hashedAnswer);
            mkdirs($imgaddr,$userName);
            if(empty($check)) {
                // 如果注册失败，则设置相应的错误提示信息，否则，默认只显示注册成功消息和对应的DIV片段代码
                alert('注册失败，我也不知道出了什么问题（摊手）','../register.html');
                exit();
            }
        }
        else {
              //用户名重复
            alert('用户名已经存在！','../register.html');
            exit();
        }
    }catch(Exception $e) {
            throw $e;
    }
}
    

?>