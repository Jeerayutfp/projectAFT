<?php 
    $sql = $conn->query("SELECT tb_user.*, tb_order.* FROM tb_order LEFT JOIN tb_user ON tb_order.cus_name = tb_user.user_id WHERE tb_order.shop_id='".$_SESSION['shop_id']."' ");
    $num = $sql->num_rows;
?>
<div class="container">
    <h4 class="pt-3 py-3">ระบบจัดการร้านอาหาร</h4>
    <?php 
        if ($num <= 0) {
            echo '<h5 class="text-muted text-center py-3">ยังไม่มีออเดอร์ในขณะนี้</h5>';
        } else {
            echo '<div class="row">     
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card bg-info text-white border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-text fw-bold">1 รายการ</h2>
                    <h5 class="card-title">ออเดอร์ทั้งหมด</h5>
                    <i class="fas fa-users fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card bg-success text-white border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-text fw-bold">4 รายการ</h2>
                    <h5 class="card-title">รายการทั้งหมด</h5>
                    <i class="fas fa-list fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
            <div class="card bg-danger text-white border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-text fw-bold">399 บาท</h2>
                    <h5 class="card-title">ยอดขายทั้งหมด</h5>
                    <i class="fas fa-money-bill-wave fa-2x"></i>
                </div>
            </div>
        </div>
    </div>';
        }
    ?>

    <div class="row">
        <?php 
            while ($fet = $sql->fetch_object()) {
                $sql_product = $conn->query("SELECT tb_cart.*, tb_product.* FROM tb_cart LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id WHERE tb_cart.order_id='".$fet->order_id."' ");
        ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
            <div class="card border-0 shadow rounded-4">
                <div class="card-header bg-light text-center">
                    <h5 class="fw-bold">ออเดอร์: <?= $fet->order_id; ?></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p class="fw-bold text-center">รายการอาหาร</p>
                            <?php 
                                while ($fet_product = $sql_product->fetch_object()) {
                            ?>
                            <p>ชื่อ: <?= $fet_product->pro_name; ?></p>
                            <p>รายละเอียด: <?= $fet_product->pro_detail; ?></p>
                            <p>จำนวน: <?= $fet_product->ca_qty; ?> รายการ</p>
                            <?php } ?>
                        </div>
                        <div class="col">
                            <p class="fw-bold text-center">ผู้สั่งซื้อ</p>
                            <p>ชื่อ: <?= $fet->fullname; ?></p>
                            <p>ที่อยู่: <?= $fet->address; ?></p>
                            <p>เบอร์โทรศัพท์: <?= $fet->tel; ?></p>
                        </div>
                    </div>
                    <div class="text-center fw-bold mt-3">
                        <div class="bg-secondary bg-gradient text-white rounded-4 p-2">
                            <p>ราคารวม: <?= $fet->total_price; ?> บาท</p>
                            <p>สถานะ: <?= order_status($fet->order_status); ?></p>
                            <?php if ($fet->order_status == 1) { ?>
                                <button id="btn-shopCon" data-id="<?= $fet->order_id; ?>" class="btn btn-success btn-sm">ยืนยันการทำอาหาร</button>
                                <a href="bill.php?order_id=<?= $fet->order_id; ?>" class="btn btn-warning btn-sm">ปริ้นใบเสร็จ</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
