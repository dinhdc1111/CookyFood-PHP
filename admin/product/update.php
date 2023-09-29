<?php
include('./common.php');
if (is_array($product)) {
    extract($product);
}
// Preview image
$pathImage = isset($image) ? "../uploads/{$image}" : "https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg";
// $showImage = is_file($pathImage)
//     ? "<img class='border rounded' src='{$pathImage}' alt='{$name}'height='115' width='115' style='object-fit: cover'/>"
//     : "<img class='border rounded' src='https://res.cloudinary.com/do9rcgv5s/image/upload/v1695895241/cooky%20market%20-%20PHP/itcq4ouly2zgyzxqwmeh.jpg' alt='Không có ảnh' height='115' width='115'>";
// ?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Quản lý sản phẩm</li>
            <li class="breadcrumb-item" aria-current="page">Cập nhật sản phẩm</li>
        </ol>
    </nav>
    <a class="text-light text-decoration-none btn btn-primary btn-sm mb-3" href="index.php?req=product">
        <i class="fa-solid fa-list-ul"></i> Danh sách sản phẩm
    </a>
    <form action="index.php?req=product-update" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group col">
                <input type="hidden" name="id" id="id" class="form-control" value="<?= isset($id) && $id > 0 ? $id : '' ?>">
                <label for="productName">Tên sản phẩm</label>
                <input type="text" name="productName" id="productName" class="form-control form-control-sm" value="<?= $name ?>">
            </div>
            <div class="form-group col">
                <label for="productName">Danh mục</label>
                <select name="category_id" class="form-control form-control-sm">
                    <?php
                    foreach ($list_category as $category) {
                        extract($category);
                        echo '<option value="' . $id . '" ' . ($category_id == $id ? 'selected' : '') . '>' . $name . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="price">Giá gốc</label>
                <input type="number" name="price" id="price" class="form-control form-control-sm" value="<?= $price ?>">
            </div>
            <div class="form-group col">
                <label for="discount">Giảm giá</label>
                <input type="number" name="discount" id="discount" class="form-control form-control-sm" value="<?= $discount ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="weight">Trọng lượng</label>
            <input type="number" name="weight" id="weight" class="form-control form-control-sm" value="<?= $weight ?>">
        </div>
        <div class="form-group">
            <img class='border rounded' id="preview-image" src="<?= $pathImage ?>" alt="<?= $name ?>" height='115' width='115' style='object-fit: cover'>
            <input class="form-control form-control-sm d-none" type="file" id="image" name="image" onchange="previewImage(this)">
            <label for="image" class="form-label label-for-file mt-3">
                <i class="fa-solid fa-file-image"></i>&nbsp;Chọn ảnh
            </label>
        </div>
        <div class="form-group">
            <label for="description">Mô tả sản phẩm</label>
            <textarea class="form-control form-control-sm" name="description" id="description" rows="3"><?= $description ?></textarea>
        </div>
        <?php
        if (isset($message_success) && !empty($message_success)) {
            displayToastrMessageSuccess($message_success);
        }
        ?>
        <input type="submit" class="btn btn-primary btn-block" name="submit" value="CẬP NHẬT" />
    </form>
</div>
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function() {
        $('#image').on('change', function() {
            previewImage(this);
        });
    });
</script>