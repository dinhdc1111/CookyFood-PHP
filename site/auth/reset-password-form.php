<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <div class="user-wrapper">
                <p class="title-forgot-password">Đặt lại mật khẩu</p>
                <form action="index.php?req=reset-password" accept-charset="UTF-8" id="resetPasswordForm" method="POST">
                    <div class="form-group input-login getPassword">
                        <label for="newPassword">* Nhập mật khẩu mới:</label>
                        <input class="input-getPassword" type="password" id="newPassword" placeholder="Mật khẩu mới" name="newPassword">
                    </div>
                    <?php
                    if (isset($message_success) && !empty($message_success)) {
                        displayToastrMessageSuccess($message_success);
                    }
                    ?>
                    <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
                    <input type="submit" class="btn-login-register resetPassword" value="Đặt lại mật khẩu" name="submit">
                </form>

            </div>
        </div>
    </div>
</main>