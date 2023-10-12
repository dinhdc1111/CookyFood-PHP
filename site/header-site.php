<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cooky Market | Cooky</title>
    <link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&display=swap" rel="stylesheet">
    <link href="https://db.onlinewebfonts.com/c/5ad142d0e49ca868b1530c30a47c625f?family=SF+UI+Text+Regular" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Reset CSS -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer-home.css">
    <link rel="stylesheet" href="assets/css/page-container.css">
    <link rel="stylesheet" href="assets/css/product-detail.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" href="assets/css/comment-form.css">
    <link rel="stylesheet" href="assets/css/signin-signup.css">
    <link rel="stylesheet" href="assets/css/view-cart.css">
    <link rel="stylesheet" href="assets/css/checkout.css">
    <link rel="stylesheet" href="vendors/wowJS/css/libs/animate.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- Library -->
    <script src="vendors/wowJS/dist/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <!-- Toaster -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
</head>

<body>
    <div id="app">
        <header class="header">
            <div class="navigation-bar">
                <div class="logo">
                    <a href="index.php">
                        <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695381181/cooky%20market%20-%20PHP/cva2ntghjzrlryixcojp.svg" alt="Logo Cooky">
                    </a>
                </div>
                <div class="search-input">
                    <img class="icon-search" src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695381877/cooky%20market%20-%20PHP/lieirqymxmairjpyhrwj.svg" alt="Magnifying Glass">
                    <input tabindex="0" type="text" id="search-input" placeholder="Tìm kiểm sản phẩm...">
                </div>
                <div class="user">
                    <div class="download-app-button">
                        Tải App Cooky
                        <div class="phone-hover">
                            <div class="phone-hover-text">
                                <span>- Đặt hàng dễ dàng hơn</span>
                                <span>- Theo dõi chi tiết đơn hàng</span>
                            </div>
                        </div>
                    </div>
                    <div class="wishlist action n-btn" title="Danh sách yêu thích">
                        <img class="icon" src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695386250/cooky%20market%20-%20PHP/v9hhpbadxib71owdbfkh.svg" alt="Wishlist">
                    </div>
                    <button class="cart-icon action n-btn" title="Giỏ hàng">
                        <a href="index.php?req=view-cart"><img class="icon" src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695386172/cooky%20market%20-%20PHP/fcmcexgvocebzmhuntfm.svg" alt="Cart"></a>
                    </button>
                    <div class="phone action n-btn">
                        <a href="tel:19002041">
                            <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695386173/cooky%20market%20-%20PHP/u5u581opcqe1nlesw2bn.svg" alt="Hotline" class="icon">
                        </a>
                    </div>
                    <div class="hotline action view-city">
                        <span class="user-name">Hà Nội</span>
                        <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695387068/cooky%20market%20-%20PHP/ww9hqjdjddhfcrgdiokz.svg" alt="toggle" class="icon toggle">
                    </div>
                    <div class="hotline action login">
                        <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695381877/cooky%20market%20-%20PHP/wb5pyhdq2alh6cx8ml82.svg" alt="Login" class="icon">
                        <?php
                        $username = isset($_SESSION['account']['username']) ? $_SESSION['account']['username'] : 'Đăng nhập';
                        $url = isset($_SESSION['account']['username']) ? 'profile' : 'login';
                        echo '<span class="user-name"><a href="index.php?req=' . $url . '">' . $username . '</a></span>';
                        ?>
                    </div>
                </div>
            </div>
        </header>
        <!-- search product name by keyword -->
        <script>
            document.getElementById('search-input').addEventListener('keyup', function(event) {
                if (event.key === 'Enter') {
                    var searchValue = this.value;
                    window.location.href = 'index.php?req=search&keyword=' + encodeURIComponent(searchValue);
                }
            });
        </script>