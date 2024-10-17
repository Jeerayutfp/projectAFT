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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/main.css">
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
    <div id="content">
        <?php 
            include('navbar.php');
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
        $(document).ready(function () {
            loader();
        })
        $(document).on("submit", "#frm_review", function (e) {
            formSubmit(e);
            return false;
        })
        $(document).on("submit", "#frm_profile", function (e) {
            formSubmit(e);
            return false;
        })
        $(document).on("submit", "#frm_repass", function (e) {
            formSubmit(e);
            return false;
        })
        $(document).on("click", "#btn-del", function () {
            let ca_id = $(this).data("id");
            $.ajax({
                url: "../api/ac_cart.php?ac=del",
                type: "post",
                dataType: "json",
                data: {
                    ca_id: ca_id
                }, success: function (data) {
                    if (data.status) {
                        alertMsg(data.msg, data.type);
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        console.log(data);
                    }
                }, error: function (err) {
                    console.log(err);
                }
            })
        })
        $(document).on("click", "#btn-plus", function () {
            let ca_id = $(this).data("id");
            $.ajax({
                url: "../api/ac_cart.php?ac=addQty",
                type: "post",
                dataType: "html",
                data: {
                    ca_id: ca_id
                }, success: function (data) {
                    window.location.reload();
                }, error: function (err) {
                    console.log(err);
                }
            })
        })
        $(document).on("click", "#btn-dash", function () {
            let ca_id = $(this).data("id");
            $.ajax({
                url: "../api/ac_cart.php?ac=delQty",
                type: "post",
                dataType: "html",
                data: {
                    ca_id: ca_id
                }, success: function (data) {
                    window.location.reload();
                }, error: function (err) {
                    console.log(err);
                }
            })
        })
        $(document).on("click", "#btn-addCart", function () {
            let pro_id = $(this).data("id");
            let shop_id = $(this).data("shop");
            $.ajax({
                url: "../api/ac_cart.php?ac=add",
                type: "post",
                dataType: "json",
                data: {
                    pro_id: pro_id,
                    shop_id: shop_id
                }, success: function (data) {
                    if (data.status) {
                        alertMsg(data.msg, data.type);
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        console.log(data);
                    }
                }, error: function (err) {
                    console.log(err);
                }
            })
        })
        $(document).on("click", "#btn-review", function () {
            $("#shop_id1").val($(this).data('shop'))
            $("#pro_id1").val($(this).data('pro'))
            $("#order_id1").val($(this).data('id'))
        })

        $(document).on("click", "#btn-confirm", function () {
            let sum_total = $(this).data("total");
            let shop_id = $(this).data("shop");
            $.ajax({
                url: "../api/ac_order.php?ac=add",
                type: "post",
                dataType: "json",
                data: {
                    sum_total: sum_total,
                    shop_id: shop_id
                }, success: function (data) {
                    if (data.status) {
                        alertMsg(data.msg, data.type);
                        setTimeout(() => {
                            window.location.replace("index.php?p=history");
                        }, 2000);
                    } else {
                        console.log(data);
                    }
                }, error: function (err) {
                    console.log(err);
                }
            })
        })
    </script>
</body>

</html>