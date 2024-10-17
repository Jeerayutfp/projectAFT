<?php 
    $sql = $conn->query("SELECT tb_user.*,tb_order.*,tb_shop.shop_name FROM tb_order LEFT JOIN tb_user ON tb_order.cus_name = tb_user.user_id LEFT JOIN tb_shop ON tb_order.shop_id = tb_shop.shop_id WHERE ISNULL(tb_order.order_status) AND ISNULL(tb_order.r_id) ");
    $num = $sql->num_rows;
?>
<div class="col">
    <div class="container">
        <h4 class="pt-3 py-3">ระบบจัดการรายการออเดอร์</h4>
        <?php 
                if($num <= 0) {
                    echo '<h5 class="text-danger fw-bold text-center py-3">ยังไม่มีออเดอร์ในขณะนี้</h5>';
                } else {
                    echo '<div class="row">
            <!-- Total Users Card -->
            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                <div class="card bg-info text-white border border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-text fw-bold">1 รายการ</h2>
                        <h5 class="card-title">ออเดอร์ทั้งหมด</h5>
                        <div class="text-end">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- General Users Card -->
            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                <div class="card bg-success text-white border border-0 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-text fw-bold">2 รายการ</h2>
                        <h5 class="card-title">ประวัติการรับออเดอร์</h5>
                        <div class="text-end">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
                }
            ?>

        <?php 
                while($fet = $sql->fetch_object()) {
                    $sql_product = $conn->query("SELECT tb_cart.*,tb_product.* FROM tb_cart LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id WHERE tb_cart.order_id='".$fet->order_id."' ");
            ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 col-xxl-4">
            <div class="card border-0 shadow rounded-4">
                <div class="card-header bg-white">
                    <div class="row">
                        <div class="col text-start">
                            <h5 class="fw-bold">ออเดอร์: <?= $fet->order_id; ?></h5>
                        </div>
                        <div class="col text-end">
                            <h5 class="fw-bold">ร้าน: <?= $fet->shop_name; ?></h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p class="fw-bold text-center">รายการอาหาร</p>
                            <?php 
                                    while($fet_product = $sql_product->fetch_object()) {
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
                    <div class="text-center fw-bold">
                        <p>ราคารวม <?= $fet->total_price; ?> บาท</p>
                        <p>สถานะ : <?= order_status($fet->order_status); ?> </p>
                        <?php 
                                            if($fet->order_status == null) {
                                        ?>
                        <button id="btn-riderCon" data-id="<?= $fet->order_id; ?>"
                            class="btn btn-success w-100 fw-bold">รับออเดอร์</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</div>