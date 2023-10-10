<?php
require_once 'pdo.php';

function comment_insert($content, $id_user, $id_product, $created_at)
{
    $sql = "INSERT INTO comment(content, id_user, id_product, created_at) VALUES ('$content','$id_user','$id_product','$created_at')";
    pdo_execute($sql);
}

function binh_luan_update($ma_bl, $ma_kh, $ma_hh, $noi_dung, $ngay_bl)
{
    $sql = "UPDATE binh_luan SET ma_kh=?,ma_hh=?,noi_dung=?,ngay_bl=? WHERE ma_bl=?";
    pdo_execute($sql, $ma_kh, $ma_hh, $noi_dung, $ngay_bl, $ma_bl);
}

function comment_delete($id)
{
    $sql = "DELETE FROM comment WHERE id =" . $id;
    pdo_execute($sql);
}

function comment_select_all($id)
{
    $sql = "SELECT * FROM comment WHERE 1";
    if ($id > 0) {
        $sql .= " AND id_product='" . $id . "'";
    }
    $sql .= " ORDER BY id DESC";
    $list_comment = pdo_query($sql);
    return $list_comment;
}

function binh_luan_select_by_id($ma_bl)
{
    $sql = "SELECT * FROM binh_luan WHERE ma_bl=?";
    return pdo_query_one($sql, $ma_bl);
}

function binh_luan_exist($ma_bl)
{
    $sql = "SELECT count(*) FROM binh_luan WHERE ma_bl=?";
    return pdo_query_value($sql, $ma_bl) > 0;
}
//-------------------------------//
function binh_luan_select_by_hang_hoa($ma_hh)
{
    $sql = "SELECT b.*, h.ten_hh FROM binh_luan b JOIN hang_hoa h ON h.ma_hh=b.ma_hh WHERE b.ma_hh=? ORDER BY ngay_bl DESC";
    return pdo_query($sql, $ma_hh);
}
// Lấy người dùng theo comment
function comment_by_id_user($id_user)
{
    $sql = "SELECT account.* FROM account INNER JOIN comment ON account.id = comment.id_user WHERE comment.id_user = " . $id_user;
    return pdo_query($sql);
}
// Lấy người dùng và sản phẩm theo comment
function comment_by_user_and_product($id_user, $id_product)
{
    $sql = "SELECT account.*, product.* FROM account INNER JOIN comment ON account.id = comment.id_user INNER JOIN product ON comment.id_product = product.id WHERE comment.id_user = '" . $id_user . "' AND comment.id_product = " . $id_product;
    return pdo_query($sql);
}
