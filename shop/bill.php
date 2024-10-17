<?php 
session_start();
if(empty($_SESSION['shop_id'])) {
    header("Location: ../login.php");
}
include '../connect.php';
include '../api/function.php';
    require_once __DIR__."/../mpdf/vendor/autoload.php";
    $dCon = (new \Mpdf\Config\ConfigVariables())->getDefaults();
    $dFont = (new \Mpdf\Config\FontVariables())->getDefaults();

    $fontDir = $dCon['fontDir'];
    $fontData = $dFont['fontdata'];
    
    $mpdf = new Mpdf\Mpdf([
        "mode" => "utf8",
        "format" => [120,75],
        "fontDir" => array_merge($fontDir, [ __DIR__.'/tmp' ]),
        "fontdata" => $fontData+[
            "sarabun" => [
                "R" => "THSarabun.ttf",
                "B" => "THSarabun Bold.ttf",
            ],
        ],
            "default_font" => "sarabun",
    ]);

    $mpdf->AddPage("A4");
    $html = '<h2 style="text-align: center; margin: 0; padding: 0;">STC ONLINE</h2>';
    $html .= '<h3 style="text-align: center; margin: 0; padding: 0;">ใบเสร็จคำสั่งซื้อ</h3>';
    $html .= '<p style="text-align: center; margin: 0; padding: 0;">===================</p>';
    $html .= '<table width="100%">';
    $sql_product = $conn->query("SELECT tb_cart.*,tb_product.* FROM tb_cart LEFT JOIN tb_product ON tb_cart.ca_product = tb_product.pro_id WHERE tb_cart.order_id='".$_REQUEST['order_id']."' ");
    $total = 0;
    while($fet_product = $sql_product->fetch_object()) {
    $html .= '<tr>';
    $html .= '<td width="60%">'.$fet_product->pro_name.'<td>';
    $html .= '<td width="10%">@'.$fet_product->ca_qty.'<td>';
    $html .= '<td width="30%">'.$price = sumtotal($fet_product->pro_price, $fet_product->ca_qty, $fet_product->pro_sale).' ฿<td>';
    $html .= '</tr>';
    $total += $price;
    $price = 0;
    }
    $html .= '<tr>';
    $html .= '<td width="60%">รวมเป็นเงินทั้งหมด<td>';
    $html .= '<td width="10%"><td>';
    $html .= '<td width="30%">'.$total.' ฿<td>';
    $html .= '</tr>';
    $html .= '</table>';
    $html .= '<p style="text-align: center; margin: 0; padding: 0;">===================</p>';
    $html .= '<p style="text-align: center; margin: 0; padding: 0;">ข้อมูลผู้สั่ง</p>';
    $sql = $conn->query("SELECT tb_user.*,tb_order.* FROM tb_order LEFT JOIN tb_user ON tb_order.cus_name = tb_user.user_id WHERE tb_order.order_id='".$_REQUEST['order_id']."' ");
    while($fet = $sql->fetch_object()) {
    $html .= '<p style="text-align: center; margin: 0; padding: 0;">'.$fet->fullname.'</p>';
    $html .= '<p style="text-align: center; margin: 0; padding: 0;">'.$fet->address.'</p>';
    $html .= '<p style="text-align: center; margin: 0; padding: 0;">'.$fet->tel.'</p>';
    }
    $html .= '<p style="text-align: center; margin: 0; padding: 0;">===================</p>';
    $html .= '<barcode type="C128A" code="23234-43454-56535" size="0.5"/>';
    $mpdf->WriteHTML($html);
    $mpdf->Output();
?>