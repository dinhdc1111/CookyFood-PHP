<?php
include("../dao/pdo.php");
include("../dao/category.php");

include("./layout/header-admin.php");
include("./layout/sidebar-admin.php");
include("./layout/top-navbar.php");
$req = isset($_GET['req']) ? $_GET['req'] : "dashboard";
switch ($req) {
    case 'category':
        $list_category = category_select_all();
        include("./category/list.php");
        break;
    case 'category-add':
        if (isset($_POST["submit"]) && $_POST["submit"]) {
            $categoryName = $_POST["categoryName"];
            category_insert($categoryName);
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
            category_update($id, $categoryName);
            $message_success = "Cập nhật thành công danh mục";
        }
        $list_category = category_select_all();
        include("./category/list.php");
        break;
    case 'product':
        include("./product/index.php");
        break;

    default:
        include("./dashboard.php");
        break;
}
include("./layout/footer-admin.php");
