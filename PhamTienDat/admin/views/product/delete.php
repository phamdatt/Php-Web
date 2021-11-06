<?php
$id = $_REQUEST["id"];
$product = loadModel('product');
$row = $product->product_row(['id'=> $id,'status' => 0]);
if($row==null)
{
    set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
    redirect("index.php?option=product&cat=trash");
}
if(file_exists('../public/img/product/'. $row['img']))
{
    unlink('../public/img/product/'. $row['img']);
}
$product->product_delete($id);
set_flash('message', ['type' => 'success', 'msg' => 'Thay đổi trạng thái thành công!']);
redirect("index.php?option=product&cat=trash");
