<?php
include('./common.php');
?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Quản lý danh mục</li>
            <li class="breadcrumb-item" aria-current="page">Thêm mới danh mục</li>
        </ol>
    </nav>
    <a class="text-light text-decoration-none btn btn-primary btn-sm mb-3" href="index.php?req=category">
        Danh sách danh mục
    </a>
    <form action="index.php?req=category-add" method="POST">
        <div class="form-group">
            <label for="categoryName">Tên danh mục</label>
            <input type="text" name="categoryName" id="categoryName" class="form-control">
        </div>
        <?php
        if (isset($message_success) && !empty($message_success)) {
            displayToastrMessageSuccess($message_success);
        }
        ?>
        <input type="submit" class="btn btn-primary btn-block" name="submit" value="THÊM MỚI" />
        <!-- <div class="mb-3">
            <label for="formFile" class="form-label">Chọn ảnh danh mục</label>
            <input class="form-control" type="file" id="formFile">
        </div> -->
    </form>
</div>