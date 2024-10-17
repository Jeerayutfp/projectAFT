<div class="col">
    <div class="container">
        <div class="pt-3 py-3">
            <h4>สรุปยอดขาย</h4>
        </div>

        <div class="text-end mb-3">
            <form action="index.php?p=salesum" method="post" class="d-flex">
                <select name="order_date" id="order_date" class="form-select me-2">
                    <option selected>ว/ด/ป</option>
                    <?php 
                $sql_date = $conn->query("SELECT order_date FROM tb_order WHERE order_status = 3");
                while($fet_date = $sql_date->fetch_object()) {
            ?>
                    <option value="<?= $fet_date->order_date; ?>">
                        <?= date("d/m/Y", strtotime($fet_date->order_date)); ?></option>
                    <?php } ?>
                </select>

                <button type="submit" class="btn btn-outline-primary btn-sm">ค้นหา</button>
            </form>
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
                        <th>จำนวน</th>
                        <th>ราคา</th>
                        <th>ส่วนลด</th>
                        <th>ราคารวม</th>
                    </tr>
                </thead>
                <tbody class="align-middle table-group-divider text-primary">
                    <?php 
                    if(isset($_REQUEST['order_date'])) {
                        $where = "AND tb_order.order_date = '".$_REQUEST['order_date']."' ";
                    }else{
                        $where = "";
                    }
                        $sql = $conn->query("SELECT tb_order.*,tb_cart.*,tb_product.*,tb_product_type.type_name FROM tb_order LEFT JOIN tb_cart ON tb_order.order_id = tb_cart.order_id LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id LEFT JOIN tb_product_type ON tb_product.pro_type = tb_product_type.type_id WHERE tb_order.shop_id='".$_SESSION['shop_id']."' AND tb_order.order_status = 3 $where");
                        $i=0;
                        $total = 0;
                        while($fet = $sql->fetch_object()) {
                            $i++;
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td>
                            <img width="100" height="100" class="object-fit-cover rounded"
                                src="../img/product/<?= $fet->pro_img; ?>" alt="">
                        </td>
                        <td><?= $fet->pro_name; ?></td>
                        <td><?= $fet->pro_detail; ?></td>
                        <td><?= $fet->type_name; ?></td>
                        <td><?= $fet->ca_qty; ?> รายการ</td>
                        <td><?= $fet->pro_price; ?>฿</td>
                        <td><?= showSale($fet->pro_sale); ?></td>
                        <td><?= $price = sumtotal($fet->pro_price, $fet->ca_qty, $fet->pro_sale); ?>฿</td>
                    </tr>
                    <?php
                    $total += $price;
                    $price = 0;
                 } 
                 ?>
                </tbody>
            </table>
        </div>

        <div class="text-center py-4">
            <h5 class="fw-bold">ยอดรวมทั้งสิ้น <?= $total; ?> บาท</h5>
        </div>
    </div>
</div>