<?php
require_once 'pdo.php';

/**
 * Thêm loại mới
 * @param String $categoryName là tên loại
 * @throws PDOException lỗi thêm mới
 */
function category_insert($categoryName)
{
    $sql = "INSERT INTO category(name) VALUES ('$categoryName')";
    pdo_execute($sql);
}
/**
 * Cập nhật tên loại
 * @param int $ma_loai là mã loại cần cập nhật
 * @param String $categoryName là tên loại mới
 * @throws PDOException lỗi cập nhật
 */
function category_update($id, $categoryName)
{
    $sql = "UPDATE category SET name='" . $categoryName . "' WHERE id=" . $id;
    pdo_execute($sql);
}
/**
 * Xóa một hoặc nhiều loại
 * @param mix $ma_loai là mã loại hoặc mảng mã loại
 * @throws PDOException lỗi xóa
 */
function category_delete($id)
{
    $sql = "DELETE FROM category WHERE id =" . $id;
    pdo_execute($sql);
    // if (is_array($ma_loai)) {
    //     foreach ($ma_loai as $ma) {
    //         pdo_execute($sql, $ma);
    //     }
    // } else {
    //     pdo_execute($sql, $ma_loai);
    // }
}
/**
 * Truy vấn tất cả các loại
 * @return array mảng loại truy vấn được
 * @throws PDOException lỗi truy vấn
 */
function category_select_all()
{
    $sql = "SELECT * FROM category ORDER BY id DESC";
    $list_category = pdo_query($sql);
    return $list_category;
}
/**
 * Truy vấn một loại theo mã
 * @param int $ma_loai là mã loại cần truy vấn
 * @return array mảng chứa thông tin của một loại
 * @throws PDOException lỗi truy vấn
 */
function category_select_by_id($id)
{
    $sql = "SELECT * FROM category WHERE id =" . $id;
    $category = pdo_query_one($sql);
    return $category;
}
/**
 * Kiểm tra sự tồn tại của một loại
 * @param int $ma_loai là mã loại cần kiểm tra
 * @return boolean có tồn tại hay không
 * @throws PDOException lỗi truy vấn
 */
function loai_exist($ma_loai)
{
    $sql = "SELECT count(*) FROM loai WHERE ma_loai=?";
    return pdo_query_value($sql, $ma_loai) > 0;
}
