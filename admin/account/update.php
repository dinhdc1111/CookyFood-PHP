<?php
include('./common.php');
if (is_array($account)) {
    extract($account);
}
?>
<div class="p-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Quản lý người dùng</li>
            <li class="breadcrumb-item" aria-current="page">Cập nhật người dùng</li>
        </ol>
    </nav>
    <a class="text-light text-decoration-none btn btn-primary btn-sm mb-3" href="index.php?req=account">
        <i class="fa-solid fa-list-ul"></i> Danh sách người dùng
    </a>
    <form action="index.php?req=account-update" method="POST">
        <div class="form-group">
            <input type="hidden" name="id" id="id" class="form-control" value="<?= isset($id) && $id > 0 ? $id : '' ?>">
            <label for="username">Tên người dùng</label>
            <input type="text" name="username" id="username" class="form-control form-control-sm" value="<?= $username ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm" value="<?= $email ?>">
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" id="address" class="form-control form-control-sm" value="<?= $address ?>">
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" id="phone" class="form-control form-control-sm" value="<?= $phone ?>">
        </div>
        <?php
        if (isset($message_success) && !empty($message_success)) {
            displayToastrMessageSuccess($message_success);
        }
        ?>
        <input type="submit" class="btn btn-primary btn-block" name="submit" value="CẬP NHẬT" />
    </form>
</div>