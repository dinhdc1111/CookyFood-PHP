<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <div class="user-wrapper">
                <div class="user-nav">
                    <a href="index.php?req=register" class="activeLogin">Đăng ký</a>
                    <a href="index.php?req=login">Đăng nhập</a>
                </div>
                <form accept-charset="UTF-8" id="formAcount" method="POST">
                    <div class="form-group input-login">
                        <input type="text" required="true" placeholder="Họ và tên" name="fullname">
                    </div>
                    <div class="form-group input-login">
                        <input type="email" required="true" placeholder="Email" name="email">
                    </div>
                    <div class="form-group input-login">
                        <input type="password" required="true" id="pwd" placeholder="Mật khẩu của bạn" name="password" minlength="6">
                    </div>
                    <div class="form-group input-login">
                        <input type="password" required="true" id="confirmation_pwd" placeholder="Xác nhận mật khẩu của bạn" minlength="6">
                    </div>
                    <button class="btn-login-register">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</main>