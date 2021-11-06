<?php
$id = $_REQUEST["id"];
$topic = loadModel('topic');
$row = $topic->topic_row(['id' => $id, 'status' => 0]);
if ($row == null) {
    set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
    redirect("index.php?option=topic&cat=trash");
}
if (file_exists('../public/img/topic/' . $row['img'])) {
    unlink('../public/img/topic/' . $row['img']);
}
$topic->topic_delete($id);
set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
redirect("index.php?option=topic&cat=trash");
