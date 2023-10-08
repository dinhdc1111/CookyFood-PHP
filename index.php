<?php
session_start();
ob_start();

include("global.php");
include("dao/pdo.php");
include("dao/product.php");
include("dao/category.php");
include("dao/account.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');

$newProductList = select_products_by_param("created_at", 12);
$topViewProductList = select_products_by_param("view", 12);
$categoryList = category_select_all_home();
$categoryListProductPage = category_select_all();

include("site/header-site.php");
if (isset($_GET['req']) && $_GET['req'] != "") {
    $req = $_GET['req'];
    switch ($req) {
        case 'product':
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
                if ($category_id == 1) {
                    $categoryDetail['name'] = 'Tất cả';
                    $productList = product_select_all_no_param();
                    include("site/product-list.php");
                } elseif ($category_id > 0) {
                    $categoryDetail = category_select_by_id($category_id);
                    $productList = product_select_all("", $category_id);
                    include("site/product-list.php");
                }
            } else {
                include("site/home-page.php");
            }
            break;
        case 'product-detail':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = $_GET['id'];
                $productDetail = product_select_by_id($id);
                extract($productDetail);
                $categoryDetail = category_select_by_id($category_id);
                $productRelated = related_products($id, $category_id);
                include("site/product-detail.php");
            } else {
                include("site/home-page.php");
            }
            break;
        case 'search':
            if (isset($_GET['keyword']) && $_GET['keyword'] !== "") {
                $searchKeyword = $_GET['keyword'];
                $productList = product_search_by_keyword($searchKeyword);
                include("site/search.php");
            } else {
                include("site/home-page.php");
            }
            break;
        case 'login':
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $check_account = account_check($email, $password);
                if (is_array($check_account)) {
                    $_SESSION['account'] = $check_account;
                    $message_success = "Đăng nhập thành công";
                    header('Location: index.php');
                    exit();
                } else {
                    $message_error = "Tài khoản không tồn tại";
                }
            }
            include("site/auth/login.php");
            break;
        case 'register':
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $email = $_POST['email'];
                $username = $_POST['username'];
                $password = $_POST['password'];

                account_insert($email, $username, $password);
                $message_success = "Đăng ký tài khoản thành công";
            }
            include("site/auth/register.php");
            break;
        case 'profile':
            include("site/auth/profile.php");
            break;
        case 'profile-edit':
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $id = $_POST['id'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];

                account_update($id, $username, $email, $phone, $address);
                $message_success = "Cập nhật thông tin thành công";
                $_SESSION['account'] = account_select_by_id($id);
                // echo '<script>window.location.href = "index.php?req=profile";</script>';
                // exit();
            }
            include("site/auth/profile-edit.php");
            break;
        case 'forgot-password':
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $email = $_POST['email'];
                $email_check = email_check($email);

                $resetCode = substr(md5(rand(100000, 999999)), 0, 10); // 10
                reset_code_update($resetCode, $email);
                if (is_array($email_check)) {
                    $subject = 'Thiết lập lại mật khẩu đăng nhập CookyFood';
                    $message = "<div style='width: 484px; margin: 0 auto; font-size: 15px;'>";
                    $message .= "<div style='text-align: center; margin-bottom: 37px;'><img src='https://res.cloudinary.com/do9rcgv5s/image/upload/v1696750251/cooky%20market%20-%20PHP/extwq2ppklepp82jtwfh.png' alt='Cong Dinh' width='179px'/></div>";
                    $message .= "Xin chào quý khách, <br><br>";
                    $message .= "Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu CookyFood của bạn.<br><br>";
                    $message .= 'Mã xác nhận của bạn là: <strong style="color: #f22726">' . $resetCode . '</strong><br><br>';
                    $message .= "Nếu bạn không yêu cầu thiết lập lại mật khẩu, vui lòng bỏ qua email này.<br><br>";
                    $message .= "Cảm ơn bạn đã tham gia và đồng hành cùng CookyFood.<br><br><br>";
                    $message .= "Trân trọng, <br>";
                    $message .= "Đội ngũ CookyFood";
                    $message .= "</div>";

                    $emailSent = user_send_reset_password($email, $subject, $message);
                    if ($emailSent) {
                        $_SESSION['email'] = $email;
                        $_SESSION['reset_code'] = $resetCode;
                        header('Location: index.php?req=reset-code');
                        exit();
                    } else {
                        $message_error = "Có lỗi xảy ra khi gửi email.";
                    }
                } else {
                    $message_error = "Tài khoản không tồn tại";
                }
            }
            include("site/auth/forgot-password.php");
            break;
        case 'reset-code':
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                if ($_POST['resetCode'] == $_SESSION['reset_code']) {
                    header('Location: index.php?req=reset-password');
                    exit();
                } else {
                    $message_error = "Mã xác nhận không đúng.";
                }
            }
            include("site/auth/reset-code-form.php");
            break;
        case 'reset-password':
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $email = $_SESSION['email'];
                $newPassword = $_POST['newPassword'];
                password_update($newPassword, $email);
                $message_success = "Cập nhật mật khẩu thành công";
                // Remove $_SESSION after completion
                unset($_SESSION['email']);
                unset($_SESSION['reset_code']);
            }
            include("site/auth/reset-password-form.php");
            break;
        case 'about-us':
            include("site/about-us.php");
            break;
        case 'contact-us':
            include("site/contact-us.php");
            break;
        default:
            include("site/home-page.php");
            break;
    }
} else {
    include("site/home-page.php");
}
include("site/footer-site.php");
