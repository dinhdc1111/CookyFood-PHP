<?php
include('./common.php');
$searchButtonClicked = isset($_POST["search"]) && $_POST["search"];
?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">Quản lý sản phẩm</li>
        </ol>
    </nav>
    <div class="d-flex align-items-center mb-2">
        <a class="text-light text-decoration-none btn btn-primary btn-sm mr-2" href="index.php?req=product-add">
            <i class="fa-solid fa-plus"></i> Thêm mới sản phẩm
        </a>
        <!-- Search & Filter -->
        <form class="form-inline" action="index.php?req=product" method="POST">
            <input type="text" name="keyword" class="form-control form-control-sm mr-1 " placeholder="Tìm kiếm tên theo từ khóa..." style="width: 200px">
            <select name="category_id" class="form-control form-control-sm mr-1">
                <option value="0" selected>Tất cả loại món</option>
                <?php
                foreach ($list_category as $category) {
                    extract($category);
                    echo '<option value="' . $id . '">' . $name . '</option>';
                }
                ?>
            </select>
            <input type="submit" name="search" class="btn btn-primary btn-sm mr-3" value="Tìm kiếm" />
        </form>
        <?php if ($searchButtonClicked) : ?>
            <div id="search-results">
                <?php
                $searchResultCount = count($list_product);
                if ($searchResultCount > 0) {
                    echo '<span><i class="fa-regular fa-lightbulb"></i> Kết quả tìm kiếm: <strong class="text-danger">' . $searchResultCount . '</strong> sản phẩm</span>';
                } else {
                    echo '<span><i class="fa-solid fa-ban"></i> Không có kết quả tìm kiếm.</span>';
                }
                ?>
            </div>
        <?php endif; ?>
    </div>
    <?php if (isset($list_product) && is_array($list_product) && !empty($list_product)) : ?>
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th class="font-weight-bold w-20px" scope="col">#</th>
                    <th class="font-weight-bold" scope="col">ID</th>
                    <th class="font-weight-bold" scope="col">Tên món ăn</th>
                    <th class="font-weight-bold" scope="col">Hình ảnh</th>
                    <th class="font-weight-bold" scope="col">Giá gốc</th>
                    <th class="font-weight-bold" scope="col">Giảm giá</th>
                    <th class="font-weight-bold" scope="col">Trọng lượng (g)</th>
                    <th class="font-weight-bold" scope="col">Lượt xem</th>
                    <th class="font-weight-bold" scope="col">Ngày tạo</th>
                    <th class="font-weight-bold" scope="col">Ngày cập nhật</th>
                    <th class="font-weight-bold" scope="col">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_product as $product) : ?>
                    <?php
                    extract($product);
                    // Format date
                    $formatted_date_create = date('d/m/Y', strtotime($created_at));
                    $formatted_date_update = ($updated_at == "0000-00-00 00:00:00") 
                    ? "<small class='text-primary'>Chưa cập nhật</small>" 
                    : date('d/m/Y', strtotime($updated_at));
                    $pathImage = "../uploads/" . $image;
                    $showImage = is_file($pathImage)
                        ? "<img class='border rounded' src='{$pathImage}' alt='{$name}'height='100' width='100' style='object-fit: cover'/>"
                        : "<img class='border rounded' src='https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg' alt='Không có ảnh' height='100' width='100'>";
                    ?>
                    <tr class="text-center">
                        <td scope="row">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="">
                            </div>
                        </td>
                        <th><?= $id ?></th>
                        <td class="text-primary"><?= $name ?></td>
                        <td><?= $showImage ?></td>
                        <td><?= $price?></td>
                        <td><?= $discount?></td>
                        <td><?= $weight ?></td>
                        <td><?= $view ?></td>
                        <td><?= $formatted_date_create ?></td>
                        <td><?= $formatted_date_update ?></td>
                        <td>
                            <a href="index.php?req=product-delete&id=<?= $id ?>" title="Xóa" class="btn btn-outline-danger btn-sm border border-0 delete-product-button" data-product-id="<?= $id ?>"><i class="fa-regular fa-trash-can"></i></a>
                            <a href="index.php?req=product-detail&id=<?= $id ?>" title="Sửa" class="btn btn-outline-info btn-sm border border-0"><i class="fa-regular fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="text-center mt-4">
            <img src="https://res.cloudinary.com/do9rcgv5s/image/upload/v1695886519/cooky%20market%20-%20PHP/e2i0tysgmmogurexye75.jpg" width="505px" alt="No data" />
        </div>
    <?php endif; ?>
</div>
<script>
    function confirmDelete(productId) {
        Swal.fire({
            title: 'Bạn có chắc chắn xóa?',
            text: 'Bạn sẽ không thể khôi phục lại!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hủy bỏ',
            confirmButtonText: 'Xác nhận',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'index.php?req=product-delete&id=' + productId;
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-product-button');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = button.getAttribute('data-product-id');
                confirmDelete(productId);
            });
        });
    });
</script>