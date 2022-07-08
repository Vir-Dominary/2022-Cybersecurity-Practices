<?php
    include('connect.php');
    
    unset($_SESSION['username']);
    session_destroy();
//    echo '<script>location.href="../index.html";</script>';
    header('Location: ../index.html'); //跳转登录页面
?>