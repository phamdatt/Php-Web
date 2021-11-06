<?php
$id = $_REQUEST["id"];
$contact = loadModel('contact');
$row = $contact->contact_row(['id' => $id]);
if ($row == null) {
    set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
    redirect("index.php?option=contact");
}

$userid = (isset($_SESSION["userid"])) ? $_SESSION["userid"] : 1;
$data = array(
    'status' => 0,
    'updated_by' => $userid,
    'updated_at' => date('Y-m-d H:i:s')
);
$contact->contact_update($data, $id);
set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
redirect("index.php?option=contact");
