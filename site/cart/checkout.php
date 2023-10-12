<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <h1 class="title-user">Thanh toán</h1>
            <div class="checkout-page">
                <div class="form-container checkout-page-form">
                    <h2 class="title-user">Thông tin giao hàng</h2>
                    <?php
                    $username = isset($_SESSION['account']['username']) ? $_SESSION['account']['username'] : "";
                    $email = isset($_SESSION['account']['email']) ? $_SESSION['account']['email'] : "";
                    $address = isset($_SESSION['account']['address']) ? $_SESSION['account']['address'] : "";
                    $phone = isset($_SESSION['account']['phone']) ? $_SESSION['account']['phone'] : "";
                    ?>
                    <form action="index.php?req=profile-edit" class="form" method="POST">
                        <input type="hidden" name="id" value="<?= $id ?>" />
                        <div class="row">
                            <input class="input" type="text" name="username" id="username" placeholder="Họ tên" value="<?= $username ?>" />
                        </div>
                        <div class="row">
                            <input class="input" type="email" name="email" id="email" placeholder="Email" value="<?= $email ?>" />
                        </div>
                        <div class="row">
                            <input class="input" type="text" name="address" id="address" placeholder="Địa chỉ chi tiết" value="<?= $address ?>" />
                        </div>
                        <div class="row">
                            <input class="input" type="text" name="phone" id="phone" placeholder="Số điện thoại" value="<?= $phone ?>" />
                        </div>
                        <div class="form-group-button">
                            <input name="submit" class="btn" type="submit" value="Cập nhật" />
                            <a class="btn" href="index.php?req=view-cart">Quay lại</a>
                        </div>
                    </form>
                </div>
                <div class="order-form">
                    <h2 class="title-user order-title">Đơn hàng của bạn</h2>
                    <div class="grand-total order-content">
                        <div class="title-wrap">
                            <h4 class="cart-bottom-title">Tổng số giỏ hàng</h4>
                        </div>
                        <h5>Món ăn của bạn 💝</h5>
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
                            echo '
                            <div class="item-cart-product">
                            <div class="item-image-order">
                                <img src="' . $showImage . '" alt="Sản phẩm giỏ hàng" width="40px" height="40px">
                            </div>
                            <div class="item-name-order">
                                <p>' . $cart[1] . '</p>
                            </div>
                            <div class="item-quantity-order">x' . $cart[6] . '</div>
                            <div class="item-price-order">';
                            if ($cart[3] == 0) {
                                echo '<span>' . $formatPrice . '</span>';
                            } else {
                                echo '<span>' . $formatDiscount . ' <small class="price-origin">' . $formatPrice . '</small></td>';
                            }
                            echo '</div>
                        </div>
                            ';
                        }
                        ?>
                        <h5>Giá gốc: <span>
                                <?= $formatTotalPayPriceOriginal ?>
                            </span></h5>
                        <h4 class="grand-total-title">Tổng cộng: <span>
                                <?= $formatTotalAllCart ?>
                            </span></h4>
                        <!-- <a href="index.php?req=checkout">Tiến hành đặt hàng</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>