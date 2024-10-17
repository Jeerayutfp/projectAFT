<nav class="navbar d-flex d-lg-none p-3 bg-white">
    <button class="navbar-toggler border-0" data-bs-toggle="collapse" data-bs-target="#SidebarCollapse" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="collpase col-auto d-lg-flex d-md-none" id="SidebarCollapse">
    <div class="flex-shrink-0 col-auto min-vh-100 bg-white p-3" style="width: 280px;">
        <a href="index.php" class="d-flex align-items-center text-decoration-none link-dark border-bottom mb-3 pb-3">
            <span class="fw-bold fs-5">STC ONLINE</span>
        </a>

        <ul class="list-unstyled">
            <li class="mb-1">
                <a href="index.php" class="fw-bold btn">หน้าหลัก</a>
            </li>
            <li class="mb-1">
                <a href="index.php?p=myorder" class="fw-bold btn">ออเดอร์ของฉัน</a>
            </li>
            <li class="mb-1">
                <a href="index.php?p=history" class="fw-bold btn">ประวัติการรับออเดอร์</a>
            </li>
            
            <li class="border-top my-3"></li>

            <li class="border-bottom pb-3">
                <a type="button" data-bs-toggle="collapse" data-bs-target="#ProfileCollapse" aria-expanded="false" class="fw-bold btn">บัญชีของฉัน</a>

                <div class="collapse px-3" id="ProfileCollapse">
                    <ul class="list-unstyled small">
                        <li>
                            <a href="index.php?p=profile" class="text-muted link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">แก้ไขข้อมูลส่วนตัว</a>
                        </li>
                        <li>
                        <a href="../api/ac_logout.php" onclick="return confirm('ต้องการออกจากระบบใช่ไหม? ');" class="text-muted link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">ออกจากระบบ</a>
                        </li>
                    </ul>
                </div>
            </li>

            <div class="row mt-3 px-3">
                <div class="col-3">
                    <img width="67" height="67" class="object-fit-cover rounded-circle" src="../img/profile/<?= $fet_pf->user_img; ?>" alt="">
                </div>
                <div class="col-9 mt-2 text-center">
                    <h6 class="fw-bold"><?= $fet_pf->username; ?></h6>
                    <h6>ผู้จัดส่งอาหาร</h6> 
                </div>
            </div>
        </ul>
    </div>
</div>