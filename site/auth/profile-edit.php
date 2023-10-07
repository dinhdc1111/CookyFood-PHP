<main class="page-container">
    <div class="page-wrapper">
        <h1 class="title-user">Thông tin cá nhân</h1>
        <div class="form-container">
            <?php
            if ($_SESSION['account'] && is_array($_SESSION['account'])) {
                extract($_SESSION['account']);
            }
            ?>
            <form action="index.php?req=profile-edit" class="form" method="POST">
                <input type="hidden" name="id" value="<?= $id ?>" />
                <div class="row">
                    <label class="label" for="username">Họ tên:</label>
                    <input class="input" type="text" name="username" id="username" placeholder="Họ tên" value="<?= $username ?>" />
                </div>
                <div class="row">
                    <label class="label" for="email">Email:</label>
                    <input class="input" type="email" name="email" id="email" placeholder="Email" value="<?= $email ?>" />
                </div>
                <div class="row">
                    <label class="label" for="address">Địa chỉ:</label>
                    <input class="input" type="text" name="address" id="address" placeholder="Địa chỉ chi tiết" value="<?= $address ?>" />
                </div>
                <div class="row">
                    <label class="label" for="phone">Điện thoại:</label>
                    <input class="input" type="text" name="phone" id="phone" placeholder="Số điện thoại" value="<?= $phone ?>" />
                </div>
                <?php
                if (isset($message_success) && !empty($message_success)) {
                    displayToastrMessageSuccess($message_success);
                }
                ?>
                <div class="form-group-button">
                    <input name="submit" class="btn" type="submit" value="Cập nhật" />
                    <a class="btn" href="index.php?req=profile">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</main>