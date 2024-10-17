<div class="col px-3">
    <div class="container col-10 rounded-3 bg-white shadow-sm mt-3">
        <?php 
            if(isset($_REQUEST['type_id'])) {
                $sql = $conn->query("SELECT * FROM tb_shop_type WHERE type_id='".$_REQUEST['type_id']."' ");
                $fet = $sql->fetch_object();
        ?>
        <div class="text-center pt-4">
            <h4 class="fw-bold mt-4">เพิ่มประเภทร้านอาหาร</h4>
        </div>

        <form class="needs-validation mt-4 px-5" action="../api/ac_admin.php?ac=edit&type_id=<?= $_REQUEST['type_id']; ?>" method="post" id="frm_shopType" novalidate>
                    <div class="mt-2">
                        <label for="" class="form-label">ประเภทร้านอาหาร</label>
                        <input type="text" value="<?= $fet->type_name; ?>" name="type_name" id="type_name" class="form-control" placeholder="กรอกชื่อประเภทร้านอาหาร" required>
                        <div class="invalid-feedback">
                            โปรดกรอกชื่อประเภทร้านอาหารก่อนกดยืนยัน
                        </div>

                    </div>

                    <div class="mt-4">
                        <label for="" class="form-label">หมายเหตุ</label>
                        <input type="text" value="<?= $fet->detail; ?>" name="detail" id="detail" class="form-control" placeholder="กรอกหมายเหตุ">
                    </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-success mb-5" style="width: 130px;">ยืนยัน</button>
                <a href="index.php" class="btn btn-dark mb-5" style="width: 130px;">ยกเลิก</a>
            </div>
        </form>
        <?php }else{ ?>
            <div class="text-center pt-4">
            <h4 class="fw-bold mt-4">เพิ่มประเภทร้านอาหาร</h4>
        </div>

        <form class="needs-validation mt-4 px-5" action="../api/ac_admin.php?ac=addShopType" method="post" id="frm_shopType" novalidate>
                    <div class="mt-2">
                        <label for="" class="form-label">ประเภทร้านอาหาร</label>
                        <input type="text" name="type_name" id="type_name" class="form-control" placeholder="กรอกชื่อประเภทร้านอาหาร" required>
                        <div class="invalid-feedback">
                            โปรดกรอกชื่อประเภทร้านอาหารก่อนกดยืนยัน
                        </div>

                    </div>

                    <div class="mt-4">
                        <label for="" class="form-label">หมายเหตุ</label>
                        <input type="text" name="detail" id="detail" class="form-control" placeholder="กรอกหมายเหตุ">
                    </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-success mb-5" style="width: 130px;">ยืนยัน</button>
                <a href="index.php" class="btn btn-dark mb-5" style="width: 130px;">ยกเลิก</a>
            </div>
        </form>
            <?php } ?>
    </div>
</div>