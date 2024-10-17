<div class="main-header">
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white border-bottom sticky-top">
        <!-- Toggle button for sidebar -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
            aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle sidebar">
            <i class="navbar-toggler-icon"></i>
        </button>
    </nav>
</div>

<!-- Sidebar -->
<div class="main-sidebar sidebar-bg d-flex flex-column" id="sidebarMenu">
    <!-- Brand Logo -->
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container">
            <a class="navbar-brand" href="index.php"><span class="fw-bold">STC ONLINE</span></a>
        </div>
    </nav>

    <div class="container flex-grow-1 p-1">
        <div class="d-flex align-items-center mb-3 mt-3 pb-3 px-4 border-bottom">
            <img width="30" height="30" class="object-fit-cover rounded-circle"
                src="../img/profile/<?= $fet_pf->user_img; ?>" alt="User Image">
            <h6 class="fw-bold text-white ms-2 mb-0"><?= $fet_pf->username; ?> <small class="fw-light">ร้านอาหาร</small>
            </h6>
        </div>

        <ul class="nav nav-pills nav-sidebar flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link text-bg-primary d-flex justify-content-between border-start"
                    data-bs-toggle="collapse" data-bs-target="#ManagerCollapse" aria-expanded="false"
                    aria-controls="ManagerCollapse">
                    <span>การจัดการ</span>
                    <i class="dropdown-toggle ms-auto"></i>
                </a>

                <div class="collapse" id="ManagerCollapse">
                    <ul class="list-group">
                        <li class="nav-item">
                            <a href="index.php?p=addproduct_type" class="nav-link text-light">
                                <span>หมวดหมู่อาหาร</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=product" class="nav-link text-light">
                                <span>รายการอาหาร</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>

        <div class="justify-content-between mt-2">
            <a href="index.php?p=salesum" class="btn btn-success w-100 text-start border-start">สรุปยอดขาย</a>
        </div>

        <ul class="nav nav-pills nav-sidebar flex-column mt-2">
            <li class="nav-item">
                <a href="#" class="nav-link text-bg-warning d-flex justify-content-between border-start"
                    data-bs-toggle="collapse" data-bs-target="#ProfileCollapse" aria-expanded="false"
                    aria-controls="ProfileCollapse">
                    <span>บัญชีของฉัน</span>
                    <i class="dropdown-toggle ms-auto"></i>
                </a>

                <div class="collapse" id="ProfileCollapse">
                    <ul class="list-group">
                        <li class="nav-item">
                            <a href="index.php?p=profile" class="nav-link text-light">
                                <span>แก้ไขข้อมูลส่วนตัว</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <div class="justify-content-between mt-auto mb-3 p-1">
        <a href="../api/ac_logout.php" onclick="return confirm('ต้องการออกจากระบบใช่ไหม? ');"
            class="btn btn-danger w-100 text-start">ออกจากระบบ</a>
    </div>
</div>
<script>
document.querySelector('.navbar-toggler').addEventListener('click', function() {
    var sidebar = document.getElementById('sidebarMenu');
    sidebar.classList.toggle('collapsed'); // Toggle class
    // เพิ่มการเปลี่ยนแปลงรูปแบบเมื่อ sidebar ถูกซ่อน
    if (sidebar.classList.contains('collapsed')) {
        sidebar.style.width = '0'; // ซ่อน sidebar
    } else {
        sidebar.style.width = '250px'; // แสดง sidebar
    }
});
</script>
