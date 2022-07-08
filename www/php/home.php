<?php
    include('connect.php');
    $username=$_SESSION["username"];
?>
<!DOCTYPE html>
<html>
    <head>  
        <meta charset="UTF-8">
        <link rel="stylesheet" href=""> <!--此链接留用css-->
    </head>
    <body>
        <h1>个人中心</h1>
        <?php 
            echo "欢迎回来：".$username; 
        ?> 
        <a href="logout.php">退出登录</a><br><br>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" accept="image">
            <input type="submit" value="上传">
        </form>
        <div>
            <h2>照片墙</h2>
            <?php
                    $sql="SELECT * from image order by time DESC";
                    $result=mysqli_query($con,$sql);
                    while($row=mysqli_fetch_assoc($result)){
                        echo   //&nbsp为空格，后续可用分区取代
                            "<div>
                                <p>$row[username]
                                       &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                       $row[time]</p>
                                <img src='$row[address]' width='400px'/>
                            </div>";
                    }
            ?>
        </div>
    </body>
    
</html>