<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <div class="user-wrapper">
                <div class="user-nav">
                    <a href="index.php?req=login" class="activeLogin">Đăng nhập</a>
                    <a href="index.php?req=register">Đăng ký</a>
                </div>
                <form action="index.php?req=login" accept-charset="UTF-8" id="formAcount" method="POST">
                    <div class="form-group input-login">
                        <input type="text" placeholder="Nhập email hoặc Tên đăng nhập" name="email">
                    </div>
                    <div class="form-group input-login">
                        <input type="password" id="pwd" placeholder="Mật khẩu" name="password" minlength="6">
                    </div>
                    <?php
                    if (isset($message_success) && !empty($message_success)) {
                        displayToastrMessageSuccess($message_success);
                    }
                    if (isset($message_error) && !empty($message_error)) {
                        displayToastrMessageError($message_error);
                    }
                    ?>
                    <input type="submit" class="btn-login-register" value="Đăng nhập" name="submit">
                </form>
                <div class="user-foot">
                    <a href="#" class="clearfix">Quên mật khẩu?</a>
                    <p class="clearfix">Hoặc đăng nhập với</p>
                    <li class="loginFb">
                        <span>
                            <i class="fa-brands fa-facebook-f"></i>
                        </span>
                        <a href="#">Đăng nhập bằng Facebook</a>
                    </li>
                    <li class="loginGg">
                        <span>
                            <i class="fa-brands fa-google"></i>
                        </span>
                        <a href="#">Đăng nhập bằng Google</a>
                    </li>
                </div>
            </div>
        </div>
    </div>
</main>