<?php require_once("admin/views/message.php"); ?>
<?php
$title = 'Đăng ký tài khoản';
if (isset($_POST['DANGKY'])) {
    $user = loadModel('user');
    $error = '';
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error = 'Định dạng email không hợp lệ';
    }
    if ($_POST['email'] != $_POST['email_con'] && $error == '') {
        $error = 'E-Mail không khớp!';
    }
    if ($_POST['password'] != $_POST['password_con'] && $error == '') {
        $error = 'Mật khẩu không khớp!';
    }
    $userRow = $user->user_row(['username' => $_POST['username']]);
    if ($userRow != null && $error == '') {
        $error = 'Tên đăng nhập đã tồn tại!';
    }
    $userRow = $user->user_row(['email' => $_POST['email']]);
    if ($userRow != null && $error == '') {
        $error = 'Email đã tồn tại!';
    }
    if ($error == '') {
        $data = array(
            'fullname' => $_POST['fullname'],
            'username' => $_POST['username'],
            'gender' => $_POST['gender'],

            'access' => 0,
            'password' => sha1($_POST['password']),
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => 1,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => 1,
            'status' => 1

        );

        $user->user_insert($data);
        $error = "Đăng ký thành công!";
    }
    set_flash('message', ['type' => 'success', 'msg' => $error]);
    redirect('index.php?option=customer&cat=register');
}
?>

<?php require_once('views/header.php'); ?>
<section class='dangky my-4'>
    <div class="container">
        <div class="row">

            <div class="col-md">
                <h3 class="">Đăng ký khách hàng</h3>
                <form action="index.php?option=customer&cat=register" method="post">

                    <div class="form-group">
                        <label for="">Họ và tên</label>
                        <input class="form-control" type="text" name="fullname" required placeholder="Họ và tên">
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input class="form-control" type="text" name="phone" required placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input class="form-control" type="text" name="email" required placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="">Xác nhận lại email</label>
                        <input class="form-control" type="text" name="email_con" required placeholder="Xác nhận email">
                    </div>
                    <div class="form-group">
                        <label for="">Giới tính</label>
                        <select class="form-control" name="gender" id="">
                            <option value="1">Nam</option>
                            <option value="2">Nữ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Tên đăng nhập</label>
                        <input class="form-control" type="text" name="username" required placeholder="Tên đăng nhập">
                    </div>
                    <div class="form-group">
                        <label for="">Mật khẩu</label>
                        <input class="form-control" type="password" name="password" required placeholder="Mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="">Xác nhận lại mật khẩu</label>
                        <input class="form-control" type="password" name="password_con" required placeholder="Xác nhận mật khẩu">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success" type="submit" name="DANGKY">Đăng ký</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php require_once('views/footer.php'); ?>