<?php
require_once 'pdo.php';

function thong_ke_binh_luan()
{
    $sql = "SELECT hh.ma_hh, hh.ten_hh,"
        . " COUNT(*) so_luong,"
        . " MIN(bl.ngay_bl) cu_nhat,"
        . " MAX(bl.ngay_bl) moi_nhat"
        . " FROM binh_luan bl "
        . " JOIN hang_hoa hh ON hh.ma_hh=bl.ma_hh "
        . " GROUP BY hh.ma_hh, hh.ten_hh"
        . " HAVING so_luong > 0";
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
