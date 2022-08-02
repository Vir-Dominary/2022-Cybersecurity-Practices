<?php
    include('connect.php');
    ob_start();
    $username=$_POST['username'];
    $question=$_POST['question'];
    $answer=$_POST['answer'];
    $newPassword = '123456';
    $hashedNewPassword = password_hash($newPassword,PASSWORD_DEFAULT);
    if($answer==NULL||$username==NULL) {
        alert('用户名或密保答案不能为空','../reset.html');
    }
    try {
        $conn = connect();
        $sql = "SELECT question FROM user WHERE username=:username AND question=:question";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':question', $question);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $check = isset($result['question']) ? $result['question'] : '';
    } catch(PDOException $e) {
        throw $e;
    }
    
    if(!$check){
        alert('密保问题不正确，请重新选择','../reset.html');
    }
    else{
        $hashedAnswer = getAnswerInDb($username);
        if(password_verify($answer,$hashedAnswer)){
            if(resetPassword($username,$hashedNewPassword)){
                alert('密码已重置为123456，请重新登录，登录后请及时修改密码！','../index.html');
            }
            else{
                alert('密码重置失败！将重新返回登录页面','../index.html');
            }
        }
        else{
            alert('密保答案错误，请重新输入','../reset.html');
        }
    }
    ob_end_flush();
?>