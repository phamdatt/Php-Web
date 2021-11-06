<?php
$title = 'Dang Nhap';
$error = "";
if (isset($_POST['DANGNHAP'])) {
    $user = loadModel('user');
    $username = $_POST['username'];
    $password = $_POST['password'];
    $args = array();
    $args['access'] = 0;
    $args['status'] = 1;

    if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
        $args['email'] = $username;
    } else {
        $args['username'] = $username;
    }
    $count_username = $user->user_count($args);
    if ($count_username == 1) {
        $args['password'] = sha1($password);
        $row_user = $user->user_row($args);
        if ($row_user != null) {
            $_SESSION['user_customer'] = $row_user['username'];
            $_SESSION['fullname_customer'] = $row_user['fullname'];
            $_SESSION['userid_customer'] = $row_user['id'];

            redirect('index.php?option=cart&cat=buy');
        } else {
            $error = "Mat khau khong chinh xac";
        }
    } else {
        $error = "Ten Dang Nhap Khong Ton Tai";
    }
}
require_once('views/header.php');
?>
<form name="form1" method="POST" action="index.php?option=customer&cat=login">
    <section class="clearfix content">
        <div class="container">
            <h1>Đăng Nhập</h1>
            <div class="form-group">
                <label>Tên Đăng Nhập</label>
                <input type="text" name="username" class="form-control" placeholder="Tên Đăng Nhập" />
            </div>
            <div class="form-group">
                <label>Mật Khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Mật Khẩu" />
            </div>

            <div class="form-group">
                <button class="btn btn-success " type="submit" name="DANGNHAP">Đăng Nhập</button>
            </div>
            <div class="form-group">
                <?php echo "<span class='text-danger'>" . $error . "</span>"; ?>
            </div>

        </div>

    </section>
</form>
<?php require_once('views/footer.php'); ?>