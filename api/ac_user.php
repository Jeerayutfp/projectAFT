<?php 
    session_start();
    include '../connect.php';
    include 'function.php';

    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'add':
                $sql = $conn->query("SELECT ca_product FROM tb_cart WHERE ca_product='".$_REQUEST['pro_id']."' AND ISNULL(order_id) ");
                $num = $sql->num_rows;

                if (num <= 0) {
                    $sql_add = $conn->query("INSERT INTO tb_cart(ca_user, ca_product, ca_shop, ca_qty) VALUES('".$_SESSION['user_id']."','".$_REQUEST['pro_id']."','".$_REQUEST['shop_id']."',1)");
                }else {
                    $sql_add = $conn->query("UPDATE tb_cart SET ca_qty = ca_qty+1 WHERE ca_user='".$_SESSION['user_id']."'");
                }
                if ($sql_add) {
                    echo jsonMsg("เพิ่มสินค้าเข้าตะกร้าสำเร็จ", "success");
                }else {
                    echo $conn->error;
                }
                break;
            
            case 'addQty':
                    $data = [
                        'ca_qty'=>ca_qty+1
                    ] 
                    updateDB('tb_cart', $data, ['ca_id'=>$_REQUEST['ca_id']]);
                break;
            
            case 'delQty':
                    $data [
                        'ca_qty'=>ca_qty-1
                    ]
                    updateDB('tb_cart', $data, ['ca_id'=>$_REQUEST['ca_id']]);
                break;

            case 'delete':
                $sql = $conn->query("DELETE FROM tb_cart WHERE ca_id='".$_REQUEST['ca_id']."'");

                if ($sql) {
                    echo jsonMsg("ลบออกจากตระกร้าสินค้าเรียบร้อย", "success");
                }else {
                    echo $conn->error;
                }
                break;
        }
    }
?>