<nav class="navbar navbar-expand-lg bg-white border-0 p-3">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand fw-bold">STC ONLINE</a>

        <button class="navbar-toggler border-0" data-bs-toggle="collapse" data-bs-target="#NavbarCollapse" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="NavbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item mt-1">
                    <form action="index.php?p=search" method="post">
                        <input type="search" name="search" id="search" class="form-control" placeholder="ค้นหาร้านอาหาร">
                    </form>
                </li>
                <li class="nav-item mx-lg-2 mx-0 mt-1">
                    <a href="index.php" class="nav-link">หน้าหลัก</a>
                </li>
                <li class="nav-item mx-lg-2 mx-0 mt-1">
                    <a href="index.php?p=cart" class="nav-link position-relative">ตะกร้าสินค้า
                        <?php
                            $sql_cart = $conn->query("SELECT * FROM tb_cart WHERE ca_user='".$_SESSION['user_id']."' AND ISNULL(order_id) ");
                            $num_cart = $sql_cart->num_rows;
                        ?>
                        <span class="position-absolute top-0 badge bg-danger rounded-pill"><?= $num_cart; ?></span>
                    </a>
                </li>
                <li class="nav-item mx-lg-2 mx-0 mt-1">
                    <a href="index.php?p=history" class="nav-link">ประวัติการสั่งซื้อ</a>
                </li>

                <li class="nav-item dropstart">
                    <img width="45" height="45" type="button" data-bs-toggle="dropdown" class="object-fit-cover rounded-circle" src="../img/profile/<?= $fet_pf->user_img; ?>" alt="">

                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php?p=profile" class="dropdown-item">แก้ไขข้อมูลส่วนตัว</a>
                        </li>
                        <li>
                        <a href="../api/ac_logout.php" onclick="return confirm('ต้องการออกจากระบบใช่ไหม? ');" class="dropdown-item">ออกจากระบบ</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>