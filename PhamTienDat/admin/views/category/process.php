<?php
$category = loadModel('category');

$userid = (isset($_SESSION["userid"])) ? $_SESSION["userid"] : 1;
if (isset($_POST['THEM'])) {
    $data = array(
        'name' => $_POST['name'],
        'slug' => str_slug($_POST['name']),
        'parentid' => $_POST['parentid'],
        'orders' => ($_POST['orders'] + 1),
        'metakey' => $_POST['metakey'],
        'metadesc' => $_POST['metadesc'],
        'created_at' => date('Y-m-d H:i:s'),
        'created_by' => $userid,
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $userid,
        'status' => $_POST['status'],
    );
    $category->category_insert($data);
    set_flash('message', ['type' => 'success', 'msg' => ' Thêm Thành công!']);
    redirect("index.php?option=category");
}
if (isset($_POST['CAPNHAT'])) {
    $id = $_REQUEST['id'];
    $category = loadModel('category');
    $row = $category->category_row(['id' => $id]);
    if ($row == null) {
        set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        redirect("index.php?option=category");
    }
    $data = array(
        'name' => $_POST['name'],
        'slug' => str_slug($_POST['name']),
        'parentid' => $_POST['parentid'],
        'orders' => ($_POST['orders'] + 1),
        'metakey' => $_POST['metakey'],
        'metadesc' => $_POST['metadesc'],

        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $userid,
        'status' => $_POST['status'],
    );
    $category->category_update($data, $id);
    set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công!']);
    redirect("index.php?option=category");
}
