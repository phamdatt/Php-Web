<?php
$slider = loadModel('slider');

$userid = (isset($_SESSION["userid"])) ? $_SESSION["userid"] : 1;

if (isset($_POST['THEM'])) {

    $data = array(

        'name' => $_POST['name'],
        'link' => $_POST['link'],
        'position' => $_POST['position'],

        'orders' => '1',
        'created_at' => date('Y-m-d H:i:s'),
        'created_by' => $userid,
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $userid,
        'status' => $_POST['status'],
    );
    if (strlen($_FILES["img"]["name"]) == 0) {
        set_flash('message', ['type' => 'danger', 'msg' => 'Hình sản phẩm chưa chọn!']);
        redirect("index.php?option=slider");
    }
    $dir_post = '../public/img/slider/';
    $target_file = $dir_post . basename($_FILES["img"]["name"]);
    $type_file = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (in_array($type_file, ['jpg', 'png', 'gif', 'jpeg'])) {

        $file_name = str_slug($_POST['name']) . '.' . $type_file;
        move_uploaded_file($_FILES['img']['tmp_name'], $dir_post . $file_name);
        $data['img'] = $file_name;
        $slider->slider_insert($data);
        set_flash('message', ['type' => 'success', 'msg' => 'Thêm thành công!']);
        redirect("index.php?option=slider");
    } else {

        set_flash('message', ['type' => 'danger', 'msg' => 'Định dạng tệp tin không đúng!']);
        redirect("index.php?option=slider");
    }
}

if (isset($_POST['CAPNHAT'])) {
    $id = $_REQUEST['id'];
    $row = $slider->slider_row(['id' => $id]);
    if ($row == null) {
        set_flash('message', ['type' => 'danger', 'msg' => 'Mẫu tin không tồn tại!']);
        redirect("index.php?option=slider");
    }
    $slug = str_slug($_POST['name']);
    $data = array(
        'name' => $_POST['name'],
        'link' => $_POST['link'],
        'position' => $_POST['position'],

        'orders' => '1',
        'created_at' => date('Y-m-d H:i:s'),
        'created_by' => $userid,
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $userid,
        'status' => $_POST['status'],
    );
    if (strlen($_FILES["img"]["name"])) {
        $dir_post = '../public/img/slider/';
        $target_file = $dir_post . basename($_FILES["img"]["name"]);
        $type_file = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (in_array($type_file, ['jpg', 'png', 'gif', 'jpeg'])) {
            if (file_exists($dir_post . $row['img'])) {
                unlink($dir_post . $row['img']);
            }
            $file_name = $slug . '.' . $type_file;
            move_uploaded_file($_FILES['img']['tmp_name'], $dir_post . $file_name);
            $data['img'] = $file_name;
        }
    }

    $slider->slider_update($data, $id);
    set_flash('message', ['type' => 'success', 'msg' => 'Cập nhật thành công!']);
    redirect("index.php?option=slider");
}
