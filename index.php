<?php
include("global.php");
include("dao/pdo.php");
include("dao/product.php");
include("dao/category.php");

$newProductList = product_new_select_all();

include("site/header-site.php");
if (isset($_GET['req']) && $_GET['req'] != "") {
    $req = $_GET['req'];
    switch ($req) {
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
