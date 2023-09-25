<div class="p-5">
    <h2>Thêm mới danh mục</h2>
    <form action="index.php?req=category-add" method="POST">
        <div class="form-group">
            <label for="categoryName">Tên danh mục</label>
            <input type="text" name="categoryName" id="categoryName" class="form-control">
        </div>
        <?php
        if (isset($alert) && ($alert != "")) echo $alert;
        ?>
        <input type="submit" class="btn btn-primary" name="submit" value="THÊM MỚI" />
        <!-- <div class="mb-3">
            <label for="formFile" class="form-label">Chọn ảnh danh mục</label>
            <input class="form-control" type="file" id="formFile">
        </div> -->
    </form>
</div>