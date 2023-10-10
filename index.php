<?php
session_start();
ob_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');

include("global.php");
include("dao/pdo.php");

include("dao/product.php");
include("dao/category.php");
include("dao/account.php");
include("dao/comment.php");

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
                $list_comment = comment_select_all($id);
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
                    $message_error = "Thông tin tài khoản không chính xác hoặc đã bị vô hiệu hóa";
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

                $image = $_FILES['image']['name'];
                $target_dir = "./uploads/";
                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                account_update($id, $username, $email, $phone, $address, $image);
                $message_success = "Cập nhật thông tin thành công";
                $_SESSION['account'] = account_select_by_id($id);
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
                    $emailSent = user_send_reset_password($email, $resetCode);
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
            // Mã xác nhận
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
            // Đặt lại mật khẩu
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
        case 'add-comment':
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $content = $_POST['content'];
                $id_product = $_POST['id_product'];
                $id_user = $_SESSION['account']['id'];
                $created_at = date('Y-m-d H:i:s');
                comment_insert($content, $id_user, $id_product, $created_at);
                header("Location: " . $_SERVER['HTTP_REFERER']);
            }
            include("site/comment/comment-form.php");
            break;
        case 'logout':
            session_destroy();
            header('Location: index.php');
            exit();
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
