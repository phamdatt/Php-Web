<?php
$id = $_REQUEST["id"];
$menu = loadModel('menu');
$row = $menu->menu_row(['id' => $id, 'status' => 0]);
if ($row == null) {
    set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
    redirect("index.php?option=menu&cat=trash");
}
if (file_exists('../public/img/menu/' . $row['img'])) {
    unlink('../public/img/menu/' . $row['img']);
}
$menu->menu_delete($id);
set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
redirect("index.php?option=menu&cat=trash");
