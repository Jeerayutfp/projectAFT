<div class="container rounded-3 bg-white shadow-sm mt-3 border-3 border-warning border-top">
    <h4 class="fw-bold text-center pt-3">ประวัติการสั่งซื้อ</h4>

    <div class="table-responsive mt-3">
        <table class="table table-sm table-hover text-center">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>รูปภาพสินค้า</th>
                    <th>ร้าน</th>
                    <th>รายการอาหาร</th>
                    <th>รายละเอียด</th>
                    <th>หมวดหมู่อาหาร</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                    <th>ส่วนลด</th>
                    <th>ราคารวม</th>
                    <th>สถานะ</th>
                    <th>รีวิว</th>
                </tr>
            </thead>
            <tbody class="align-middle table-group-divider text-primary">
                <?php 
                    $sql = $conn->query("SELECT tb_order.*,tb_cart.*,tb_product.*,tb_product_type.type_name,tb_shop.shop_name FROM tb_order LEFT JOIN tb_cart ON tb_order.order_id = tb_cart.order_id LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id LEFT JOIN tb_product_type ON tb_product.pro_type = tb_product_type.type_id LEFT JOIN tb_shop ON tb_product_type.shop_id = tb_shop.shop_id WHERE tb_order.cus_name = '".$_SESSION['user_id']."'");
                    $i=0;
                    while($fet = $sql->fetch_object()) {
                        $i++;
                ?>   
            <tr>
                    <td><?= $i; ?></td>
                    <td>
                        <img width="100" height="100" class="object-fit-cover rounded" src="../img/product/<?= $fet->pro_img; ?>" alt="">
                    </td>
                    <td><?= $fet->shop_name; ?></td>
                    <td><?= $fet->pro_name; ?></td>
                    <td><?= $fet->pro_detail; ?></td>
                    <td><?= $fet->type_name; ?></td>
                    <td><?= $fet->ca_qty; ?> รายการ</td>
                    <td><?= $fet->pro_price;  ?>฿</td>
                    <td><?= showSale($fet->pro_sale); ?></td>
                    <td><?= sumtotal($fet->pro_price, $fet->ca_qty, $fet->pro_sale); ?>฿</td>
                    <td><?= order_status($fet->order_status); ?></td>
                    <td>
                        <?php
                            $sql_re = $conn->query("SELECT * FROM tb_review WHERE re_user='".$_SESSION['user_id']."' AND re_shop='".$fet->shop_id."' AND re_product='".$fet->pro_id."' AND re_order='".$fet->order_id."' ");
                            $num = $sql_re->num_rows;
                            if ($num <= 0) {
                             
                        ?>
                        <button id="btn-review" data-id="<?= $fet->order_id; ?>" data-pro="<?= $fet->pro_id; ?>" data-shop="<?= $fet->shop_id; ?>" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#ReviewModal" aria-expanded="false" <?php 
                            if($fet->order_status != 3){
                                echo "disabled";
                            }
                        ?>>ให้คะแนนรีวิว</button>
                        <?php 
                    }else{ 
                        echo "รีวิวแล้ว";
                    }
                        
                        ?>
                            
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div> 
</div>

<div class="modal fade" id="ReviewModal" tabindex="-1" aria-label="modallabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ให้คะแนนรีวิว</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="../api/ac_review.php" method="post" id="frm_review" novalidate>
                    <div class="mt-1">
                        <label class="form-label" for="">คะแนนรีวิว:</label><br>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="re_point" id="re_point" class="form-check-input" value="5" required>

                            <input type="hidden" name="order_id" id="order_id1">
                            <input type="hidden" name="pro_id" id="pro_id1">
                            <input type="hidden" name="shop_id" id="shop_id1">

                            <label for="" class="form-check-label">ดีมาก</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="re_point" id="re_point" class="form-check-input" value="4" required>
                            <label for="" class="form-check-label">ดี</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="re_point" id="re_point" class="form-check-input" value="3" required>
                            <label for="" class="form-check-label">พอใช้</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="re_point" id="re_point" class="form-check-input" value="2" required>
                            <label for="" class="form-check-label">แย่</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="re_point" id="re_point" class="form-check-input" value="1" required>
                            <label for="" class="form-check-label">ปรับปรุง</label>
                        </div>
                        
                        <div class="invalid-feedback">
                            โปรดใส่ข้อมูลดังกล่าวก่อนกดยืนยัน
                        </div>
                    </div>

                    <div class="mt-2">
                        <label for="" class="form-label">ความคิดเห็น</label>
                        <textarea name="detail" id="detail" cols="30" rows="3" class="form-control" required placeholder="กรอกความคิดเห็น"></textarea>
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