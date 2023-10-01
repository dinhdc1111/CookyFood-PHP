<?php
include("global.php");
include("dao/pdo.php");
include("dao/product.php");
include("dao/category.php");

$newProductList = select_products_by_param("created_at", 12);
$topViewProductList = select_products_by_param("view", 12);
$categoryList = category_select_all();

include("site/header-site.php");
if (isset($_GET['req']) && $_GET['req'] != "") {
    $req = $_GET['req'];
    switch ($req) {
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
