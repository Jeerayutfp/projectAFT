<?php 
    session_start();
    include '../connect.php';
    include 'function.php';

    $sql = $conn->query("SELECT * FROM tb_user WHERE user_id ='".$_REQUEST['user_id']."'");
    $fet = $sql->fetch_object();

    if ($_REQUEST['newpass'] != $_REQUEST['checkpass']) {
        echo jsonMsg("รหัสผ่านไม่ตรงกัน โปรดลองอีกครั้ง", "error");
    }else {
        if (password_verify($_REQUEST['oldpass'],$fet->password)) {
            $hash = password_hash($_REQUEST['newpass'],PASSWORD_BCRYPT);
            
            $data = [
                'password'=>$hash,
            ];

            if (updateDB('tb_user', $data, ["user_id"=>$_SESSION['user_id']])) {
                echo jsonMsg("แก้ไขรหัสผ่านสำเร็จ", "success");
            }else {
                echo $conn->error;
            }
        }else {
                echo jsonMsg("รหัสผ่านเดิมไม่ถูกต้อง", "error");
            }
        }
?>