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

function binh_luan_delete($ma_bl)
{
    $sql = "DELETE FROM binh_luan WHERE ma_bl=?";
    if (is_array($ma_bl)) {
        foreach ($ma_bl as $ma) {
            pdo_execute($sql, $ma);
        }
    } else {
        pdo_execute($sql, $ma_bl);
    }
}

function comment_select_all($id)
{
    $sql = "SELECT * FROM comment WHERE id_product='" . $id . "' ORDER BY id DESC";
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
// Hiển thị thông tin người dùng comment
function comment_by_id_user($id_user)
{
    $sql = "SELECT account.* FROM account INNER JOIN comment ON account.id = comment.id_user WHERE comment.id_user = " . $id_user;
    return pdo_query($sql);
}
