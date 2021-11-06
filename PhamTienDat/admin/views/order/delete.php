<?php
$id = $_REQUEST["id"];
$order = loadModel('order');
$row = $order->order_row(['id' => $id, 'status' => 0]);
if ($row == null) {
    set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
    redirect("index.php?option=order&cat=trash");
}
if (file_exists('../public/img/order/' . $row['img'])) {
    unlink('../public/img/order/' . $row['img']);
}
$order->order_delete($id);
set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
redirect("index.php?option=order&cat=trash");
