<?php 
    session_start();
    include '../connect.php';
    include 'function.php';

    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'add':
                $sql = $conn->query("INSERT INTO tb_order(cus_name, total_price, shop_id, order_date) VALUES('".$_SESSION['user_name']."','".$_REQUEST['sum_totol']."','".$_REQUEST['shop_id']."',now())");
                
                $sql_max = $conn->query("SELECT MAX(order_id) AS order_max FROM tb_order WHERE cus_name='".$_SESSION['user_id']."'");
                $fet_max = $sql_max->fetch_object();

                $sql_up = $conn->query("UPDATE tb_cart SET order_id='".$fet_max->order_max."' WHERE ca_user='".$_REQUEST['user_id']."' AND ISNULL(order_id) ");

                if ($sql && $sql_max && $sql_up) {
                    echo jsonMsg("สั่งอาหารสำเร็จ รอรับสินค้าสักครู่", "success");
                }else {
                    echo $conn->error;
                }
                break;
            
            case 'riderCon':
                $data = [
                    'order_status'=>1,
                    'r_id'=>$_SESSION['user_id']
                ];

                if (updateDB('tb_order', $data, ['order_id']=>$_REQUEST['order_id'])) {
                    echo jsonMsg("รับออเดอร์สำเร็จ", "success");
                }else {
                    echo $conn->error;
                }

            case 'shopCon':
                $data = [
                    'order_status'=>2
                ];
                
                if (updateDB('tb_order', $data, ['order_id']=>$_REQUEST['order_id'])) {
                    echo jsonMsg("ยืนยันการทำอาหารเสร็จสิ้น");
                }else {
                    echo $conn->error;
                }
                break;

            case 'complete':
                $data = [
                    'order_status'=>3
                ];
                if (updateDB('tb_order', $data, ['order_id']=>$_REQUEST['order_id'])) {
                    echo jsonMsg("ยืนยันการส่งอาหารและชำระเงินเสร็จสิ้น", "success");
                }else {
                    echo $conn->error;
                }
                break;
        }
    
?>