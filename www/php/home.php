<?php
    include('connect.php'); //连接数据库
    $username=$_SESSION["username"]; //获取当前用户名
    if (!$username){
        alert('你没有权限，请先登录','../index.html');
    }
?>

<!DOCTYPE html>
<html>
    <head>  
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../source/home.css"> <!--此链接留用css-->
    </head>
    <body>
        <div>
            <h1>个人中心</h1>
            <?php 
                echo "欢迎回来：".$username; 
            ?> 
            <a href="logout.php">退出登录</a><br><br> 
        </div>
        <form action="upload.php" method="post" enctype="multipart/form-data"> <!--上传按钮-->
            <input type="file" name="file" accept="image">
            <input type="submit" value="上传">
        </form>
        <div>
            <h2>照片墙</h2>
            <?php
                    $sql="SELECT * from image order by time DESC"; //倒序遍历数据库
                    $result=mysqli_query($con,$sql); 
                    while($row=mysqli_fetch_assoc($result)){ //将遍历结果转为关联数组，并循环输出，输出内容在div中，可对div做css修饰
                        echo   //&nbsp为空格，后续可用分区取代
                            "<div>
                                <p>$row[username] 
                                       &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                       $row[time]</p>
                                <img src='$row[address]' width='400px'/><hr>
                            </div>";
                            
                    }
            ?>
        </div>
    </body>
    
</html>