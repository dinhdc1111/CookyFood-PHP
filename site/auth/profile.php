<main class="page-container">
    <div class="page-wrapper">
        <h1 class="title-user">Tài khoản của bạn</h1>
        <div class="content-profile">
            <?php
            if (isset($_SESSION['account'])) {
                extract($_SESSION['account']);
            }
            ?>
            <div class="interlist">
                <div class="inter-title">👻 Thông tin tài khoản</div>
                <div class="inter-info-rank"><i class="fa-solid fa-ranking-star"></i> Cấp độ khách hàng: <strong>💎</strong></div>
                <div class="inter-info"><a href="index.php?req=profile-edit"><i class="fa-solid fa-arrows-rotate"></i> Thay đổi thông tin tài khoản</a></div>
                <div class="inter-info"><a href="#"><i class="fa-solid fa-wrench"></i> Thay đổi mật khẩu</a></div>
                <?php if ($role == 1) { ?>
                    <div class="inter-info"><a href="<?= $ADMIN_PATH ?>"><i class="fa-solid fa-key"></i> Trang quản trị</a></div>
                <?php } ?>
                <div class="inter-info"><a href="index.php?req=logout"><i class="fa-solid fa-right-from-bracket"></i> <strong>Đăng xuất</strong></a>
                </div>
            </div>
            <div class="interlist">
                <div class="inter-title">💝 Sản phẩm yêu thích</div>
                <div class="inter-info"><a href="#"><i class="fa-brands fa-gratipay"></i> Sản phẩm yêu thích</a></div>
                <div class="inter-info"><a href="index.php?req=order-history"><i class="fa-solid fa-clock-rotate-left"></i> Lịch sử đơn hàng</a></div>
            </div>
        </div>
    </div>
</main>