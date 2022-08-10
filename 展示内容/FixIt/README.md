FixIt流程

## 漏洞分析

漏洞的产生原因是后台只对MIME类型做了限制而没有对文件后缀名进行限制；

## 修复思路

由于php版本较高所以不存在 ``%00``截断漏洞，且对图片的解析不支持图片码式的攻击方式。所以只需要在后端对文件后缀做白名单限制，就能彻底修复文件上传漏洞。

## 代码修复

漏洞代码如下：

```php
if((($_FILES["file"]["type"]=="image/gif") 
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png")) 
        ){
        if($_FILES["file"]["error"]>0){
            echo "上传错误：".$_FILES["file"]["error"]."<br>";
        }
        else{
            if(file_exists("../image/$username/".$_FILES["file"]["name"])){
                $str=$_FILES["file"]["name"]."已存在，请更改文件名";
                alert($str,"home.php");
            }
            else{
                $addr="../image/$username/".$_FILES["file"]["name"];
                move_uploaded_file($_FILES["file"]["tmp_name"], $addr);
                alert('上传成功','home.php');
                $sql="INSERT into image(address,username,time,private) values('$addr','$username',NOW(),'$private')";
                if(mysqli_query($con,$sql)){
                    alert('上传成功','home.php');
                }
            }
        }
    }
    else{
        alert("文件格式非法","home.php");
    }
```

修复以后的部分代码如下：

```php
$username=mysqli_real_escape_string($con,$_SESSION["username"]);
    $allowed_ext=array("gif","jepg","png","jpg");
    $temp=explode(".",$_FILES["file"]["name"]);
    $extension=end($temp);
    $private=$_POST['private'];
  
    //检查文件类型和格式
    //&& in_array($extension, $allowed_ext)
    if((($_FILES["file"]["type"]=="image/gif") 
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png")) 
        && in_array($extension, $allowed_ext)){
```

## 安全性验证

此时运行漏洞利用自动化脚本，得到的结果是：

```php
<html>
<head><title>404 Not Found</title></head>
<body>
<center><h1>404 Not Found</h1></center>
<hr><center>nginx/1.15.11</center>
</body>
</html>
```

说明上传失败，漏洞修复成功。
