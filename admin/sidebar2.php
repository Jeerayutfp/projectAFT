<div class="main-header">
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <!-- ปุ่มสลับสำหรับ sidebar (แสดงตลอดเวลา) -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle sidebar">
                <i>☰</i>
            </button>

            <ul class="navbar-nav ms-auto d-flex flex-row dropdown">
                <li class="nav-item">
                    <img src="../img/profile/<?= $fet_pf->user_img; ?>"
                        class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center rounded-circle"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false" height="50" alt=""
                        loading="lazy" />
                    <ul class="dropdown-menu list-unstyled small">
                        <!-- รายการในเมนูแบบดรอปดาวน์ที่นี่ -->
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

</div>

<!-- Sidebar -->
<div class="main-sidebar bg-dark" id="sidebarMenu">
    <div class="position-sticky">
        <div class="mx-3 mt-4">
            <a class="navbar-brand text-white py-4 text-center" href="index.php">
                <h4>STC ONLINE</h4>
            </a>
            <ul class="list-unstyled text-white">
                <li class="mb-1">
                    <a type="button" data-bs-toggle="collapse" data-bs-target="#ManageCollapse" aria-expanded="false"
                        class="fw-bold btn btn-primary nav-link active">การจัดการ</a>
                    <div class="collapse px-3" id="ManageCollapse">
                        <ul class="list-unstyled small">
                            <li><a href="index.php?p=user_manager"
                                    class="text-white link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">จัดการผู้ใช้ทั่วไป</a>
                            </li>
                            <li><a href="index.php?p=shop_manager"
                                    class="text-white link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">จัดการผู้ใช้ร้านอาหาร</a>
                            </li>
                            <li><a href="index.php?p=rider_manager"
                                    class="text-white link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">จัดการผู้จัดส่งอาหาร</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <a href="index.php?p=addshop_type" class="fw-bold btn text-white">ประเภทร้านอาหาร</a>
                </li>
                <li class="border-top my-3"></li>
                <li class="border-bottom pb-3">
                    <a type="button" data-bs-toggle="collapse" data-bs-target="#ProfileCollapse" aria-expanded="false"
                        class="fw-bold btn text-white">บัญชีของฉัน</a>
                    <div class="collapse px-3" id="ProfileCollapse">
                        <ul class="list-unstyled small">
                            <li><a href="index.php?p=profile"
                                    class="text-white link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">แก้ไขข้อมูลส่วนตัว</a>
                            </li>
                            <li><a href="../api/ac_logout.php" onclick="return confirm('ต้องการออกจากระบบใช่ไหม? ');"
                                    class="text-white link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover">ออกจากระบบ</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <div class="row mt-3 px-3">
                    <div class="col-3">
                        <img width="67" height="67" class="object-fit-cover rounded-circle"
                            src="../img/profile/<?= $fet_pf->user_img; ?>" alt="">
                    </div>
                    <div class="col-9 mt-2 text-center">
                        <h6 class="fw-bold"><?= $fet_pf->username; ?></h6>
                        <h6>ผู้ดูแลระบบ</h6>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</div>

<script>
document.querySelector('.navbar-toggler').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebarMenu');
    var body = document.body;
    sidebar.classList.toggle('collapsed');
    body.classList.toggle('sidebar-collapsed');
});
</script>