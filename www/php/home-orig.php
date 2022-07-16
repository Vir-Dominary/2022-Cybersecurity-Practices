<?php
    include('connect.php'); //连接数据库
    $username=$_SESSION["username"]; //获取当前用户名
?>

<!DOCTYPE html>
<html lang="zh">
    <head>  
        <meta charset="utf-8">
        <link rel="stylesheet" href=""> <!--此链接留用css-->
    </head>
    <body>
        <h1>个人中心</h1>
        <?php 
            echo "欢迎回来：".$username; 
        ?>
        <a href="logout.php">退出登录</a><br><br> 
        <form action="upload.php" method="post" enctype="multipart/form-data"> <!--上传按钮-->
            <input type="file" name="file" accept="image"><br>
            是否他人可见：
            <input type="radio" name="private" value="0">是 
            <input type="radio" name="private" value="1">否<br>
            <input type="submit" value="上传">
        </form>
        <div>
            <h2>照片墙</h2>
            <?php
                    $sql="SELECT * from image order by time DESC"; //倒序遍历数据库
                    $result=mysqli_query($con,$sql); 
                    while($row=mysqli_fetch_assoc($result)){ //将遍历结果转为关联数组，并循环输出，输出内容在div中，可对div做css修饰
                        if($row['username']==$username){ //遍历的同时判断图片是否为当前用户上传，若是，则增加删除操作
                            if($row['private']==0){ 
                                echo   //&nbsp为空格，后续可用分区取代
                                "<div>
                                    <p>$row[username] 
                                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        $row[time]
                                        &nbsp
                                        <form action='delete.php' method='post'>
                                            <input type='text' name='address' value='$row[address]' style='display:none'> 
                                            <input type='submit' value='删除'>    
                                        </form>
                                    </p>
                                    <img src='$row[address]' width='400px'/><hr>
                                </div>";
                            }
                            else if($row['private']==1){ //若为私密图片，跟随提示标签
                                echo   
                                "<div>
                                    <p>$row[username] 
                                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        $row[time]
                                        &nbsp
                                        <form action='delete.php' method='post'>
                                            <input type='text' name='address' value='$row[address]' style='display:none'> 
                                            <input type='submit' value='删除'>    
                                        </form>
                                    </p>
                                    <img src='$row[address]' width='400px'/>
                                    &nbsp&nbsp&nbsp//他人不可见
                                    <hr>
                                </div>";
                            }
                            
                        }
                        else if($row['username']!=$username &&  $row['private']==0){ //不是当前用户上传的图片，只展示private=0的
                            echo   
                            "<div>
                                <p>$row[username] 
                                       &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                       $row[time]</p>
                                <img src='$row[address]' width='400px'/><hr>
                            </div>";
                        }
                    }
            ?>
        </div>
    </body>
    
</html>