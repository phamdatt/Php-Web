<?php
$id = $_REQUEST["id"];
$user = loadModel('user');
$row = $user->user_row(['id'=> $id,'status' => 0]);
if($row==null)
{
    set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
    redirect("index.php?option=user&cat=trash");
}
if(file_exists('../public/img/user/'. $row['img']))
{
    unlink('../public/img/user/'. $row['img']);
}
$user->user_delete($id);
set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
redirect("index.php?option=user&cat=trash");
