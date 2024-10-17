<?php 
    session_start();
    if(empty($_SESSION['user_id'])) {
        header("Location: ../login.php");
    }
    include '../connect.php';
    include '../api/function.php';
    $sql_pf = $conn->query("SELECT * FROM tb_user WHERE user_id='".$_SESSION['user_id']."' ");
    $fet_pf = $sql_pf->fetch_object();
?>
<!DOCTYPE html>
<html lang="en" style="height: auto; min-height: 100%;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="stylesb.css">
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

    <div class="wrapper" style="--bs-gutter-x: 0;" id="content">
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
        $(document).on("submit","#frm_shopType",function(e) {
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
            let type_id = $(this).data("id");
            $.ajax({
                url: "../api/ac_admin.php?ac=del",
                type: "post",
                dataType: "json",
                data: {
                    type_id: type_id
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
        $(document).on("click","#btn-app",function(e) {
            let user_id = $(this).data("id");
            $.ajax({
                url: "../api/ac_admin.php?ac=app-user",
                type: "post",
                dataType: "json",
                data: {
                    user_id: user_id
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
        $(document).on("click","#btn-dis",function(e) {
            let user_id = $(this).data("id");
            let user_role = $(this).data("role");
            $.ajax({
                url: "../api/ac_admin.php?ac=dis-user",
                type: "post",
                dataType: "json",
                data: {
                    user_id: user_id,
                    user_role: user_role
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
        $(document).on("click","#btn-showUserData",function() {
            let user_id = $(this).data('id');
            $.ajax({
                url: "../api/ac_showData.php?ac=showUserData",
                type: "get",
                dataType: "html",
                data: {
                    user_id: user_id
                },success:function(res) {
                    $("div#modal-detail").html(res);
                }
            })
        })
        $(document).on("click","#btn-showShopData",function() {
            let user_id = $(this).data('id');
            $.ajax({
                url: "../api/ac_showData.php?ac=showShopData",
                type: "get",
                dataType: "html",
                data: {
                    user_id: user_id
                },success:function(res) {
                    $("div#modal-detail").html(res);
                }
            })
        })
    </script>
</body>
</html>