<?php 
    session_start();
    include '../connect.php';
    include 'function.php';

    $sql = $conn->query("INSERT INTO tb_review(re_point, detail, re_user, re_shop, re_product, re_order) VALUES'".$_REQUEST['re_point']."','".$_REQUEST['detail']."','".$_SESSION['user_id']."','".$_REQUEST['shop_id']."','".$_REQUEST['pro_id']."','".$_REQUEST['order_id']."'");
    if ($sql) {
        echo jsonMsg("ให้คะแนนรีวิวสำเร็จ", "success");
    }else {
        echo $conn->error;
    }
?>
