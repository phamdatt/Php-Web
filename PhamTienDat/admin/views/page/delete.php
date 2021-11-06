<?php
$id = $_REQUEST["id"];
$post = loadModel('post');
$row = $post->post_row(['id'=> $id,'status' => 0]);
if($row==null)
{
    set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
    redirect("index.php?option=page&cat=trash");
}
if(file_exists('../public/img/page/'. $row['img']))
{
    unlink('../public/img/page/'. $row['img']);
}
$post->post_delete($id);
set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
redirect("index.php?option=page&cat=trash");
