<?php
$id = $_REQUEST["id"];
$topic = loadModel('topic');
$row = $topic->topic_row(['id' => $id]);
if ($row == null) {
    set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
    redirect("index.php?option=topic&cat=trash");
}

$userid = (isset($_SESSION["userid"])) ? $_SESSION["userid"] : 1;
$data = array(
    'status' => 2,
    'updated_by' => $userid,
    'updated_at' => date('Y-m-d H:i:s')
);
$topic->topic_update($data, $id);
set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
redirect("index.php?option=topic&cat=trash");
