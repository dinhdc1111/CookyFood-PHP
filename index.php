<?php
include("global.php");
include("dao/pdo.php");
include("dao/product.php");
include("dao/category.php");

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
            include("site/auth/login.php");
            break;
        case 'register':
            include("site/auth/register.php");
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
