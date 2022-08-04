<?php
    include('connect.php'); //连接数据库
    session_start();

    //验证登录
    try {
        $conn = connect();
        $sql = "select * from user where username=:username and password=:password";
        $username=$_POST['username'];
        $password=$_POST['password'];  //接收用户名密码
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password',$password);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $check = isset($result['password']) ? $result['password'] : '';
    } catch(PDOException $e) {
        throw $e;
    }

    //读取数据库信息
    /*
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){ //验证
        $_SESSION['username']=$username;
        alert('登陆成功！','home.php'); //home.php个人主页
    }
    else{
        alert('登陆失败，请重新确认用户名密码','../index.html');
    }
    */
?>