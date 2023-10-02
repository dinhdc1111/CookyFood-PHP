<?php
require_once 'pdo.php';

function product_insert($productName, $price, $discount, $image, $weight, $description, $category_id)
{
    $created_at = date('Y-m-d H:i:s');
    $sql = "INSERT INTO product(name, price, discount, image, weight, description, category_id, created_at) VALUES ('$productName', '$price', '$discount', '$image', '$weight', '$description', '$category_id', '$created_at')";
    pdo_execute($sql);
}
function product_update($id, $productName, $price, $discount, $image, $weight, $description, $category_id)
{
    $updated_at = date('Y-m-d H:i:s');
    if ($image != "") {
        $sql = "UPDATE product SET name='" . $productName . "', price='" . $price . "', discount='" . $discount . "', image='" . $image . "', weight='" . $weight . "', description='" . $description . "', category_id='" . $category_id . "', updated_at='" . $updated_at . "' WHERE id=" . $id;
    } else {
        $sql = "UPDATE product SET name='" . $productName . "', price='" . $price . "', discount='" . $discount . "', weight='" . $weight . "', description='" . $description . "', category_id='" . $category_id . "', updated_at='" . $updated_at . "' WHERE id=" . $id;
    }
    pdo_execute($sql);
}
function product_delete($id)
{
    $sql = "DELETE FROM product WHERE id =" . $id;
    pdo_execute($sql);
}
function product_select_all($keyword, $category_id)
{
    $sql = "SELECT * FROM product WHERE 1";
    if ($keyword != "") {
        $sql .= " AND name LIKE '%" . $keyword . "%'";
    }
    if ($category_id > 0) {
        $sql .= " AND category_id = '" . $category_id . "'";
    }
    $sql .= " ORDER BY id DESC";
    $list_product = pdo_query($sql);
    return $list_product;
}
function product_select_by_id($id)
{
    $sql = "SELECT * FROM product WHERE id =" . $id;
    $product = pdo_query_one($sql);
    return $product;
}
// Sản phẩm liên quan
function related_products($id, $category_id)
{
    $sql = "SELECT * FROM product WHERE category_id = " . $category_id . " AND id <>" . $id . " LIMIT 0,6";
    $list_product_related = pdo_query($sql);
    return $list_product_related;
}
function select_products_by_param($orderBy, $limit)
{
    $sql = "SELECT * FROM product WHERE 1 ORDER BY $orderBy DESC LIMIT 0,$limit";
    $list_product = pdo_query($sql);
    return $list_product;
}
function product_select_all_no_param(){
    $sql = "SELECT * FROM product ORDER BY id DESC";
    $list_product = pdo_query($sql);
    return $list_product;
}
function product_search_by_keyword($keyword)
{
    $sql = "SELECT * FROM product WHERE 1";
    if ($keyword != "") {
        $sql .= " AND name LIKE '%" . $keyword . "%'";
    }
    $sql .= " ORDER BY id DESC";
    $list_product = pdo_query($sql);
    return $list_product;
}
