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
include("dao/cart.php");

if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];

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
            // Validate form login
            $error = [];
            $data = [];
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $data['email'] = isset($_POST['email']) ? $_POST['email'] : "";
                $data['password'] = isset($_POST['password']) ? $_POST['password'] : "";
                // Validate email
                if (empty($data['email'])) {
                    $error['email'] = "* Email không được để trống";
                } else if (!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $data['email'])) {
                    $error['email'] = '* Vui lòng nhập lại, email không đúng định dạng';
                } else if (!account_exist($data['email'])) {
                    $error['email'] = "* Email chưa được đăng ký thành viên";
                }
                // Validate password
                if (empty($data['password'])) {
                    $error['password'] = "* Mật khẩu không được để trống";
                } else if (strlen($data['password']) < 6) {
                    $error['password'] = "* Mật khẩu phải có ít nhất 6 ký tự";
                }
                if (!$error) {
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
            }
            include("site/auth/login.php");
            break;
        case 'register':
            // Validate form register
            $error = [];
            $data = [];
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $data['username'] = isset($_POST['username']) ? $_POST['username'] : "";
                $data['email'] = isset($_POST['email']) ? $_POST['email'] : "";
                $data['password'] = isset($_POST['password']) ? $_POST['password'] : "";
                // Validate username
                if (empty($data['username'])) {
                    $error['username'] = "* Tên người dùng không được để trống";
                } else if (username_exist($data['username'])) {
                    $error['username'] = "* Tên người dùng đã tồn tại trong hệ thống";
                }
                // Validate email
                if (empty($data['email'])) {
                    $error['email'] = "* Email không được để trống";
                } else if (!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $data['email'])) {
                    $error['email'] = 'Vui lòng nhập lại, email không đúng định dạng';
                } else if (account_exist($data['email'])) {
                    $error['email'] = "* Email đã tồn tại trong hệ thống";
                }
                // Validate password
                if (empty($data['password'])) {
                    $error['password'] = "* Mật khẩu không được để trống";
                } else if (strlen($data['password']) < 6) {
                    $error['password'] = "* Mật khẩu phải có ít nhất 6 ký tự";
                }
                if (!$error) {
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    account_insert($email, $username, $password);
                    $message_success = "Đăng ký tài khoản thành công";
                }
            }
            include("site/auth/register.php");
            break;
        case 'profile':
            include("site/auth/profile.php");
            break;
        case 'profile-edit':
            // Validate form profile-edit
            $error = [];
            $data = [];
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $data['username'] = isset($_POST['username']) ? $_POST['username'] : "";
                $data['email'] = isset($_POST['email']) ? $_POST['email'] : "";
                $data['address'] = isset($_POST['address']) ? $_POST['address'] : "";
                $data['phone'] = isset($_POST['phone']) ? $_POST['phone'] : "";
                // Validate username
                if (empty($data['username'])) {
                    $error['username'] = "* Tên người dùng không được để trống";
                }
                // Validate email
                if (empty($data['email'])) {
                    $error['email'] = "* Email không được để trống";
                } else if (!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $data['email'])) {
                    $error['email'] = '* Vui lòng nhập lại, email không đúng định dạng';
                }
                // Validate address
                if (empty($data['address'])) {
                    $error['address'] = "* Địa chỉ người dùng không được để trống";
                }
                // Validate phone
                if (empty($data['phone'])) {
                    $error['phone'] = "* Số điện thoại không được để trống";
                } else if (!preg_match('/(84|0[3|5|7|8|9])+([0-9]{8})\b/', $data['phone'])) {
                    $error['phone'] = 'Vui lòng nhập lại, số điện thoại không đúng định dạng';
                }
                if (!$error) {
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
            }
            include("site/auth/profile-edit.php");
            break;
        case 'forgot-password':
            // Validate form forgot-password
            $error = [];
            $data = [];
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $data['email'] = isset($_POST['email']) ? $_POST['email'] : "";
                // Validate email
                if (empty($data['email'])) {
                    $error['email'] = "* Email không được để trống";
                } else if (!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $data['email'])) {
                    $error['email'] = '* Vui lòng nhập lại, email không đúng định dạng';
                } else if (!account_exist($data['email'])) {
                    $error['email'] = "* Email chưa được đăng ký thành viên";
                }
                if (!$error) {
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
                    }
                }
            }
            include("site/auth/forgot-password.php");
            break;
            // Mã xác nhận
        case 'reset-code':
            // Validate form reset-code
            $error = [];
            $data = [];
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $data['resetCode'] = isset($_POST['resetCode']) ? $_POST['resetCode'] : "";
                if (empty($data['resetCode'])) {
                    $error['resetCode'] = "* Mã xác nhận không được để trống";
                } else if ($_POST['resetCode'] != $_SESSION['reset_code']) {
                    $error['resetCode'] = "* Mã xác nhận không chính xác";
                }
                if (!$error) {
                    header('Location: index.php?req=reset-password');
                    exit();
                }
            }
            include("site/auth/reset-code-form.php");
            break;
            // Đặt lại mật khẩu
        case 'reset-password':
            // Validate form reset-password
            $error = [];
            $data = [];
            if (isset($_POST['submit']) && ($_POST['submit'])) {
                $data['newPassword'] = isset($_POST['newPassword']) ? $_POST['newPassword'] : "";
                // Validate password
                if (empty($data['newPassword'])) {
                    $error['newPassword'] = "* Mật khẩu không được để trống";
                } else if (strlen($data['newPassword']) < 6) {
                    $error['newPassword'] = "* Mật khẩu phải có ít nhất 6 ký tự";
                }
                if (!$error) {
                    $email = $_SESSION['email'];
                    $newPassword = $_POST['newPassword'];
                    password_update($newPassword, $email);
                    $message_success = "Cập nhật mật khẩu thành công";
                    // Remove $_SESSION after completion
                    unset($_SESSION['email']);
                    unset($_SESSION['reset_code']);
                }
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
        case 'add-to-cart':
            if (isset($_POST['add-to-cart']) && ($_POST['add-to-cart'])) {
                $id = $_POST['id']; // 0
                // Kiểm tra xem sản phẩm có tồn tại trong giỏ hàng không
                $productExists = false;
                $cartLength = count($_SESSION['cart']);
                for ($i = 0; $i < $cartLength; $i++) {
                    if ($_SESSION['cart'][$i][0] == $id) {
                        // Sản phẩm đã tồn tại, cập nhật số lượng
                        $_SESSION['cart'][$i][6] += 1;
                        $_SESSION['cart'][$i][7] = $_SESSION['cart'][$i][6] * $_SESSION['cart'][$i][2];
                        $productExists = true;
                        break;
                    }
                }
                // Sản phẩm không tồn tại, thêm mới vào giỏ hàng
                if (!$productExists) {
                    $name = $_POST['name']; // 1
                    $price = $_POST['price']; // 2
                    $discount = $_POST['discount']; // 3
                    $weight = $_POST['weight']; // 4
                    $image = $_POST['image']; // 5
                    $quantityDefault = 1; // 6
                    $totalMoney = ($discount == 0) ? $quantityDefault * $price : $quantityDefault * $discount; // 7

                    $arrayProductAdd = [$id, $name, $price, $discount, $weight, $image, $quantityDefault, $totalMoney];
                    array_push($_SESSION['cart'], $arrayProductAdd);
                }
            }
            include("site/cart/view-cart.php");
            break;
        case 'delete-cart':
            if (isset($_GET['id-cart'])) {
                // Delete 1 item cart
                array_splice($_SESSION['cart'], $_GET['id-cart'], 1);
            } else {
                // Delete all cart
                $_SESSION['cart'] = [];
            }
            header('Location: index.php?req=view-cart');
            break;
        case 'view-cart':
            include("site/cart/view-cart.php");
            break;
        case 'checkout':
            include("site/cart/checkout.php");
            break;
        case 'complete':
            // Create bill
            if (isset($_POST['agree-to-order']) && ($_POST['agree-to-order'])) {
                // Người dùng hoặc khách vãng lai
                $id_user = (isset($_SESSION['account'])) ? $_SESSION['account']['id'] : 0;
                $username = $_POST['username'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $note = $_POST['note'];
                $pay_method = $_POST['pay-method'];
                $order_date = date('Y-m-d H:i:s');
                $total_order = getTotalOrder();
                // Create bill
                $id_bill = bill_insert($id_user, $username, $address, $phone, $note, $email, $pay_method, $order_date, $total_order);
                // insert into cart
                foreach ($_SESSION['cart'] as $cart) {
                    $priceProduct = ($cart[3] == 0) ? $cart[2] : $cart[3];
                    cart_insert($_SESSION['account']['id'], $cart[0], $cart[5], $cart[1], $priceProduct, $cart[6], $cart[7], $id_bill);
                }
                // Thông tin người mua
                $customer_invoice_info = bill_select_by_id_bill($id_bill);
                // Chi tiết hóa đơn giỏ hàng
                $detail_invoice_info = cart_select_by_id_bill($id_bill);
                $_SESSION['cart'] = [];
            }
            include("site/cart/complete.php");
            break;
        case 'order-history':
            $list_bill = bill_select_all($_SESSION['account']['id']);
            include("site/cart/order-history.php");
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
