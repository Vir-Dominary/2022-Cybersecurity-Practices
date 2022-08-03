<?php
    include('connect.php'); //连接数据库
    session_start();
    $username=mysqli_real_escape_string($_SESSION["username"]); //获取当前用户名
    if(!$username){
        alert('主页内容需要登录后查看，正在跳转到登录界面...','../index.html');
    }
?>

<!DOCTYPE html>
<html>
    <head>  
        <meta charset="UTF-8">
        <script src="../source/js/login.js"></script>
        <link rel="stylesheet" type="text/css" href="../source/css/firefox/home.css">
    </head>
    <body>
        <div id="navigation">
            <h1 style="color:white;">个人中心</h1>
        <?php 
            echo "<h3 style='color:white;'>欢迎回来：$username!</h3>"; 
        ?> 
            <a href="logout.php">退出登录</a>
            <a href="../change.html">修改密码</a>
        </div> 
        <div class="padding">
        </div>
        <div id="upload">
            <p>在这里上传图片(最好是竖向的图片)</p>
        <form action="upload.php" method="post" enctype="multipart/form-data"> <!--上传按钮-->
            <input type="file" name="file" accept="image"><br>
            是否他人可见：
            <input type="radio" checked="true" name="private" value="0">是 
            <input type="radio" name="private" value="1">否<br>
            <input type="submit" value="上传">
            </form>
        </div>
        <hr>
        <div id="photowall">
            <?php
                    $sql="SELECT * from image order by time DESC"; //倒序遍历数据库
                    $result=mysqli_query($con,$sql); 
                    while($row=mysqli_fetch_assoc($result)){ //将遍历结果转为关联数组，并循环输出，输出内容在div中，可对div做css修饰
                        if($row['username']==$username){ //遍历的同时判断图片是否为当前用户上传，若是，则增加删除操作
                            if($row['private']==0){ 
                                echo   //&nbsp为空格，后续可用分区取代
                                "<div>
                                    <p>$row[username] 
                                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        $row[time]
                                    </p>
                                    <img src='$row[address]' width='300px'height='400px'/>
                                    <form action='delete.php' method='post'>
                                            <input type='text' name='address' value='$row[address]' style='display:none'> 
                                            <input type='submit' value='删除'>    
                                    </form>
                                </div>";
                            }
                            else if($row['private']==1){ //若为私密图片，跟随提示标签
                                echo   
                                "<div>
                                    <p>$row[username] 
                                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        $row[time]
                                        &nbsp
                                        <form action='delete.php' method='post'>
                                            <input type='text' name='address' value='$row[address]' style='display:none'> 
                                            <input type='submit' value='删除'>    
                                        </form>
                                    </p>
                                    <img src='$row[address]' width='300px' height='400px;/>
                                    &nbsp&nbsp&nbsp//他人不可见
                                </div>";
                            }
                        }
                            else if($row['username']!=$username &&  $row['private']==0){ //不是当前用户上传的图片，只展示private=0的
                                echo   
                                "<div>
                                    <p>$row[username] 
                                        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                        $row[time]</p>
                                    <img src='$row[address]' height='400px' width='300px'/>
                                </div>";
                            }
                        
                    }
            ?>
        </div>
    </body>
    
</html>