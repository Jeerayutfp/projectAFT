<div class="col px-3">
    <div class="container col-10 rounded-3 bg-white shadow-sm mt-3">
        <div class="text-center pt-4">
            <h4 class="fw-bold mt-4">แก้ไขข้อมูลร้านอาหาร</h4>
        </div>
            <?php 
                $sql = $conn->query("SELECT * FROM tb_shop WHERE shop_id='".$_SESSION['shop_id']."' ");
                $fet = $sql->fetch_object();
            ?>
        <form class="needs-validation mt-4 px-5 mx-4" action="../api/ac_profile.php?ac=shop" method="post" id="frm_shopProfile" novalidate>
                    <div class="mt-2">
                        <label for="" class="form-label">ชื่อร้านอาหาร</label>
                        <input type="text" name="shop_name" id="shop_name" class="form-control" value="<?= $fet->shop_name; ?>" placeholder="" required>
                        <div class="invalid-feedback">
                            โปรดกรอกชื่อร้านอาหารของท่าน
                        </div>

                    </div>

                    <div class="mt-4">
                        <label for="" class="form-label">ประเภทร้านอาหาร</label>
                        <select class="form-select" name="shop_type" id="shop_type" required>
                            <option disabled selected>เลือกประเภทร้านอาหาร</option>
                            <?php 
                                $sql_type = $conn->query("SELECT * FROM tb_shop_type");
                                while($fet_type = $sql_type->fetch_object()) {
                            ?>
                            <option value="<?= $fet_type->type_id; ?>" <?php 
                                if($fet_pf->shop_type == $fet_type->type_id){
                                    echo "selected";
                                }
                            ?>><?= $fet_type->type_name; ?></option>
                            <?php } ?>
                        </select>

                        <div class="invalid-feedback">
                            โปรดเลือกประเภทร้านอาหารของท่าน
                        </div>
                    </div>

            <div class="text-center mt-5">
                <button class="btn btn-success mb-5" type="submit" style="width: 130px;">ยืนยัน</button>
                <a href="index.php?p=profile" class="btn btn-dark mb-5" style="width: 130px;">ยกเลิก</a>
            </div>
        </form>
    </div>
</div>