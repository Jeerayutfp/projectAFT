<?php 
    session_start();
    include '../connect.php';
    include 'function.php';

    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'allow_user':
                $data = [
                    'user_status'=>1
                ];
                if (updateDB('tb_user', $data, ["user_id"=>$_SESSION['user_id']])) {
                    echo jsonMsg("อนุมัติการใช้งานสำเร็จ", "success");
                }else {
                    echo $conn->error;
                }
                break;
            
            case 'dis_user':
                $data = [
                    'user_status'=>2
                ];
                if (updateDB('tb_user', $data, ["user_id"=>$_SESSION['user_id']])) {
                    if ($_REQUEST['user_role'] == 4) {
                        $msg = "ระงับการใช้งานชั่วคราวเสร็จสิ้น";
                    }else {
                        $msg = "ยกเลิกการใช้งานสำเร็จ";
                    }
                    echo jsonMsg($msg, "success");
                }else {
                    echo $conn->error;
                }
                break;
            
            case 'addshoptype':
                $data = [
                    'type_name'=>$_REQUEST['type_name'],
                    'detail'=>$_REQUEST['detail']
                ];
                if (insertDB('tb_shop_type', $data)) {
                    echo jsonMsg("สร้างประเภทร้านอาหารสำเร็จ", "success");
                }else {
                    echo $conn->error;
                }
                break;

                case 'edit':
                    $data = [
                        'type_name'=>$_REQUEST['type_name'],
                        'detail'=>$_REQUEST['detail']
                    ];
                    if (updateDB('tb_shop_type', $data, ['type_id'=>$_REQUEST['type_id']])) {
                        echo jsonMsg("สร้างประเภทร้านอาหารสำเร็จ", "success");
                    }else {
                        echo $conn->error;
                    }
                    break;
    
                case 'del':
                    $sql = $conn->query("DELETE FROM tb_shop_type WHERE type_id='".$_REQUEST['type_id']."'");
                    if($sql) {
                        echo jsonMsg("ลบประเภทร้านอาหารเสร็จสิ้น", "success");
                    }else {
                        echo $conn->error;
                    }
                    break;
            }
    }
?>