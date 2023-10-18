<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <?php if (is_array($list_bill)) { ?>
                <div class="title">🧡 Lịch sử đơn hàng 🧡</div>
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Địa chỉ nhận</th>
                            <th>Điện thoại</th>
                            <th>Ngày tạo đơn</th>
                            <th>Tổng giá trị</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $index = 0;
                        foreach ($list_bill as $bill) {
                            $index++;
                            extract($bill);
                            $order_status = get_order_status($bill['bill_status']);
                            $classNameStatus = get_order_status_class($bill['bill_status']);
                            echo '<tr>
                            <td scope="row">
                                ' . $index . '
                            </td>
                            <td class="product-name"><strong>' . $bill['id'] . '</strong></td>
                            <td class="' . $classNameStatus . '">' . $order_status . '</td>
                            <td>' . $bill['bill_address'] . '</td>
                            <td>' . $bill['bill_phone'] . '</td>
                            <td>' . $bill['order_date'] . '</td>
                            <td><strong>' . formatCurrency($bill['total']) . '</strong></td>
                        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <div class="no-cart"><img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1697029851/jbmsxvpg9wpkte8q5ds9.jpg" alt="Hình ảnh giỏ hàng trống">
                    <div class="title">🖤 Giỏ hàng của bạn đang trống 🖤</div>
                    <p>Quay lại <a href="index.php">trang chủ</a> để lựa chọn món ăn</p>
                </div>
            <?php } ?>
        </div>
    </div>
</main>