<?php   //此文件用于链接数据库和声明弹窗
    header('Content-Type:text/html;charset=utf-8');//头部文件声明
    /*
    $check_uname=$_SESSION['username'];
    if($check_uname){
        alert('你有账号尚未退出！请退出登录','/php/home.php');//检查是否有对话尚在连接中
    }
    */
    //连接数据库
function connect(){
    $servername='localhost';
    $username='root1';
    $password='123456';
    $dbname='www';
    $charset='utf8mb4';
    $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_PERSISTENT => true
    );
    $con=new PDO("mysql:host=$servername;dbname=$dbname;charset=$charset",$username,$password,$options);//创建连接
    return $con;
}

function checkRegisterInDb($name) {//检查用户名重复
    try {
        $conn = connect();
        $sql = "select password from user where username=:name";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return isset($result['password']) ? $result['password'] : '';
    } catch(PDOException $e) {
        throw $e;
    }
}


function registerInDb($name, $password,$question,$answer) {//注册功能
    try {
        $conn = connect();
        $sql = "INSERT INTO user (username, password,question,answer) VALUES (:name, :password, :question, :answer)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':answer', $answer);
        return $stmt->execute();
    } catch(PDOException $e) {
        throw $e;
    }
}
    //验证数据库连接
    if(!connect()){
        die('Fail to connect database server:'.mysqli_connect_error());
    }

    //定义弹窗
    function alert($str,$url){
        echo '<script> alert("'.$str.'");location.href="'.$url.'";</script>';
    }
    
    function mkdirs($dir, $folder){
        mkdir($dir.$folder);
    }
    
    //建立会话，接收登陆界面传来的数据

?>