<div class="col">
    <div class="container">
        <div class="pt-3 py-3">
            <h4>รายการอาหาร <small class="text-muted">Menu</small></h4>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#AddProductModal" aria-expanded="false">เพิ่มรายการอาหาร</button>
        </div>

        <div class="table-responsive">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>ลำดับ</th>
                        <th>รูปสินค้า</th>
                        <th>รายการอาหาร</th>
                        <th>รายละเอียด</th>
                        <th>หมวดหมู่อาหาร</th>
                        <th>ราคา</th>
                        <th>ส่วนลด</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody class="align-middle table-group-divider text-primary">
                    <?php 
                        $sql = $conn->query("SELECT tb_product.*,tb_product_type.type_name FROM tb_product LEFT JOIN tb_product_type ON tb_product.pro_type = tb_product_type.type_id WHERE tb_product.shop_id='".$_SESSION['shop_id']."' ");
                        $i=0;
                        while($fet = $sql->fetch_object()) {
                            $i++;
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <img width="100" height="100" class="object-fit-cover rounded" src="../img/product/<?= $fet->pro_img; ?>" alt="">
                        </td>
                        <td><?= $fet->pro_name; ?></td>
                        <td><?= $fet->pro_detail; ?></td>
                        <td><?= $fet->type_name; ?></td>
                        <td><?= $fet->pro_price; ?>฿</td>
                        <td><?= showSale($fet->pro_sale); ?></td>
                        <td>
                            <button class="btn btn-sm dropdown-toggle btn-warning" data-bs-toggle="dropdown">จัดการ</button>

                            <ul class="dropdown-menu">
                                <li>
                                    <button id="btn-edit" data-id="<?= $fet->pro_id; ?>" data-name="<?= $fet->pro_name; ?>" data-detail="<?= $fet->pro_detail; ?>" data-price="<?= $fet->pro_price; ?>" data-sale="<?= $fet->pro_sale; ?>" data-type="<?= $fet->pro_type; ?>" type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#EditProductModal" aria-expanded="false">แก้ไข</button>
                                </li>
                                <li>
                                    <button id="btn-addSale" data-id="<?= $fet->pro_id; ?>" data-sale="<?= $fet->pro_sale; ?>" type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#AddSaleProductModal" aria-expanded="false">เพิ่มส่วนลด</button>
                                </li>
                                <li>
                                    <button type="button" data-id="<?= $fet->pro_id; ?>" id="btn-del" class="dropdown-item">ลบ</button>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="AddProductModal" tabindex="-1" aria-labelledby="modallabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">เพิ่มรายการอาหาร</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="../api/ac_product.php?ac=add" method="post" enctype="multipart/form-data" id="frm_product" novalidate>
                    <div class="mt-1">
                        <label for="" class="form-label">รายการอาหาร</label>
                        <input type="text" name="pro_name" id="pro_name" class="form-control" required placeholder="กรอกชื่อรายการอาหาร">
                        <div class="invalid-feedback">
                            โปรดกรอกชื่อรายการอาหารของท่าน
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">รายละเอียด</label>
                        <input type="text" name="pro_detail" id="pro_detail" class="form-control" required placeholder="กรอกรายละเอียด">
                        <div class="invalid-feedback">
                            โปรดกรอกรายละเอียดสินค้าของท่าน
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">หมวดหมู่อาหาร</label>
                        <select name="pro_type" id="pro_type" class="form-select">
                            <option disabled selected>เลือกหมวดหมู่อาหาร</option>
                            <?php 
                                $sql_type = $conn->query("SELECT * FROM tb_product_type WHERE shop_id='".$_SESSION['shop_id']."' ");
                                while($fet_type = $sql_type->fetch_object()) {
                            ?>
                            <option value="<?= $fet_type->type_id; ?>"><?= $fet_type->type_name; ?></option>
                            <?php }  ?>
                        </select>

                        <div class="invalid-feedback">
                            โปรดเลือกหมวดหมู่อาหารของท่าน
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">ราคา</label>
                        <input type="number" name="pro_price" id="pro_price" class="form-control" required placeholder="กรอกราคาสินค้า">
                        <div class="invalid-feedback">
                            โปรดกรอกราคาสินค้าของท่าน
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">ส่วนลด (%)</label>
                        <input type="number" name="pro_sale" id="pro_sale" class="form-control" required placeholder="กรอกส่วนลดสินค้า">
                        <div class="invalid-feedback">
                            โปรดกรอกส่วนลดสินค้าของท่าน
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">รูปภาพสินค้า</label>
                        <input type="file" name="pro_img" id="pro_img" class="form-control" required>
                        <div class="invalid-feedback">
                            โปรดเลือกรูปภาพสินค้าของท่าน
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success">ยืนยัน</button>
                        <a data-bs-dismiss="modal" class="btn btn-dark">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="EditProductModal" tabindex="-1" aria-labelledby="modallabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">แก้ไขรายการอาหาร</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <form class="needs-validation" action="../api/ac_product.php?ac=edit" method="post" enctype="multipart/form-data" id="frm_product" novalidate>
                    <div class="mt-1">
                        <label for="" class="form-label">รายการอาหาร</label>
                        <input type="text" name="pro_name" id="pro_name1" class="form-control" required placeholder="กรอกชื่อรายการอาหาร">
                        <input type="hidden" name="pro_id" id="pro_id1">
                        <div class="invalid-feedback">
                            โปรดกรอกชื่อรายการอาหารของท่าน
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">รายละเอียด</label>
                        <input type="text" name="pro_detail" id="pro_detail1" class="form-control" required placeholder="กรอกรายละเอียด">
                        <div class="invalid-feedback">
                            โปรดกรอกรายละเอียดสินค้าของท่าน
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">หมวดหมู่อาหาร</label>
                        <select name="pro_type" id="pro_type1" class="form-select">
                            <option disabled selectd>เลือกหมวดหมู่อาหาร</option>
                            <?php 
                                $sql_type1 = $conn->query("SELECT * FROM tb_product_type WHERE shop_id='".$_SESSION['shop_id']."' ");
                                while($fet_type1 = $sql_type1->fetch_object()) {
                            ?>
                            <option value="<?= $fet_type1->type_id; ?>"><?= $fet_type1->type_name; ?></option>
                            <?php }  ?>
                        </select>

                        <div class="invalid-feedback">
                            โปรดเลือกหมวดหมู่อาหารของท่าน
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">ราคา</label>
                        <input type="number" name="pro_price" id="pro_price1" class="form-control" required placeholder="กรอกราคาสินค้า">
                        <div class="invalid-feedback">
                            โปรดกรอกราคาสินค้าของท่าน
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">ส่วนลด (%)</label>
                        <input type="number" name="pro_sale" id="pro_sale1" class="form-control" required placeholder="กรอกส่วนลดสินค้า">
                        <div class="invalid-feedback">
                            โปรดกรอกส่วนลดสินค้าของท่าน
                        </div>
                    </div>
                    <div class="mt-2">
                        <label for="" class="form-label">รูปภาพสินค้า</label>
                        <input type="file" name="pro_img" id="pro_img" class="form-control" required>
                        <div class="invalid-feedback">
                            โปรดเลือกรูปภาพสินค้าของท่าน
                        </div>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success">ยืนยัน</button>
                        <a data-bs-dismiss="modal" class="btn btn-dark">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="AddSaleProductModal" tabindex="-1" aria-labelledby="modallabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">เพิ่มส่วนลดสินค้า</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="../api/ac_product.php?ac=addSale" method="post" id="frm_addSale" enctype="multipart/form-data" novalidate>
                    <div class="mt-2">
                        <label for="" class="form-label">ส่วนลด (%)</label>
                        <input type="number" name="pro_sale" id="pro_sale2" class="form-control" required placeholder="กรอกส่วนลดสินค้า">
                        <input type="hidden" name="pro_id" id="pro_id2">
                        <div class="invalid-feedback">
                            โปรดกรอกส่วนลดสินค้าของท่าน
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success">ยืนยัน</button>
                        <a data-bs-dismiss="modal" class="btn btn-dark">ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>