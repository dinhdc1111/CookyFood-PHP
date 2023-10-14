<?php
if (isset($customer_invoice_info) && is_array($customer_invoice_info)) {
    extract($customer_invoice_info);
}
if (isset($detail_invoice_info) && is_array($detail_invoice_info)) {
    extract($detail_invoice_info);
}
?>
<div class="invoice-detail">
    <h1 class="title-user">Hóa đơn chi tiết</h1>
    <div class="form-invoice">
        <table border="1">
            <tr>
                <td colspan="2" class="col-2">Mã đơn: <strong><?= $customer_invoice_info['id'] ?></strong></td>
                <td colspan="2" class="col-2 text-right"><strong>Thời gian đặt:
                        <?= $customer_invoice_info['order_date'] ?></strong>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-center"><img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1697033902/cooky%20market%20-%20PHP/sri9li0oetshdwb4esa4.jpg" alt="Logo cooky.vn" width="150px" class="logo-cooky">
                    <p class="font-weight-bold"> Thực Phẩm Tươi Sống & Pack Món Nấu Ngay</p>
                    <p>Phố Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội</p>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <p><strong>Tên khách hàng:</strong>
                        <?= $customer_invoice_info['bill_name'] ?></p>
                    <p><strong>Số điện thoại:</strong>
                        <?= $customer_invoice_info['bill_phone'] ?></p>
                    <p><strong>Địa chỉ:</strong>
                        <?= $customer_invoice_info['bill_address'] ?></p>
                    <p><strong>Hình thức thanh toán:</strong>
                        <?= $customer_invoice_info['bill_pay_method'] == 1 ? 'Thanh toán khi nhận hàng' : 'Thanh toán online' ?></p>
                </td>
            </tr>
            <tr class="text-center">
                <td class="font-weight-bold">STT</td>
                <td class="font-weight-bold">Món ăn</td>
                <td class="font-weight-bold">Số lượng</td>
                <td class="font-weight-bold">Giá</td>
            </tr>
            <?php
            foreach ($detail_invoice_info as $product) {
                echo '<tr class="text-center">
                    <td>' . $product['id'] . '</td>
                    <td>' . $product['name'] . '</td>
                    <td>' . $product['quantity'] . '</td>
                    <td>' . formatCurrency($product['into_money']) . '</td>
                </tr>';
            }
            ?>
            <tr>
                <td colspan="2" class="text-center"><strong>Tổng đơn</strong></td>
                <td colspan="2" class="text-center"><strong><?= formatCurrency($customer_invoice_info['total']) ?></strong></td>
            </tr>
        </table>
    </div>
    <form method="post" action="generate_invoice_pdf.php" class="btn-print-invoice">
        <input type="hidden" value="<?= $id_bill ?>" name="id_bill"/>
        <input type="submit" name="print_invoice" value="In hóa đơn">
    </form>
</div>