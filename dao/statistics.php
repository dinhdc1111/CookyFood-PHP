<?php
require_once 'pdo.php';

function statistics_select_all_comment()
{
    $sql = "SELECT product.id, product.name AS product_name, COUNT(comment.id) AS count_comment, MIN(comment.created_at) AS comment_old, MAX(comment.created_at) AS comment_new FROM product LEFT JOIN comment ON product.id = comment.id_product GROUP BY product.id, product.name HAVING count_comment > 0";
    return pdo_query($sql);
}
function statistics_select_all_product()
{
    $sql = "SELECT category.id AS id_category, category.name AS name_category, COUNT(product.id) AS count_product, MIN(product.price) AS min_price, MAX(product.price) AS max_price, AVG(product.price) AS avg_price";
    $sql .= " FROM product LEFT JOIN category ON category.id = product.category_id";
    $sql .= " GROUP BY category.id ORDER BY category.id DESC";
    $list_statistics_product = pdo_query($sql);
    return $list_statistics_product;
}
