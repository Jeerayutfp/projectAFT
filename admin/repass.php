<div class="col px-3">
    <div class="container rounded-3 bg-white shadow-sm mt-3">
        <div class="text-center pt-4">
            <h4 class="fw-bold mt-4">แก้ไขรหัสผ่าน 🔒</h4>
        </div>

        <form class="needs-validation mt-4" action="../api/ac_repass.php" method="post" id="frm_repass" novalidate>
            <div class="row px-5">
                <div class="col-12 col-lg-6">
                    <div class="mt-2">
                        <label for="" class="form-label">ชื่อผู้ใช้</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="" value="<?= $fet_pf->username; ?>" readonly>
                    </div>

                    <div class="mt-2">
                        <label for="" class="form-label">รหัสผ่านปัจจุบัน</label>
                        <input type="password" name="oldpass" id="oldpass" class="form-control" placeholder="กรอกรหัสผ่านปัจจุบัน" required>
                        
                        <div class="invalid-feedback">
                            โปรดกรอกข้อมูลดังกล่าวก่อนกดยืนยัน
                        </div>
                    </div>

                </div>
                <div class="col-12 col-lg-6">
                    <div class="mt-2">
                        <label for="" class="form-label">รหัสผ่านใหม่</label>
                        <input type="password" name="newpass" id="newpass" class="form-control" placeholder="กรอกรหัสผ่านที่ต้องการจะเปลี่ยน" required>
                        
                        <div class="invalid-feedback">
                            โปรดกรอกข้อมูลดังกล่าวก่อนกดยืนยัน
                        </div>
                    </div>

                    <div class="mt-2">
                        <label for="" class="form-label">ยืนยันรหัสผ่านใหม่</label>
                        <input type="password" name="compass" id="compass" class="form-control" placeholder="ยืนยันรหัสผ่านที่ต้องการจะเปลี่ยนอีกครั้ง" required>
                        
                        <div class="invalid-feedback">
                            โปรดกรอกข้อมูลดังกล่าวก่อนกดยืนยัน
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <button class="btn btn-success mb-5" type="submit" style="width: 130px;">ยืนยัน</button>
                <a href="index.php?p=profile" class="btn btn-dark mb-5" style="width: 130px;">ยกเลิก</a>
            </div>
        </form>
    </div>
</div>