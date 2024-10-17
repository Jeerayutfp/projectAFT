<?php 
    // ดึงข้อมูลจำนวนผู้ใช้จากฐานข้อมูล
    $sql_shop = $conn->query("SELECT * FROM tb_user WHERE user_role=2");
    $num_shop = $sql_shop->num_rows;
    $sql_rider = $conn->query("SELECT * FROM tb_user WHERE user_role=3");
    $num_rider = $sql_rider->num_rows;
    $sql_user = $conn->query("SELECT * FROM tb_user WHERE user_role=4");
    $num_user = $sql_user->num_rows;
    $num_all = $num_rider + $num_shop + $num_user;
?>


<div class="col col-sm-12 pt-3 px-3">
    <h4 class="text-dark">ระบบจัดการหน้าเว็บไซต์</h4>
</div>



<div class="container-fluid pt-3">
    <div class="row">
        <!-- Total Users Card -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card bg-info text-white border border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-text fw-bold"><?= $num_all; ?> คน</h2>
                    <h5 class="card-title">ข้อมูลผู้ใช้ทั้งหมด</h5>
                    <div class="text-end">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- General Users Card -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card bg-success text-white border border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-text fw-bold"><?= $num_user; ?> คน</h2>
                    <h5 class="card-title">ข้อมูลผู้ใช้ทั่วไป</h5>
                    <div class="text-end">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shop Users Card -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card bg-danger text-white border border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-text fw-bold"><?= $num_shop; ?> คน</h2>
                    <h5 class="card-title">ข้อมูลผู้ใช้ร้านอาหาร</h5>
                    <div class="text-end">
                        <i class="fas fa-hamburger fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rider Users Card -->
        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
            <div class="card bg-warning text-dark border border-0 shadow-sm">
                <div class="card-body">
                    <h2 class="card-text fw-bold"><?= $num_rider; ?> คน</h2>
                    <h5 class="card-title">ข้อมูลผู้จัดส่งอาหาร</h5>
                    <div class="text-end">
                        <i class="fas fa-motorcycle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Types Table -->
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title">ประเภทร้านอาหารทั้งหมด</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ประเภทร้านอาหาร</th>
                            <th>หมายเหตุ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // ดึงข้อมูลประเภทของร้านอาหารจากฐานข้อมูล
                        $sql = $conn->query("SELECT * FROM tb_shop_type");
                        $i = 0;
                        while ($fet = $sql->fetch_object()) {
                            $i++;
                    ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= htmlspecialchars($fet->type_name); ?></td>
                            <td><?= htmlspecialchars($fet->detail); ?></td>
                            <td>
                                <a class="btn btn-primary mx-1"
                                    href="index.php?p=addshop_type&type_id=<?= $fet->type_id; ?>">แก้ไข</a>
                                <button class="btn btn-danger" type="button" data-id="<?= $fet->type_id; ?>"
                                    id="btn-del">ลบ</button>

                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>