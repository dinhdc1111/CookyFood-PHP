<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <!-- Slideshow -->
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://image.cooky.vn/abn/s1065x333/600d94ae-f782-43ad-9c7a-e6c60f78ade5.png" alt="Image 1">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://image.cooky.vn/abn/s1065x333/bd6d53fa-c2e0-41ea-8549-804612e47770.png" alt="Image 2">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://image.cooky.vn/abn/s1065x333/3b913681-79ef-49e5-afca-502686632208.png" alt="Image 3">
                    </div>
                </div>
            </div>
            <!-- Category List -->
            <div class="short-link-list">
                <div class="swiper-container swiper-container-pointer-events">
                    <div class="swiper-wrapper">
                        <div class="category-slider">
                            <?php
                            foreach ($categoryList as $category) {
                                extract($category);
                                $showImage = !empty($image) ? $imagePath . $image : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
                                $linkCategory = "index.php?req=product&category_id=" . $id;
                                echo '<div class="category-item">
                                        <div class="icon">
                                            <a href="' . $linkCategory . '">
                                                <img class="img-fit" src="' . $showImage . '" alt="' . $image . '">
                                            </a>
                                        </div>
                                        <div class="label text-ellipsis-two-lines">' . $name . '</div>
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New Product List -->
            <div class="group-product-content">
                <div class="title">✨ Món ăn mới nhất ✨</div>
                <div class="content-product-container">
                    <div class="promotion-box">
                        <!-- New Product List -->
                        <?php
                        foreach ($newProductList as $product) {
                            extract($product);
                            $linkProduct = "index.php?req=product&id=" . $id;
                            $showImage = !empty($image) ? $imagePath . $image : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
                            $formatCurrencyPrice = formatCurrency($price);
                            $formatCurrencyDiscount = formatCurrency($discount);

                            $displayPrice = ($discount == 0) ? $formatCurrencyPrice : $formatCurrencyDiscount;
                            echo '
                                <div class="product-basic-info">
                                    <a class="link-absolute" title="' . $name . '" href="' . $linkProduct . '"></a>
                                    <div class="cover-box">
                                        <div class="promotion-photo">
                                            <div class="package-default">
                                                <img src="' . $showImage . '" alt="' . $name . '" loading="lazy" class="img-fit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="promotion-name two-lines">' . $name . '</div>
                                    <div class="d-flex-center-middle">
                                        <div class="price-action">
                                            <div class="product-weight">' . $weight . 'g</div>
                                            <div class="d-flex-align-items-baseline">
                                            <div class="sale-price">' . $displayPrice . '</div>';
                            echo ($discount == 0)
                                ? ''
                                : '<div class="unti-price">' . $formatCurrencyPrice . '</div>';
                            echo '
                                            </div>
                                        </div>
                                        <div class="button-add-to-cart" title="Thêm vào giỏ hàng">
                                            <div>
                                                <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695381877/cooky%20market%20-%20PHP/r8rvqbn5onuryh7hstio.svg" alt="Thêm vào giỏ hàng">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Product List by view -->
            <div class="group-product-content">
                <div class="title">❤️️ Món ăn yêu thích ❤️️</div>
                <div class="content-product-container">
                    <div class="promotion-box">
                        <!-- Product List by view -->
                        <?php
                        foreach ($topViewProductList as $product) {
                            extract($product);
                            $linkProduct = "index.php?req=product&id=" . $id;
                            $showImage = !empty($image) ? $imagePath . $image : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
                            $formatCurrencyPrice = formatCurrency($price);
                            $formatCurrencyDiscount = formatCurrency($discount);

                            $displayPrice = ($discount == 0) ? $formatCurrencyPrice : $formatCurrencyDiscount;
                            echo '
                                <div class="product-basic-info">
                                    <a class="link-absolute" title="' . $name . '" href="' . $linkProduct . '"></a>
                                    <div class="cover-box">
                                        <div class="promotion-photo">
                                            <div class="package-default">
                                                <img src="' . $showImage . '" alt="' . $name . '" loading="lazy" class="img-fit">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="promotion-name two-lines">' . $name . '</div>
                                    <div class="d-flex-center-middle">
                                        <div class="price-action">
                                            <div class="product-weight">' . $weight . 'g</div>
                                            <div class="d-flex-align-items-baseline">
                                            <div class="sale-price">' . $displayPrice . '</div>';
                            echo ($discount == 0)
                                ? ''
                                : '<div class="unti-price">' . $formatCurrencyPrice . '</div>';
                            echo '
                                            </div>
                                        </div>
                                        <div class="button-add-to-cart" title="Thêm vào giỏ hàng">
                                            <div>
                                                <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695381877/cooky%20market%20-%20PHP/r8rvqbn5onuryh7hstio.svg" alt="Thêm vào giỏ hàng">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>