<?php
include("../dao/pdo.php");

include("./layout/header-admin.php");
include("./layout/sidebar-admin.php");
include("./layout/top-navbar.php");
$req = isset($_GET['req']) ? $_GET['req'] : "dashboard";
switch ($req) {
    case 'category':
        include("./category/index.php");
        break;
    case 'category-add':
        if (isset($_POST["submit"]) && $_POST["submit"]) {
            $categoryName = $_POST["categoryName"];
            $sql = "INSERT INTO category(name) VALUES ('$categoryName')";
            pdo_execute($sql);
            $alert = "Thêm thành công";
        }
        include("./category/add.php");
        break;
    case 'product':
        include("./product/index.php");
        break;

    default:
        include("./dashboard.php");
        break;
}
include("./layout/footer-admin.php");
