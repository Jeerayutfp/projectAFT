<div class="col px-3">
    <div class="container rounded-3 bg-white shadow-sm mt-3">
        <div class="text-center pt-4">
            <img width="130" height="130" class="object-fit-cover rounded-circle shadow" src="../img/profile/<?= $fet_pf->user_img; ?>" alt="">
            <h4 class="fw-bold mt-2">แก้ไขข้อมูลส่วนตัว</h4>
        </div>

        <form class="needs-validation" id="frm_profile" enctype="multipart/form-data" action="../api/ac_profile.php?ac=profile" method="post" novalidate>
            <div class="row px-5">
                <div class="col-12 col-lg-6">
                    <div class="mt-1">
                        <label for="" class="form-label">ชื่อผู้ใช้</label>
                        <input type="text" name="username" value="<?= $fet_pf->username; ?>" id="username" class="form-control" placeholder="" readonly>
                        <div class="invalid-feedback">
                            โปรดกรอกชื่อผู้ใช้ของท่าน
                        </div>
                    </div>

                    <div class="mt-2">
                        <label for="" class="form-label">ชื่อ-สกุล</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" placeholder="" value="<?= $fet_pf->fullname; ?>" required>
                        
                        <div class="invalid-feedback">
                            โปรดกรอกชื่อ-สกุลของท่าน
                        </div>
                    </div>

                    <div class="mt-2">
                        <label for="" class="form-label">เบอร์โทรศัพท์</label>
                        <input type="tel" pattern="[0-9]{10}" name="tel" id="tel" class="form-control" placeholder="" value="<?= $fet_pf->tel; ?>" required>
                        
                        <div class="invalid-feedback">
                            โปรดกรอกเบอร์โทรศัพท์ของท่าน
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="mt-1">
                        <label for="" class="form-label">ที่อยู่</label>
                        <textarea name="address" id="address" cols="30" rows="4" class="form-control" required><?= $fet_pf->address; ?></textarea>
                        <div class="invalid-feedback">
                            โปรดกรอกที่อยู่ของท่าน
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="" class="form-label">รูปโปรไฟล์</label>
                        <input type="file" name="user_img" id="user_img" class="form-control">
                    </div>
                </div>
            </div>

            <div class="text-center mt-3">
                <p>แก้ไขข้อมูลร้านอาหาร <a href="index.php?p=editshop" class="text-decoration-none">คลิ๊ก</a></p>
                <p>ต้องการแก้ไขรหัสผ่านของท่าน <a href="index.php?p=repass" class="text-decoration-none">คลิ๊ก</a></p>

                <button class="btn btn-success mb-4" type="submit" style="width: 130px;">ยืนยัน</button>
                <a href="index.php" class="btn btn-dark mb-4" style="width: 130px;">ยกเลิก</a>
            </div>
        </form>
    </div>
</div>