<?php
$userid = (isset($_SESSION["userid"])) ? $_SESSION["userid"] : 1;
$menu = loadModel('menu');


if (isset($_POST['THEMCATEGORY'])) {
    $category = loadModel('category');
    if (!isset($_POST['nameCategory'])) {
        set_flash('message', ['type' => 'danger', 'msg' => 'Chưa chọn loại sản phẩm']);
        redirect("index.php?option=menu");
    }
    $listid = $_POST['nameCategory'];

    foreach ($listid as $id) {
        $row = $category->category_row(['id' => $id]);
        $data = array(
            'name' => $row['name'],
            'link' => 'index.php?option=product&cat=' . $row['slug'],
            'type' => 'category',
            'tableid' => $row['id'],
            'orders' => 1,
            'position' => $_POST['position'],
            'parentid' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $userid,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $userid,
            'status' => 2

        );
        $menu->menu_insert($data);
        $data = null;
    }
    set_flash('message', ['type' => 'success', 'msg' => 'Thêm menu thành công!']);
    redirect("index.php?option=menu");
}
if (isset($_POST['THEMTOPIC'])) {
    $topic = loadModel('topic');
    if (!isset($_POST['nameTopic'])) {
        set_flash('message', ['type' => 'danger', 'msg' => 'Chưa chọn chủ đề bài viết']);
        redirect("index.php?option=menu");
    }
    $listid = $_POST['nameTopic'];
    foreach ($listid as $id) {
        $row = $topic->topic_row(['id' => $id]);
        $data = array(
            'name' => $row['name'],
            'link' => 'index.php?option=post&cat=' . $row['slug'],
            'type' => 'topic',
            'tableid' => $row['id'],
            'orders' => 1,
            'position' => $_POST['position'],
            'parentid' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $userid,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $userid,
            'status' => 2

        );
        $menu->menu_insert($data);
        $data = null;
    }
    set_flash('message', ['type' => 'success', 'msg' => 'Thêm menu thành công!']);
    redirect("index.php?option=menu");
}
if (isset($_POST['THEMPAGE'])) {
    $post = loadModel('post');
    if (!isset($_POST['namePage'])) {
        set_flash('message', ['type' => 'danger', 'msg' => 'Chưa chọn trang đơn']);
        redirect("index.php?option=menu");
    }
    $listid = $_POST['namePage'];
    foreach ($listid as $id) {
        $row = $post->post_row(['id' => $id, 'type' => 'page']);
        $data = array(
            'name' => $row['title'],
            'link' => 'index.php?option=page&cat=' . $row['slug'],
            'type' => 'page',
            'tableid' => $row['id'],
            'orders' => 1,
            'position' => $_POST['position'],
            'parentid' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $userid,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $userid,
            'status' => 2

        );
        $menu->menu_insert($data);
        $data = null;
    }
    set_flash('message', ['type' => 'success', 'msg' => 'Thêm menu thành công!']);
    redirect("index.php?option=menu");
}
if (isset($_POST['THEMCUSTOM'])) {
    if (empty($_POST['name'] || $_POST['link'])) {
        set_flash('message', ['type' => 'danger', 'msg' => 'Chưa nhập tên và liên kết']);
        redirect("index.php?option=menu");
    }
    $data = array(
        'name' => $_POST['name'],
        'link' => $_POST['link'],
        'type' => 'custom',

        'orders' => 1,
        'position' => $_POST['position'],
        'parentid' => 0,
        'created_at' => date('Y-m-d H:i:s'),
        'created_by' => $userid,
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $userid,
        'status' => 2
    );
    $menu->menu_insert($data);
    set_flash('message', ['type' => 'success', 'msg' => 'Thêm tên và liên kết thành công!']);
    redirect("index.php?option=menu");
}


if (isset($_POST['CAPNHAT'])) {
    $id = $_REQUEST['id'];
    $menu = loadModel('menu');
    $row = $menu->menu_row(['id' => $id]);
    if ($row == null) {
        set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        redirect("index.php?option=menu");
    }
    $data = array(
        'name' => $_POST['name'],
        'link' => $_POST['link'],
        'type' => 'custom',

        'orders' => 1,
        'position' => $_POST['position'],
        'parentid' => $_POST['parentid'],
        'created_at' => date('Y-m-d H:i:s'),
        'created_by' => $userid,
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $userid,
        'status' => $_POST['status']
    );
    $menu->menu_update($data, $id);
    set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công!']);
    redirect("index.php?option=menu");
}
