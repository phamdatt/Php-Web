<?php
$id = $_REQUEST["id"];
$order = loadModel('order');
$row = $order->order_row(['id' => $id]);
if ($row == null) {
    set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
    redirect("index.php?option=order");
}
$tt = ($row['status'] == 1) ? 2 : 1;
$userid = (isset($_SESSION["userid"])) ? $_SESSION["userid"] : 1;
$data = array(
    'status' => $tt,
    'updated_by' => $userid,
    'updated_at' => date('Y-m-d H:i:s')
);
$order->order_update($data, $id);
set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
redirect("index.php?option=order");
