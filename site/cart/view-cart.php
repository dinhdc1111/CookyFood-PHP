<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <div class="title">🧡 Giỏ hàng của bạn 🧡</div>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên món</th>
                        <th>Trọng lượng</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tạm tính</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalAllCart = 0;
                    $totalPayPriceOriginal = 0;
                    foreach ($_SESSION['cart'] as $cart) {
                        $showImage = $imagePath . $cart[5];
                        $totalMoney = ($cart[3] == 0) ? ($cart[2] * $cart[6]) : ($cart[3] * $cart[6]);
                        $payPriceOriginal = $cart[2] * $cart[6];
                        // Format money
                        $formatPrice = formatCurrency($cart[2]);
                        $formatDiscount = formatCurrency($cart[3]);
                        $formatTotalMoney = formatCurrency($totalMoney);
                        $totalAllCart += $totalMoney;
                        $totalPayPriceOriginal += $payPriceOriginal;
                        $formatTotalAllCart = formatCurrency($totalAllCart);
                        $formatTotalPayPriceOriginal = formatCurrency($totalPayPriceOriginal);
                        echo '<tr>
                            <td scope="row">
                                <img src="' . $showImage . '" alt="Ảnh sản phẩm" width="100" height="100">
                            </td>
                            <td class="product-name"><strong>' . $cart[1] . '</strong></td>
                            <td>' . $cart[4] . '(g)</td>
                            ';
                        if ($cart[3] == 0) {
                            echo '<td class="price-product">' . $formatPrice . '</td>';
                        } else {
                            echo '<td class="price-product">' . $formatDiscount . ' <small class="price-origin">' . $formatPrice . '</small></td>';
                        }
                        echo '
                            <td class="quantity-product">' . $cart[6] . '</td>
                            <td>' . $formatTotalMoney . '</td>
                            <td>Xóa</td>
                        </tr>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="shopping-cart-wrapper">
                <div class="continue-shopping">
                    <a href="#">Tiếp tục mua hàng</a>
                </div>
                <div class="clear-cart-all">
                    <a href="#">Xóa giỏ hàng</a>
                </div>
            </div>
            <div class="grand-total">
                <div class="title-wrap">
                    <h4 class="cart-bottom-title">Tổng số giỏ hàng</h4>
                </div>
                <h5>Giá gốc: <span><?= $formatTotalPayPriceOriginal ?></span></h5>
                <h4 class="grand-total-title">Tổng cộng: <span><?= $formatTotalAllCart ?></span></h4>
                <a href="#">Tiến hành đặt hàng</a>
            </div>
        </div>
    </div>
</main>