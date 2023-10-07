<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <div class="user-wrapper">
                <p class="title-forgot-password">Mã xác thực</p>
                <form action="index.php?req=reset-code" id="resetCodeForm" method="POST">
                    <div class="form-group input-login getPassword">
                        <label for="resetCode">* Nhập mã xác nhận:</label>
                        <input class="input-getPassword" type="text" id="resetCode" placeholder="Mã xác nhận" name="resetCode">
                    </div>
                    <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">
                    <input type="submit" class="btn-login-register resetCode" value="Xác nhận" name="submit">
                </form>
            </div>
        </div>
    </div>
</main>