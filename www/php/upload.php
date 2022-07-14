<?php
    include('connect.php');
    
    $username=$_SESSION["username"];
    $allowed_ext=array("gif","jepg","png","jpg");
    $temp=explode(".",$_FILES["file"]["name"]);
    $extension=end($temp);
    $private=$_POST['private'];
    
    //检查文件类型和格式
    if((($_FILES["file"]["type"]=="image/gif") 
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png")) 
        && in_array($extension, $allowed_ext)){
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
