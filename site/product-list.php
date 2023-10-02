<main class="page-container">
    <div class="page-wrapper">
        <div class="home-page-container">
            <!-- Category List -->
            <div class="short-link-list">
                <div class="swiper-container swiper-container-pointer-events">
                    <div class="swiper-wrapper">
                        <div class="category-slider category-list-product-page">
                            <?php
                            $selectedCategoryId = isset($_GET['category_id']) ? $_GET['category_id'] : null;
                            foreach ($categoryListProductPage as $category) {
                                extract($category);
                                $showImage = !empty($image) ? $imagePath . $image : 'https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg';
                                $linkCategory = "index.php?req=product&category_id=" . $id;
                                $categoryActiveImage = ($id == $selectedCategoryId) ? 'img-fit active' : 'img-fit';
                                $categoryActiveName = ($id == $selectedCategoryId) ? 'label text-ellipsis-two-lines font-weight-bold' : 'label text-ellipsis-two-lines';
                                echo '<div class="category-item category-item-product-page" id="' . $id . '">
                                        <div class="icon">
                                            <a href="' . $linkCategory . '">
                                                <img class="' . $categoryActiveImage . '" src="' . $showImage . '" alt="' . $image . '">
                                            </a>
                                        </div>
                                        <div class="' . $categoryActiveName . '">' . $name . '</div>
                                    </div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product List -->
            <div class="group-product-content">
                <div class="title">✨ Món ăn - <?= $categoryDetail['name'] ?> ✨&nbsp;<small class="total-product"><?= count($productList) ?> sản phẩm</small></div>
                <div class="content-product-container">
                    <div class="promotion-box">
                        <?php
                        $productListLength = count($productList);
                        if ($productListLength == 0) {
                            echo '<div class="no-data-image">
                            <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695886519/cooky%20market%20-%20PHP/e2i0tysgmmogurexye75.jpg" width="505px" alt="No data" />
                            </div>';
                        } else {
                            foreach ($productList as $product) {
                                extract($product);
                                $linkProduct = "index.php?req=product-detail&id=" . $id;
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
                            $linkProduct = "index.php?req=product-detail&id=" . $id;
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