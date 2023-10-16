<?php
session_start();
ob_start();

include("../dao/pdo.php");
include("../dao/category.php");
include("../dao/product.php");
include("../dao/account.php");
include("../dao/comment.php");
include("../dao/cart.php");
include("../dao/statistics.php");
date_default_timezone_set('Asia/Ho_Chi_Minh');

include("./layout/header-admin.php");
include("./layout/sidebar-admin.php");
include("./layout/top-navbar.php");

// global variable
$ROOT_PATH = '/CookyFood-PHP';
$ADMIN_PATH = "$ROOT_PATH/admin";
$SITE_PATH = "$ROOT_PATH/site";
$imagePath = "uploads/";

$req = isset($_GET['req']) ? $_GET['req'] : "dashboard";
switch ($req) {
        // Controller statistics: Thống kê
    case 'statistics':
        $list_statistics_product = statistics_select_all_product();
        include("./statistics/list.php");
        break;
        // Controller category
    case 'category':
        $list_category = category_select_all();
        include("./category/list.php");
        break;
    case 'category-add':
        if (isset($_POST["submit"]) && $_POST["submit"]) {
            $categoryName = $_POST["categoryName"];

            $image = $_FILES['image']['name'];
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            category_insert($categoryName, $image);
            $message_success = "Đã thêm thành công danh mục";
        }
        include("./category/add.php");
        break;
    case 'category-delete':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            category_delete($_GET['id']);
        }
        $list_category = category_select_all();
        include("./category/list.php");
        break;
    case 'category-detail':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $category = category_select_by_id($_GET['id']);
        }
        include("./category/update.php");
        break;
    case 'category-update':
        if (isset($_POST["submit"]) && $_POST["submit"]) {
            $id = $_POST["id"];
            $categoryName = $_POST["categoryName"];

            $image = $_FILES['image']['name'];
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            category_update($id, $categoryName, $image);
            $message_success = "Cập nhật thành công danh mục";
        }
        $list_category = category_select_all();
        include("./category/list.php");
        break;
        // Controller product
    case 'product':
        $keyword = isset($_POST["search"]) && $_POST["search"] ? $_POST['keyword'] : "";
        $category_id = isset($_POST["search"]) && $_POST["search"] ? $_POST['category_id'] : 0;

        $list_category = category_select_all();
        $list_product = product_select_all($keyword, $category_id);
        include("./product/list.php");
        break;
    case 'product-add':
        if (isset($_POST["submit"]) && $_POST["submit"]) {
            $category_id = $_POST["category_id"];
            $productName = $_POST["productName"];
            $price = $_POST["price"];
            $discount = $_POST["discount"];
            $weight = $_POST["weight"];
            $description = $_POST["description"];

            $image = $_FILES['image']['name'];
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            product_insert($productName, $price, $discount, $image, $weight, $description, $category_id);
            $message_success = "Đã thêm thành công sản phẩm";
        }
        $list_category = category_select_all();
        include("./product/add.php");
        break;
    case 'product-delete':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            product_delete($_GET['id']);
        }
        $list_product = product_select_all("", 0);
        include("./product/list.php");
        break;
    case 'product-detail':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $product = product_select_by_id($_GET['id']);
        }
        $list_category = category_select_all();
        include("./product/update.php");
        break;
    case 'product-update':
        if (isset($_POST["submit"]) && $_POST["submit"]) {
            $id = $_POST["id"];
            $category_id = $_POST["category_id"];
            $productName = $_POST["productName"];
            $price = $_POST["price"];
            $discount = $_POST["discount"];
            $weight = $_POST["weight"];
            $description = $_POST["description"];

            $image = $_FILES['image']['name'];
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            product_update($id, $productName, $price, $discount, $image, $weight, $description, $category_id);
            $message_success = "Cập nhật thành công sản phẩm";
        }
        $list_product = product_select_all("", 0);
        $list_category = category_select_all();
        include("./product/list.php");
        break;
        // Controller account
    case 'account':
        $list_account = account_select_all();
        include("./account/list.php");
        break;
    case 'account-lock':
        $list_account = account_lock_select_all();
        include("./account/list-lock.php");
        break;
    case 'account-delete-soft':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            account_delete_soft($_GET['id']);
        }
        $list_account = account_select_all();
        include("./account/list.php");
        break;
    case 'account-revert':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            account_revert($_GET['id']);
        }
        $list_account = account_select_all();
        include("./account/list.php");
        break;
    case 'account-delete':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            account_delete($_GET['id']);
        }
        $list_account = account_lock_select_all();
        include("./account/list-lock.php");
        break;
    case 'account-detail':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $account = account_select_by_id($_GET['id']);
        }
        include("./account/update.php");
        break;
    case 'account-update':
        if (isset($_POST["submit"]) && $_POST["submit"]) {
            $id = $_POST['id'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];

            $image = $_FILES['image']['name'];
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            account_update($id, $username, $email, $phone, $address, $image);
            $message_success = "Cập nhật thông tin thành công";
        }
        $list_account = account_select_all();
        include("./account/list.php");
        break;
        // Controller comment
    case 'comment':
        $list_comment = comment_select_all(0);
        include("./comment/list.php");
        break;
    case 'comment-delete':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            comment_delete($_GET['id']);
        }
        $list_comment = comment_select_all(0);
        include("./comment/list.php");
        break;
        // Controller order
    case 'order':
        $keyword = isset($_POST['keyword']) && $_POST['keyword'] != "" ? $_POST['keyword'] : "";
        $list_bill = bill_select_all_manager($keyword, 0);
        include("./order/list.php");
        break;
    case 'order-detail':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $order = bill_select_by_id_bill($_GET['id']);
        }
        include("./order/update.php");
        break;
    case 'order-update':
        if (isset($_POST["submit"]) && $_POST["submit"]) {
            $id = $_POST['id'];
            $id_user = $_POST['id_user'];
            $bill_status = $_POST['bill_status'];
            update_bill_status($id, $bill_status);
            $message_success = "Cập nhật trạng thái thành công";
        }
        $list_bill = bill_select_all_manager("", 0);
        include("./order/list.php");
        break;
    case 'logout':
        session_destroy();
        header('Location: ../index.php');
        exit();
        break;
    default:
        $list_statistics_product = statistics_select_all_product();
        include("./statistics/list.php");
        break;
}
include("./layout/footer-admin.php");
