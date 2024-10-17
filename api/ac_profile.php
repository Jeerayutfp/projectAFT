<?php
    session_start();
    include '../connect.php';
    include 'function.php';

    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'profile':
                if ($_FILES['user_img']['name'] != "") {
                    $file = $_FILES['user_img']['name'];
                    move_uploaded_file($_FILES['user_img']['tmp_name'],"../img/profile/".$file);
                }else {
                    $sql_image = $conn->query("SELECT user_img FROM tb_user WHERE user_id ='".$_SESSION['user_id']."' ");
                    $fet_image = $sql_image->fetch_object();
                    $file = $fet_image->user_img;
                }
            $data = [
                'fullname'=>$_REQUEST['fullname'],
                'address'=>$_REQUEST['address'],
                'tel'=>$_REQUEST['tel'],
                'user_img'=>$file
            ];

            if (updateDB('tb_user', $data, ["user_id"=>$_SESSION['user_id']])) {
                echo jsonMsg("แก้ไขข้อมูลเสร็จสิ้น", "success");
            }else {
                echo $conn->error;
            }
            break;

            case 'shop':
                $data = [
                    'shop_name'=>$_REQUEST['shop_name'],
                    'shop_type'=>$_REQUEST['shop_type'],
                ];
                if (updateDB('tb_shop', $data, ["shop_id"=>$_SESSION['shop_id']])) {
                    echo jsonMsg("แก้ไขข้อมูลร้านอาหารสำเร็จ","success");
                }else {
                    echo $conn->error;
                }
                break;
        }
    }
?>