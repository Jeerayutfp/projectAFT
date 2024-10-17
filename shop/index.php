<?php 
    session_start();
    if(empty($_SESSION['shop_id'])) {
        header("Location: ../login.php");
    }
    include '../connect.php';
    include '../api/function.php';
    $sql_pf = $conn->query("SELECT * FROM tb_user WHERE user_id='".$_SESSION['user_id']."' ");
    $fet_pf = $sql_pf->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../admin/stylesb.css">
    <title>STC ONLINE</title>
</head>
<body class="bg-light">
<?php 
                            if (isset($_SESSION['success'])) {
                        ?>
                        <div class="alert alert-success" role="alert"><?php echo $_SESSION['success'] ?></div>
                        <?php
                        unset($_SESSION['success']);
                            }
                        if (isset($_REQUEST['error'])) {
                        ?>
                        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error'] ?></div>

                        <?php
                            unset($_SESSION['error']);
                        }
                        ?>

    <div class="row" style="--bs-gutter-x: 0;" id="content">
        <?php 
            include('sidebar.php');
        ?>

        <?php
            if (isset($_REQUEST['p'])) {
                include($_REQUEST['p']. '.php');
            } else {
        ?>

        <?php 
            include('dashboard.php');
        }
        ?>
    </div>

    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
        $(document).ready(function() {
            loader();
        })
        $(document).on("submit","#frm_shopProfile",function(e) {
            formSubmit(e);
            return false;
        })
        $(document).on("submit","#frm_productType",function(e) {
            formSubmit(e);
            return false;
        })
        $(document).on("submit","#frm_product",function(e) {
            formSubmit(e);
            return false;
        })
        $(document).on("submit","#frm_addSale",function(e) {
            formSubmit(e);
            return false;
        })
        $(document).on("submit","#frm_profile",function(e) {
            formSubmit(e);
            return false;
        })
        $(document).on("submit","#frm_repass",function(e) {
            formSubmit(e);
            return false;
        })
        $(document).on("click","#btn-del",function(e) {
            let pro_id = $(this).data("id");
            $.ajax({
                url: "../api/ac_product.php?ac=del",
                type: "post",
                dataType: "json",
                data: {
                    pro_id: pro_id
                }, success:function (data) {
                if(data.status) {
                    alertMsg(data.msg, data.type);
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }else{
                    console.log(data);
                }
            },error:function(err) {
                console.log(err);
            }
            })
        })
        $(document).on("click","#btn-edit",function(e) {
            if($("#pro_type1").val($(this).data("type")) === $("#pro_type1").val()){
                $("#pro_type1").prop("selected",true);
            }
            $("#pro_id1").val($(this).data("id"));
            $("#pro_name1").val($(this).data("name"));
            $("#pro_detail1").val($(this).data("detail"));
            $("#pro_price1").val($(this).data("price"));
            $("#pro_type1").val($(this).data("type"));
            $("#pro_sale1").val($(this).data("sale"));
        })
        $(document).on("click","#btn-addSale",function(e) {
            $("#pro_id2").val($(this).data("id"));
            $("#pro_sale2").val($(this).data("sale"));
        })
        $(document).on("click","#btn-shopCon",function(e) {
            let order_id = $(this).data("id");
            $.ajax({
                url: "../api/ac_order.php?ac=shopCon",
                type: "post",
                dataType: "json",
                data: {
                    order_id: order_id
                }, success:function (data) {
                if(data.status) {
                    alertMsg(data.msg, data.type);
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }else{
                    console.log(data);
                }
            },error:function(err) {
                console.log(err);
            }
            })
        })
        </script>
</body>
</html>