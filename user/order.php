<div class="container rounded-3 shadow-sm bg-white mt-3">
    <h4 class="fw-bold text-center pt-3">ยืนยันการสั่งซื้อ</h4>


    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-9 col-xl-9 col-xxl-9 my-3">
                <div class="table-responsive">
                <table class="table table-hover table-sm text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>รูปภาพสินค้า</th>
                            <th>ร้าน</th>
                            <th>รายการอาหาร</th>
                            <th>รายละเอียด</th>
                            <th>หมวดหมู่อาหาร</th>
                            <th>ราคา</th>
                            <th>จำนวน</th>
                            <th>ส่วนลด</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle table-group-divider text-primary">
                        <?php 
                          $sql = $conn->query("SELECT tb_cart.*,tb_product.*,tb_product_type.type_name,tb_shop.shop_name FROM tb_cart LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id LEFT JOIN tb_product_type ON tb_product.pro_type = tb_product_type.type_id LEFT JOIN tb_shop ON tb_product_type.shop_id = tb_shop.shop_id WHERE tb_cart.ca_user = '".$_SESSION['user_id']."' AND ISNULL(tb_cart.order_id) ");
                          $i=0;
                          $shop = 0;
                          while($fet = $sql->fetch_object()) {
                            $i++;
                        ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td>
                                <img width="100" height="100" class="object-fit-cover rounded" src="../img/product/<?= $fet->pro_img; ?>" alt="">
                            </td>
                            <td><?= $fet->shop_name; ?></td>
                            <td><?= $fet->pro_name; ?></td>
                            <td><?= $fet->pro_detail; ?></td>
                            <td><?= $fet->type_name; ?></td>
                            <td><?= $fet->pro_price; ?>฿</td>
                            <td><?= $fet->ca_qty; ?> รายการ</td>
                            <td><?= showSale($fet->pro_sale); ?></td>
                        </tr>
                        <?php
                        $shop = $fet->shop_id;
                     } 
                     ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3 col-xxl-3 my-3">
                <div class="card">
                    <div class="card-body px-4">
                        <h4 class="text-center fw-bold">รายละเอียด</h4>

                        <p>ชื่อ: <?= $_SESSION['fullname']; ?></p>
                        <p>ที่อยู่: <?= $_SESSION['address']; ?></p>
                        <p>เบอร์โทรศัพท์: <?= $_SESSION['tel']; ?></p>
                        <p class="fw-bold text-center">ราคารวม <?= $_REQUEST['sum_total']; ?> บาท</p> 

                        <div class="d-grid">
                            <button id="btn-confirm" data-total="<?= $_REQUEST['sum_total']; ?>" data-shop="<?= $shop; ?>" class="btn btn-grid btn-success">ยืนยันการสั่งซื้อ</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>