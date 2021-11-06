<?php
$id = $_REQUEST["id"];
$contact = loadModel('contact');
$row = $contact->contact_row(['id' => $id, 'status' => 0]);
if ($row == null) {
    set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
    redirect("index.php?option=contact&cat=trash");
}
if (file_exists('../public/img/contact/' . $row['img'])) {
    unlink('../public/img/contact/' . $row['img']);
}
$contact->contact_delete($id);
set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
redirect("index.php?option=contact&cat=trash");
