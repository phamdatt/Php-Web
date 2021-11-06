<?php
$id = $_REQUEST["id"];
$category = loadModel('category');
$row = $category->category_row(['id' => $id, 'status' => 0]);
if ($row == null) {
    set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
    redirect("index.php?option=category&cat=trash");
}
if (file_exists('../public/img/category/' . $row['img'])) {
    unlink('../public/img/category/' . $row['img']);
}
$category->category_delete($id);
set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
redirect("index.php?option=category&cat=trash");
