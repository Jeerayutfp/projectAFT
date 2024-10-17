<?php
    session_start();
    include '../connect.php';
    include 'function.php';

    if (isset($_REQUEST['ac'])) {
        switch ($_REQUEST['ac']) {
            case 'addProduct':
                if ($_FILES['pro_img']['name'] != "") {
                    $file = $_FILES['pro_img']['name'];
                    move_uploaded_file($_FILES['pro_img']['tmp_name'],'../asset/img/product'.$file);
                }else {
                    echo jsonMsg("โปรดแนบรูปภาพสินค้า", "error");
                }

                $data = [
                    'pro_name'=>$_REQUEST['pro_name'],
                    'pro_detail'=>$_REQUEST['pro_detail'],
                    'pro_price'=>$_REQUEST['pro_price'],
                    'pro_sale'=>$_REQUEST['pro_sale'],
                    'pro_type'=>$_REQUEST['pro_type'],
                    'pro_img'=>$file
                ];

                if (insertDB('tb_product', $data)) {
                    echo jsonMsg("เพิ่มรายการสินค้าเสร็จสิ้น", "success");
                }else {
                    echo $conn->error;
                }
                break;

                case 'editProduct':
                    if ($_FILES['pro_img']['name'] != "") {
                        $file = $_FILES['pro_img']['name'];
                        move_uploaded_file($_FILES['pro_img']['tmp_name'],'../asset/img/product'.$file);
                    }else {
                        $sql_img = $conn->query("SELECT pro_img FROM tb_product WHERE pro_id='".$_REQUEST['pro_id']."'");
                        $fet_img = $sql_img->fetch_object();
                        $file = $fet_img->pro_img;
                    }

                    $data = [
                        'pro_name'=>$_REQUEST['pro_name'],
                        'pro_detail'=>$_REQUEST['pro_detail'],
                        'pro_price'=>$_REQUEST['pro_price'],
                        'pro_sale'=>$_REQUEST['pro_sale'],
                        'pro_type'=>$_REQUEST['pro_type'],
                        'pro_img'=>$file
                    ];
                    
                    if (updateDB('tb_product', $data, ['pro_id'=>$_REQUEST['pro_id']])) {
                        echo jsonMsg("แก้ไขข้อมูลสินค้าเสร็จสิ้น", "error");
                    }else {
                        echo $conn->error;
                    }
                break;

                case 'delProduct':
                    $sql = $conn->query("DELETE FROM tb_product WHERE pro_id='".$_REQUEST['pro_id']."'");
                    
                    if ($sql) {
                        echo jsonMsg("ลบรายการสินค้าเสร็จสิ้น", "error");
                    }else {
                        echo $conn->error;
                    }
                break;

                case 'addProductType':
                    if ($_FILES['type_img']['name'] != "") {
                        $file = $_FILES['type_img']['name'];
                        move_uploaded_file($_FILES['type_img']['tmp_name'],'../asset/img/productType'.$file);
                    }else {
                        echo jsonMsg("โปรดแนบรูปหมวดหมู่อาหารของท่าน", "error");
                    }

                    $data = [
                        'type_name'=>$_REQUEST['type_name'],
                        'type_img'=>$file
                    ];

                    if (insertDB('tb_product_type', $data)) {
                        echo jsonMsg("เพิ่มหมวดหมู่อาหารสำเร็จ","success");
                    }else {
                        echo $conn->error;
                    }
                    break;
        }
    }
?>