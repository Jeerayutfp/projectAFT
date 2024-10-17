<?php 
session_start();
include '../connect.php';
include 'function.php';

if (isset($_REQUEST['ac'])) {
    switch ($_REQUEST['ac']) {
        case 'regis':
            if ($_FILES['user_img']['name'] != '') { 
                $file = $_FILES['user_img']['name'];
                move_uploaded_file($_FILES['user_img']['tmp_name'], '../asset/img/profile/' . $file);
            } else {
                $file = "avatar.jpg";
            }
            $data = [
                'username' => $_REQUEST['username'],
                'password' => password_hash($_REQUEST['password'], PASSWORD_BCRYPT),
                'fullname' => $_REQUEST['fullname'],
                'address' => $_REQUEST['address'],
                'tel' => $_REQUEST['tel'],
                'user_img' => $file,
                'user_role' => $_REQUEST['user_role']
            ];
            
            if (insertDB('tb_user', $data)) {
                if ($_REQUEST['user_role'] == 2) {
                    header("Location: ../shopdetails.php");
                    $_SESSION['success'] = "ข้อมูลรายละเอียดร้านอาหาร";
                } else {
                    header("Location: ../login.php");
                    $_SESSION['success'] = "สมัครสมาชิกสำเร็จ";
                }
            } else {
                header("Location: ../register.php");
                $_SESSION['error'] = "ข้อมูลไม่ถูกต้อง";
            }
            break;
        
        case 'shopdetails':
            $sql_max = $conn->query("SELECT MAX(user_id) AS user_max FROM tb_user WHERE user_role = 2");
            $fet = $sql_max->fetch_object();
            $sql = $conn->query("INSERT INTO tb_shop(shop_name, shop_type, user_id) VALUES('".$_REQUEST['shop_name']."','".$_REQUEST['shop_type']."','".$fet->user_max."') ");    
                    
            if ($sql) {
                header("Location: ../login.php");
                $_SESSION['success'] = "สมัครสมาชิกร้านอาหารเสร็จสิ้น";
            } else {
                header("Location: ../register.php");
                $_SESSION['error'] = "เกิดข้อผิดพลาด";
            }
            break;
    }
}
?>
