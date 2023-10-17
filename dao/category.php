<?php
require_once 'pdo.php';

function category_insert($categoryName, $image)
{
    $created_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO category(name, image, created_at) VALUES ('$categoryName', '$image', '$created_at')";
    pdo_execute($sql);
}
function category_update($id, $categoryName, $image)
{
    $updated_at = date('Y-m-d H:i:s');
    if ($image != "") {
        $sql = "UPDATE category SET name='" . $categoryName . "', image='" . $image . "', updated_at='" . $updated_at . "' WHERE id=" . $id;
    } else {
        $sql = "UPDATE category SET name='" . $categoryName . "', updated_at='" . $updated_at . "' WHERE id=" . $id;
    }
    pdo_execute($sql);
}

function category_delete($id)
{
    $sql = "DELETE FROM category WHERE id =" . $id;
    pdo_execute($sql);
}
// Ẩn danh mục "Tất cả" HomePage
function category_select_all_home()
{
    $sql = "SELECT * FROM category ORDER BY id ASC LIMIT 1,12";
    $list_category = pdo_query($sql);
    return $list_category;
}
function category_select_all()
{
    $sql = "SELECT * FROM category ORDER BY id ASC";
    $list_category = pdo_query($sql);
    return $list_category;
}
function category_select_by_id($id)
{
    $sql = "SELECT * FROM category WHERE id =" . $id;
    $category = pdo_query_one($sql);
    return $category;
}
function category_exist($name)
{
    $sql = "SELECT count(*) FROM category WHERE name=?";
    return pdo_query_value($sql, $name) > 0;
}
