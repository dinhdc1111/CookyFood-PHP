<?php
include("../dao/pdo.php");
include("../dao/category.php");
include("../dao/product.php");

include("./layout/header-admin.php");
include("./layout/sidebar-admin.php");
include("./layout/top-navbar.php");
$req = isset($_GET['req']) ? $_GET['req'] : "dashboard";
switch ($req) {
        // Controller category
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
    default:
        include("./dashboard.php");
        break;
}
include("./layout/footer-admin.php");
