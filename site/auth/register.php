<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <div class="user-wrapper">
                <div class="user-nav">
                    <a href="index.php?req=register" class="activeLogin">Đăng ký</a>
                    <a href="index.php?req=login">Đăng nhập</a>
                </div>
                <form action="index.php?req=register" accept-charset="UTF-8" id="formAcount" method="POST">
                    <div class="form-group input-login">
                        <input type="text" placeholder="Họ và tên" name="username">
                    </div>
                    <small class="message-error"><?= isset($error['username']) ? $error['username'] : "" ?></small>
                    <div class="form-group input-login">
                        <input type="email" placeholder="Email" name="email">
                    </div>
                    <small class="message-error"><?= isset($error['email']) ? $error['email'] : "" ?></small>
                    <div class="form-group input-login">
                        <input type="password" id="pwd" placeholder="********" name="password">
                    </div>
                    <small class="message-error"><?= isset($error['password']) ? $error['password'] : "" ?></small>
                    <?php
                    if (isset($message_success) && !empty($message_success)) {
                        displayToastrMessageSuccess($message_success);
                    }
                    ?>
                    <input type="submit" class="btn-login-register" value="Đăng ký" name="submit">
                </form>
            </div>
        </div>
    </div>
</main>