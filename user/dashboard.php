<div class="container-fluid p-0">
    <img width="100%" height="500" class="object-fit-cover" src="../image/orther/people-taking-photos-food.jpg" alt="">
</div>

<div class="container bg-white rounded-3 mt-4 border-3 border-primary border-top">
    <h3 class="pt-3">ร้านอาหาร <small class="text-muted">FoodShop</small></h3>
    
    <!-- <div class="text-end">
        <a class="text-muted text-decoration-none" href="index.php?p=search">ดูทั้งหมด</a>
    </div> -->

    <div class="row">
        <?php 
            $sql = $conn->query("SELECT tb_user.*,tb_shop.*,tb_shop_type.type_name  FROM tb_user LEFT JOIN tb_shop ON tb_user.user_id = tb_shop.user_id LEFT JOIN tb_shop_type ON tb_shop.shop_type = tb_shop_type.type_id  WHERE tb_user.user_status = 1 AND tb_user.user_role = 2 ");
            while($fet = $sql->fetch_object()) {
        ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3 col-xxl-3 my-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-header">
                    <img width="100%" height="200" class="rounded object-fit-cover" src="../img/profile/<?= $fet->user_img; ?>" alt="">
                </div>
                <div class="card-body text-center px-4">
                    <h5 class="fw-bold"><?= $fet->shop_name; ?></h5><hr>
                        <?php 
                            $sql_re = $conn->query("SELECT SUM(re_point) AS point, COUNT(re_user) AS user FROM tb_review WHERE re_shop='".$fet->shop_id."' ");
                            $fet_re = $sql_re->fetch_object();
                        ?>
                    <p>คะแนนรีวิว: <?= review($fet_re->point, $fet_re->user); ?>⭐</p>
                    <p>ประเภทร้านอาหาร: <?= $fet->type_name; ?></p>

                    <div class="d-grid">
                        <a href="index.php?p=product_all&shop_id=<?= $fet->shop_id; ?>" class="btn btn-grid btn-primary">เลือกดูรายการอาหาร</a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>