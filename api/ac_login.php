<?php 
session_start();
include '../connect.php';
include 'function.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = $conn->query("SELECT * FROM tb_user WHERE username='" . $conn->real_escape_string($username) . "'");
$num = $sql->num_rows;
$fet = $sql->fetch_object();

if ($num <= 0) {
    $_SESSION['error'] = "Username ไม่ถูกต้อง";
    header("Location: ../login.php");
    exit();
} else {
    if (password_verify($password, $fet->password)) {
        if ($fet->user_status == null) {
            $_SESSION['error'] = "รอการอนุมัติ";
            header("Location: ../login.php");
            exit();
        } else if ($fet->user_status == 1) {
            $_SESSION['user_id'] = $fet->user_id;
            $_SESSION['fullname'] = $fet->fullname;
            $_SESSION['username'] = $fet->username;
            $_SESSION['address'] = $fet->address;
            $_SESSION['tel'] = $fet->tel;

            switch ($fet->user_role) {
                case 1:
                    $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ (Admin)";
                    header("Location: ../admin/index.php");
                    break;
                case 2:
                    $sql_shop = $conn->query("SELECT * FROM tb_shop WHERE user_id='" . $fet->user_id . "'");
                    $fet_shop = $sql_shop->fetch_object();

                    $_SESSION['shop_id'] = $fet_shop->shop_id;
                    $_SESSION['shop_name'] = $fet_shop->shop_name;
                    $_SESSION['shop_type'] = $fet_shop->shop_type;

                    $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ (Shop)";
                    header("Location: ../shop/index.php");
                    break;
                case 3:
                    $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ (Rider)";
                    header("Location: ../rider/index.php");
                    break;
                default:
                    $_SESSION['success'] = "เข้าสู่ระบบสำเร็จ (User)";
                    header("Location: ../user/index.php");
                    break;
            }
            exit();
        } else {
            $msg = ($fet->user_role == 4) ? "บัญชีถูกระงับการเข้าใช้งานชั่วคราว" : "บัญชีถูกยกเลิกการเข้าใช้งาน";
            $_SESSION['error'] = $msg;
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
        header("Location: ../login.php");
        exit();
    }
}
?>
