<?php   //连接数据库、数据库相关操作
    header('Content-Type:text/html;charset=utf-8');//头部文件声明
    $servername='localhost';
    $username='root1';
    $password='123456';
    $dbname='www';
    $con=mysqli_connect($servername,$username,$password,$dbname);

function connect(){//连接数据库
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

function getAnswerInDb($username){
    try{
        $conn = connect();
        $sql="SELECT answer FROM user WHERE username=:username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username',$username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return isset($result['answer']) ? $result['answer'] : '';
    }catch(PDOException $e){
        throw $e;
    }
}

function resetPassword($username,$hashednewpassword){
    try{
        $conn = connect();
        $sql = "UPDATE user SET password=:password WHERE username=:username";
        $stmt = $conn -> prepare($sql);
        $stmt -> bindParam(':password',$hashednewpassword);
        $stmt -> bindParam(':username',$username);
        $stmt -> execute();
        return 1; 
    }catch(PDOException $e){
        throw $e;
    }

}

function Logincheck($postArr){//登录验证
    if(!empty($postArr['username']) && !empty($postArr['password'])){  
        try {
            $hashedPassword = checkRegisterInDb($postArr['username']);
            if(password_verify($postArr['password'], $hashedPassword)) {//检查结果是否为空
                alert('登陆成功，即将转入主界面','home.php');
                $_SESSION['username'] = $postArr['username'];
                setcookie('loggedInUser', $postArr['username']);
                return 1;
            }
            else{
                alert('用户名或密码错误','../index.html');
                return 0;
            }
        }catch(PDOException $e){
            throw $e;
            return 0;
        }
    }
    
}

function changePassword($username,$npassword){
    try{
        $conn = connect();
        $newPasswordHash = password_hash($npassword, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password =:npassword where username=:username";
        $stmt = $conn -> prepare($sql);
        $stmt -> bindParam(':npassword',$newPasswordHash);
        $stmt -> bindParam(':username',$username);
        $stmt -> execute();
        return 1;
    }catch(PDOException $e){
        throw $e;
    }
}

function getUserInfoInDb($name) {//登录验证后获取用户信息
    try {
        $conn = connect();
        $sql = "select * from user where username=:name";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
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
    

?>