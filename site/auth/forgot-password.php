<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <div class="user-wrapper">
                <p class="title-forgot-password">Quên mật khẩu</p>
                <form action="index.php?req=forgot-password" accept-charset="UTF-8" id="formAcount" method="POST">
                    <div class="form-group input-login getPassword">
                        <label for="email">* Nhập địa chỉ email:</label>
                        <input class="input-getPassword" type="email" id="email" placeholder="Email" name="email">
                    </div>
                    <?php
                    if (isset($message_success) && !empty($message_success)) {
                        displayToastrMessageSuccess($message_success);
                    }
                    if (isset($message_error) && !empty($message_error)) {
                        displayToastrMessageError($message_error);
                    }
                    ?>
                    <input type="submit" class="btn-login-register forgotPassword" value="Xác nhận" name="submit">
                </form>
            </div>
        </div>
    </div>
</main>