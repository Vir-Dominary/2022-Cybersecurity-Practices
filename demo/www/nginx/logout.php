<?php
    include('connect.php');
    session_start();
    unset($_SESSION['username']); //销毁会话
    session_destroy();
//    echo '<script>location.href="../index.html";</script>';
    header('Location: index.html'); //跳转登录页面
?>