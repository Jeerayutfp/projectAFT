<div class="col px-3">
    <div class="container col-10 rounded-3 bg-white shadow-sm mt-3">
        <div class="text-center pt-4">
            <h4 class="fw-bold mt-4">เพิ่มหมวดหมู่อาหาร</h4>
        </div>

        <form class="needs-validation mt-4 px-5" action="../api/ac_product.php?ac=addType" method="post" enctype="multipart/form-data" id="frm_productType" novalidate>
                    <div class="mt-2">
                        <label for="" class="form-label">หมวดหมู่อาหาร</label>
                        <input type="text" name="type_name" id="type_name" class="form-control" placeholder="กรอกชื่อหมวดหมู่ร้านอาหาร" required>
                        <div class="invalid-feedback">
                            โปรดกรอกชื่อหมวดหมู่อาหารของท่าน
                        </div>

                    </div>

                    <div class="mt-4">
                        <label for="" class="form-label">รูปภาพประกอบ</label>
                        <input type="file" name="type_img" id="type_img" class="form-control" required>
                        <div class="invalid-feedback">
                            โปรดเลือกรูปภาพประกอบ
                        </div>
                    </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn btn-success mb-5" style="width: 130px;">ยืนยัน</button>
                <a href="index.php" class="btn btn-dark mb-5" style="width: 130px;">ยกเลิก</a>
            </div>
        </form>
    </div>
</div>