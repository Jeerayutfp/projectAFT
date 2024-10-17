<div class="container mt-4">
    <div class="bg-white shadow-sm rounded-3 border-3 border-success border-top">
        <div class="row p-5">
            <div class="col-12">
                <h4 class="fw-bold">STC ONLINE</h4>

                <ol class="breadcrumb" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php" class="text-decoration-none text-dark">หน้าหลัก</a>
                    </li>
                    <li class="breadcrumb-item active">
                        ตะกร้าสินค้า
                    </li>
                </ol>
            </div>

            <div class="col-lg-7 mb-lg-0 mb-3">
                <?php 
                    $sql = $conn->query("SELECT tb_cart.*,tb_product.*,tb_shop.shop_name FROM tb_cart LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id LEFT JOIN tb_shop ON tb_product.shop_id = tb_shop.shop_id WHERE tb_cart.ca_user = '".$_SESSION['user_id']."' AND ISNULL(tb_cart.order_id) ");
                    $total = 0;
                    $sale = 0;
                    $showTotal = 0;

                    $shop = 0;
                    while($fet = $sql->fetch_object()) {
                        $shop = $fet->ca_shop;
                ?>
                <div class="card border-0 my-2">
                    <div class="card-body">
                        <table>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-3">
                                            <img width="100%" height="100%" class="object-fit-cover" src="../img/product/<?= $fet->pro_img; ?>" alt="">
                                        </div>
                                        <div class="col-9">
                                            <p class="mb-0 fw-bold"><?= $fet->pro_name; ?></p>
                                            <small class="text-muted">ร้าน: <?= $fet->shop_name; ?></small><br>

                                            <div class="d-inline">
                                                <h6 class="fw-bold d-inline-block me-3"><?= $fet->pro_price; ?>฿</h6>

                                                <button data-id="<?= $fet->ca_id; ?>" id="btn-dash" class="d-inline-block btn" <?php 
                                                    if($fet->ca_qty == 1) {
                                                        echo "disabled";
                                                    }
                                                ?>>-</button>

                                                <input type="number" name="ca_qty" id="ca_qty" readonly value="<?= $fet->ca_qty; ?>" class="form-control d-inline-block text-center" style="width: 50px;">

                                                <button data-id="<?= $fet->ca_id; ?>" id="btn-plus" class="d-inline-block btn">+</button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn-close" data-id="<?= $fet->ca_id; ?>" id="btn-del"></button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php
                    $price =  sumtotal($fet->pro_price, $fet->ca_qty, $fet->pro_sale);
                    $total += $price;
                    $price = 0;
                    $showPrice = $fet->pro_price * $fet->ca_qty; 
                    $showTotal += $showPrice;
                    $showPrice = 0;
                    $priceSale = $fet->pro_sale;
                    $sale += $priceSale;
                    $priceSale = 0;
             } 
             ?>
             
            </div>
           
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body px-5">
                        <div class="row">
                            <div class="col text-start">ราคา</div>
                            <div class="col text-end"><?= $showTotal; ?>฿</div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col text-start">ส่วนลด</div>
                            <div class="col text-end"><?= showSale($sale); ?></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col text-start">ราคารวม</div>
                            <div class="col text-end"><?= $total; ?>฿</div>
                        </div>

                        <div class="d-grid text-center mt-4">
                            <a href="index.php?p=order&sum_total=<?= $total; ?>" class="btn btn-grid btn-success">ดำเนินการชำระเงิน</a>
                            <small class="text-muted mt-2">เมื่อดำเนินการชำระเงินจะนำไปสู่หน้ายืนยันสินค้า</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row rounded-3 bg-white shadow mt-4 px-3 border-3 border-primary border-top">
        <h4 class="fw-bold text-center pt-3">รายการอาหารที่มักสั่งคู่กัน</h4>
        <?php 

            $sql_pro = $conn->query("SELECT tb_product.*,tb_product_type.type_name FROM tb_product LEFT JOIN tb_product_type ON tb_product.pro_type = tb_product_type.type_id WHERE tb_product.shop_id='".$shop."' AND tb_product.pro_id LIMIT 4");
            while($fet_pro = $sql_pro->fetch_object()) {

            
        ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 my-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-header p-0">
                    <img width="100%" height="200" class="rounded object-fit-cover" src="../img/product/<?= $fet_pro->pro_img; ?>" alt="">
                </div>
                <div class="card-body px-4">
                    <h5 class="fw-bold text-center"><?= $fet_pro->pro_name; ?></h5><hr>

                    <p>หมวดหมู่อาหาร: <?= $fet_pro->type_name; ?></p>
                    <p>รายละเอียด: <?= $fet_pro->pro_detail; ?></p>
                    <p>ส่วนลด: <?= showSale($fet_pro->pro_sale); ?></p>
                    <?php 
                        if($fet_pro->pro_sale > 0) {

                    ?>
                   <del class="text-danger"><p class="text-center fw-bold">ราคา: <?= $fet_pro->pro_price; ?> บาท</p></del> 
                    <p class="text-center fw-bold">ราคา: <?= sumsale($fet_pro->pro_price, $fet_pro->pro_sale); ?> บาท</p>
                    <?php }else{ ?>
                        <p class="text-center fw-bold">ราคา: <?= $fet_pro->pro_price; ?> บาท</p>
                    <?php } ?>
                    <div class="d-grid">
                        <button id="btn-addCart" data-shop="<?= $fet_pro->shop_id; ?>" data-id="<?= $fet_pro->pro_id; ?>" class="btn btn-grid btn-danger">นำเข้าตะกร้าสินค้า</button>
                    </div>
                </div>
        </div>
                    </div>
        <?php } ?>
    </div>
</div>