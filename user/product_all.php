<div class="container">
    <div class="row rounded-3 bg-white mt-4 shadow border-3 border-warning border-top">
      <?php 
        if(empty($_REQUEST['type_id'])) {
            $sql_type = $conn->query("SELECT * FROM tb_product_type WHERE shop_id='".$_REQUEST['shop_id']."' ");

      ?>
        <h4 class="fw-bold text-center mt-3">หมวดหมู่อาหาร</h4>
            <?php 
                while($fet_type = $sql_type->fetch_object()) {
            ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 col-xxl-2 my-3 text-center">
            <a href="index.php?p=product_all&type_id=<?= $fet_type->type_id; ?>&shop_id=<?= $_REQUEST['shop_id']; ?>" class="text-decoration-none text-secondary">
                <img width="90" height="90" class="rounded-circle object-fit-cover" src="../img/product_type/<?= $fet_type->type_img; ?>" alt="">
                <p class="mt-2"><?= $fet_type->type_name; ?></p>
            </a>
        </div>  
        
      <?php 
            }
        } 
    ?>
    </div>

    <div class="row rounded-3 bg-white shadow mt-4 px-3 border-3 border-danger border-top">
        <h4 class="fw-bold text-center pt-3">รายการอาหาร</h4>
        <?php 
            if(isset($_REQUEST['type_id'])) {
                $where = "AND tb_product.pro_type = '".$_REQUEST['type_id']."' ";
            }else{
                $where = "";
            }
            $sql = $conn->query("SELECT tb_product.*,tb_product_type.type_name FROM tb_product LEFT JOIN tb_product_type ON tb_product.pro_type = tb_product_type.type_id WHERE tb_product.shop_id='".$_REQUEST['shop_id']."' $where ");
            while($fet = $sql->fetch_object()) {

            
        ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 my-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-header p-0">
                    <img width="100%" height="200" class="rounded object-fit-cover" src="../img/product/<?= $fet->pro_img; ?>" alt="">
                </div>
                <div class="card-body px-4">
                    <h5 class="fw-bold text-center"><?= $fet->pro_name; ?></h5><hr>

                    <p>หมวดหมู่อาหาร: <?= $fet->type_name; ?></p>
                    <p>รายละเอียด: <?= $fet->pro_detail; ?></p>
                    <p>ส่วนลด: <?= showSale($fet->pro_sale); ?></p>
                    <?php 
                        if($fet->pro_sale > 0) {

                    ?>
                   <del class="text-danger"><p class="text-center fw-bold">ราคา: <?= $fet->pro_price; ?> บาท</p></del> 
                    <p class="text-center fw-bold">ราคา: <?= sumsale($fet->pro_price, $fet->pro_sale); ?> บาท</p>
                    <?php }else{ ?>
                        <p class="text-center fw-bold">ราคา: <?= $fet->pro_price; ?> บาท</p>
                    <?php } ?>
                    <div class="d-grid">
                        <button id="btn-addCart" data-shop="<?= $fet->shop_id; ?>" data-id="<?= $fet->pro_id; ?>" class="btn btn-grid btn-danger">นำเข้าตะกร้าสินค้า</button>
                    </div>
                </div>
        </div>
                    </div>
        <?php } ?>
    </div>
    
    <div class="row rounded-3 bg-white mt-4 shadow">
        <h6 class="fw-bold mt-2">รีวิว/ความคิดเห็น</h6>
                        <?php 
                            $sql_re = $conn->query("SELECT tb_user.username,tb_review.* FROM tb_review LEFT JOIN tb_user ON tb_review.re_user = tb_user.user_id WHERE tb_review.re_shop='".$_REQUEST['shop_id']."' ");
                            while($fet_re = $sql_re->fetch_object()) {
                        ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-2 col-xl-2 col-xxl-2 mt-2 mb-3 text-center">
            <div class="card">
                <div class="card-header bg-white">
                    <h6 class="fw-bold">:<?= $fet_re->username; ?></h6>
                </div>
                <div class="card-body">
                    <p>คะแนนรีวิว: <?= $fet_re->re_point; ?>⭐</p>
                    <p>ความคิดเห็น: <br> <?= $fet_re->detail; ?></p>
                </div>
            </div>
        </div>  
        <?php } ?>
    </div>


    </div>
</div>