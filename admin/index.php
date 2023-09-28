<?php
include("../dao/pdo.php");

include("./layout/header-admin.php");
include("./layout/sidebar-admin.php");
include("./layout/top-navbar.php");
$req = isset($_GET['req']) ? $_GET['req'] : "dashboard";
switch ($req) {
    case 'category':
        $sql = "SELECT * FROM category ORDER BY id DESC";
        $list_category = pdo_query($sql);
        include("./category/list.php");
        break;
    case 'category-add':
        if (isset($_POST["submit"]) && $_POST["submit"]) {
            $categoryName = $_POST["categoryName"];
            $sql = "INSERT INTO category(name) VALUES ('$categoryName')";
            pdo_execute($sql);
            $message_success = "Đã thêm thành công danh mục";
        }
        include("./category/add.php");
        break;
    case 'category-delete':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $sql = "DELETE FROM category WHERE id =" . $_GET['id'];
            pdo_execute($sql);
        }
        $sql = "SELECT * FROM category ORDER BY id DESC";
        $list_category = pdo_query($sql);
        include("./category/list.php");
        break;
    case 'category-detail':
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $sql = "SELECT * FROM category WHERE id =" . $_GET['id'];
            $category = pdo_query_one($sql);
        }
        include("./category/update.php");
        break;
    case 'category-update':
        if (isset($_POST["submit"]) && $_POST["submit"]) {
            $id = $_POST["id"];
            $categoryName = $_POST["categoryName"];
            $sql = "UPDATE category SET name='" . $categoryName . "' WHERE id=" . $id;
            pdo_execute($sql);
            $message_success = "Cập nhật thành công danh mục";
        }
        $sql = "SELECT * FROM category ORDER BY id DESC";
        $list_category = pdo_query($sql);
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
