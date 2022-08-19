<?php
    include('connect.php'); //连接数据库
    $username=$_SESSION["username"]; //获取当前用户名
?>

<!DOCTYPE html>
<html lang="zh">
    <head>
        <title>即刻传图</title>
        <link rel="stylesheet" type="text/css" href="../source/css/home.css">
        <meta charset="utf-8">
    </head>
    <body>
        <div id="plain"></div>
        <div >
            <div id="guide">
                <div id="title">
                    <img style="float:left" id="logo" src="../source/material/logo.png" alt="logo">
                    <h1 style="position: relative; top:20px; left:30px">即刻传图</h1>
                </div>
                <hr id="hr1">
                <div id="card">
                    <div id="welcome">welcome,</div>
                    <div id="name">
                        <?php 
                            echo $username; 
                        ?>
                    </div>
                </div>
                <hr id="hr2">
                <div id="upload">
                    <form action="upload.php" method="post" enctype="multipart/form-data"> <!--上传按钮-->
                        <input id="file" type="file" name="file" accept="image">
                        <label id="label" for="file">选择文件</label>
                        <br><br><br>
                        <div id="choose">
                            他人可见？
                            <input  type="radio" name="private" value="0">√ 
                            <input  type="radio" name="private" value="1">×<br>
                        </div>
                        <input id="button" type="submit" value="上传">                    
                    </form>
                </div>
                <div id="Logout">
                    <a id="logout" href="logout.php">退出登录</a>
                </div>
                
            </div>
            <div style="height: 170px;"></div>
            <div id="wall">
                <?php
                        $sql="SELECT * from image order by time DESC"; //倒序遍历数据库
                        $result=mysqli_query($con,$sql); 
                        while($row=mysqli_fetch_assoc($result)){ //将遍历结果转为关联数组，并循环输出，输出内容在div中，可对div做css修饰
                            if($row['username']==$username){ //遍历的同时判断图片是否为当前用户上传，若是，则增加删除操作
                                if($row['private']==0){ 
                                    echo   //&nbsp为空格，后续可用分区取代
                                    "<div class='show'>
                                        <div class='smname'>$row[username]</div>
                                        <div class='time'>$row[time]</div>
                                        <div class='Delete'>
                                            <form action='delete.php' method='post'>
                                                <input type='text' name='address' value='$row[address]' style='display:none'>
                                                <input class='delete' type='submit' value='删除'>    
                                            </form>
                                        </div>
                                        <div class='img'>
                                            <img class='image' src='$row[address]' alt='img'>
                                        </div>
                                        <hr class='hr3'>
                                    </div>";
                                }
                                else if($row['private']==1){ //若为私密图片，跟随提示标签
                                    echo   
                                    "<div class='show'>
                                        <div class='smname'>$row[username]</div>
                                        <div class='time'>$row[time]</div>
                                        <div class='Delete'>
                                            <form action='delete.php' method='post'>
                                                <input type='text' name='address' value='$row[address]' style='display:none'>
                                                <input class='delete' type='submit' value='删除'>    
                                            </form>
                                        </div>
                                        <div class='img'>
                                            <img class='image' src='$row[address]' alt='img'>
                                        </div>
                                        <div class='tag'>
                                            ×他人不可见↑
                                        </div>
                                        <hr class='hr3'>
                                    </div>";
                                }
                                
                            }
                            else if($row['username']!=$username &&  $row['private']==0){ //不是当前用户上传的图片，只展示private=0的
                                echo   
                                "<div class='show'>
                                        <div class='smname'>$row[username]</div>
                                        <div class='time'>$row[time]</div>
                                        <div class='img'>
                                            <img class='image' src='$row[address]' alt='img'>
                                        </div>
                                        <hr class='hr3'>
                                    </div>";
                            }
                        }
                ?>
            </div>
            
                
            </div>
        </div>
        
    </body>
</html>