<?php
// Import DomPDF library
require_once 'vendors/dompdf/vendor/autoload.php';

include("global.php");
include("dao/pdo.php");

include("dao/cart.php");

use Dompdf\Dompdf;
use Dompdf\Options;

if (isset($_POST['print_invoice'])) {
    $id_bill = $_POST['id_bill'];
    // Thông tin người mua
    $customer_invoice_info = bill_select_by_id_bill($id_bill);
    // Chi tiết hóa đơn giỏ hàng
    $detail_invoice_info = cart_select_by_id_bill($id_bill);
    $options = new Options();
    $options->set('isPhpEnabled', true);
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isFontSubsettingEnabled', true);
    $options->set('defaultFont', 'DejaVu Sans');
    $dompdf = new Dompdf($options);

    $html = '<!DOCTYPE html><html lang="en">';
    $html .= '<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn khách hàng</title>
    <style>
        .form-invoice table {
            width: 100%;
            line-height: 30px;
            border-collapse: collapse;
            margin: 40px auto;
        }
        .logo-text{
            font-size: 29px;
        }
        .logo-text,
        .slogan{
            color: #f22726;
            font-weight: bold;
        }
        .address{
            font-size: 16px;
            font-style: italic;
        }
        .font-weight-bold{
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .form-invoice table td {
            border: 1px solid #000;
        }
        .col-2 {
            width: 50%;
        }
        .product-name{
            width:265px;
        }
    </style>
</head>';
    $html .= '<body>
    <div class="container">
    <div class="form-invoice">
        <table border="1">
            <tr>
                <td colspan="2" class="col-2">Mã đơn: <strong>
                        ' . $customer_invoice_info['id'] . '
                    </strong></td>
                <td colspan="2" class="col-2 text-right"><strong>Thời gian đặt:
                        ' . $customer_invoice_info['order_date'] . '
                    </strong>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-center">
                    <h1>Hóa đơn mua hàng</h1>
                    <div class="logo-text">
                    <div class="logo-name">Cooky Food</div>
                    </div>
                    <p class="slogan"> Thực Phẩm Tươi Sống & Pack Món Nấu Ngay</p>
                    <p class="address">Địa chỉ: Phố Trịnh Văn Bô, Xuân Phương, Nam Từ Liêm, Hà Nội</p>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <p><strong>Tên khách hàng:</strong>
                        ' . $customer_invoice_info['bill_name'] . '
                    </p>
                    <p><strong>Số điện thoại:</strong>
                        ' . $customer_invoice_info['bill_phone'] . '
                    </p>
                    <p><strong>Địa chỉ:</strong>
                        ' . $customer_invoice_info['bill_address'] . '
                    </p>
                    <p><strong>Hình thức thanh toán:</strong>
                        ' . ($customer_invoice_info['bill_pay_method'] == 1 ? 'Thanh toán khi nhận hàng' : 'Thanh toán online') . '
                    </p>
                </td>
            </tr>
            <tr class="text-center">
                <td class="font-weight-bold">STT</td>
                <td class="font-weight-bold product-name">Món ăn</td>
                <td class="font-weight-bold">Số lượng</td>
                <td class="font-weight-bold">Giá</td>
            </tr>';
    foreach ($detail_invoice_info as $product) {
        $html .= '<tr class="text-center">
            <td>' . $product['id'] . '</td>
            <td>' . $product['name'] . '</td>
            <td>' . $product['quantity'] . '</td>
            <td>' . formatCurrency($product['into_money']) . '</td>
        </tr>';
    }
    $html .= '<tr>
                <td colspan="2" class="text-center col-2"><strong>Tổng đơn</strong></td>
                <td colspan="2" class="text-center col-2"><strong>
                        ' . formatCurrency($customer_invoice_info['total']) . '
                    </strong></td>
            </tr>
        </table>
    </div>
</body>';
    $html .= '</html>';

    // Nạp mã HTML vào DomPDF và render tài liệu PDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Lưu hoặc trả về tài liệu PDF
    $dompdf->stream('hoadon_cookyfood.pdf');
}
