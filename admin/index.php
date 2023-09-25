<?php
    include("./layout/header-admin.php");
    include("./layout/sidebar-admin.php");
    include("./layout/top-navbar.php");
    if(isset($_GET['req'])){
        $req = $_GET['req'];
        switch ($req) {
            case 'category':
                include ("./category/index.php");
                break;
            case 'product':
                include ("./product/index.php");
                break;
            
            default:
                include("./dashboard.php");
                break;
        }
    }
    include("./layout/footer-admin.php");
