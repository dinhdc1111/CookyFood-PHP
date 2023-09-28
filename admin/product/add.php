<?php
include('./common.php');
?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Quản lý sản phẩm</li>
            <li class="breadcrumb-item" aria-current="page">Thêm mới sản phẩm</li>
        </ol>
    </nav>
    <a class="text-light text-decoration-none btn btn-primary btn-sm mb-3" href="index.php?req=product">
        <i class="fa-solid fa-list-ul"></i> Danh sách sản phẩm
    </a>
    <form action="index.php?req=product-add" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="productName">Tên sản phẩm</label>
            <input type="text" name="productName" id="productName" class="form-control form-control-sm">
        </div>
        <div class="row">
            <div class="form-group col">
                <label for="price">Giá gốc</label>
                <input type="text" name="price" id="price" class="form-control form-control-sm">
            </div>
            <div class="form-group col">
                <label for="discount">Giảm giá</label>
                <input type="text" name="discount" id="discount" class="form-control form-control-sm">
            </div>
            <div class="form-group col">
                <label for="weight">Trọng lượng (g)</label>
                <input type="text" name="weight" id="weight" class="form-control form-control-sm">
            </div>
        </div>
        <div class="form-group">
            <label for="productName">Danh mục sản phẩm</label>
            <select name="category_id" class="form-select w-25">
                <?php
                foreach ($list_category as $category) {
                    extract($category);
                    echo '<option value="' . $id . '">' . $name . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="image" class="form-label">Chọn ảnh sản phẩm</label>
            <input class="form-control form-control-sm" type="file" id="image" name="image">
        </div>
        <div class="form-group">
            <label for="description">Mô tả sản phẩm</label>
            <textarea class="form-control form-control-sm" name="description" id="description" rows="3"></textarea>
        </div>
        <?php
        if (isset($message_success) && !empty($message_success)) {
            displayToastrMessageSuccess($message_success);
        }
        ?>
        <input type="submit" class="btn btn-primary btn-block" name="submit" value="THÊM MỚI" />
    </form>
</div>