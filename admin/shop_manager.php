<div class="col">
    <div class="container">
        <h4 class="pt-3 py-3">การจัดการผู้ใช้งานร้านอาหาร</h4>

        <div class="row">
            <?php 
                $sql = $conn->query("SELECT tb_user.*,tb_shop.shop_name,tb_shop_type.type_name FROM tb_user LEFT JOIN tb_shop ON tb_user.user_id = tb_shop.user_id LEFT JOIN tb_shop_type ON tb_shop.shop_type = tb_shop_type.type_id WHERE tb_user.user_role = 2");
                    $i=0;
                    while($fet = $sql->fetch_object()) {
                        $i++;
                    
            
            ?>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4 col-xxl-4">
                <div class="card border-0 shadow rounded-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <img src="../img/profile/<?= $fet->user_img; ?>" alt="" class="rounded-circle " width="100" height="100">
                            </div>
                            <div class="col-12 col-md-12 col-lg-8 col-xl-8 col-xxl-8">
                                    <h4>ร้าน: <?= $fet->shop_name; ?></h4>
                                    <p class="text-muted">ชื่อผู้ใช้: <?= $fet->username; ?></p>
                                    <p>ประเภทร้านอาหาร: <?= $fet->type_name; ?></p>
                                    <p>สถานะ: <?= user_status($fet->user_status,$fet->user_role); ?></p>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="my-3 btn btn-sm btn-primary" id="btn-showShopData" data-bs-toggle="modal" data-bs-target="#modal-user" data-id="<?= $fet->user_id; ?>">ดูข้อมูลเพิ่มเติม</button>
                           <?php 
                              if($fet->user_status == null) {
                            
                           ?>
                            <button class="btn btn-sm btn-success" id="btn-app" data-role="<?= $fet->user_role; ?>" data-id="<?= $fet->user_id; ?>">ยืนยัน</button>
                            <?php }elseif($fet->user_status == 1) { ?>
                                <button class="btn btn-sm btn-danger" id="btn-dis" data-role="<?= $fet->user_role; ?>" data-id="<?= $fet->user_id; ?>">ยกเลิกการใช้งาน</button>

                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modal-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">ข้อมูลร้านอาหาร</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-detail">
                   
      </div>

    </div>
  </div>
</div>