<?php
require_once 'pdo.php';

function category_insert($categoryName)
{
    $sql = "INSERT INTO category(name) VALUES ('$categoryName')";
    pdo_execute($sql);
}
function category_update($id, $categoryName)
{
    $sql = "UPDATE category SET name='" . $categoryName . "' WHERE id=" . $id;
    pdo_execute($sql);
}
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
function category_select_all()
{
    $sql = "SELECT * FROM category ORDER BY id DESC";
    $list_category = pdo_query($sql);
    return $list_category;
}
function category_select_by_id($id)
{
    $sql = "SELECT * FROM category WHERE id =" . $id;
    $category = pdo_query_one($sql);
    return $category;
}
function loai_exist($ma_loai)
{
    $sql = "SELECT count(*) FROM loai WHERE ma_loai=?";
    return pdo_query_value($sql, $ma_loai) > 0;
}
