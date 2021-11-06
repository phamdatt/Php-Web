
<?php
$title = 'Dat mua';
$user = loadModel('user');
$userid = $_SESSION['userid_customer'];
$row_user = $user->user_row(['id' => $userid, 'access' => 1, 'status' => 1]);
$cart_list = $cart->cart_content();
if (isset($_POST['LUU'])) {
    $order = loadModel('order');
    $orderdetail = loadModel('orderdetail');
    $data_order = array(
        'code' => date('YmdHis'),
        'userid' => $userid,
        'createdate' => date('Y-m-d'),
        'exportdate' => date('Y-m-d'),
        'deliveryaddress' => (strlen($_POST['deliveryaddress'])) ? $_POST['deliveryaddress'] : $row_user['address'],
        'deliveryname' => (strlen($_POST['deliveryname'])) ? $_POST['deliveryname'] : $row_user['fullname'],
        'deliveryphone' => (strlen($_POST['deliveryphone'])) ? $_POST['deliveryphone'] : $row_user['phone'],
        'deliveryemail' => (strlen($_POST['deliveryemail'])) ? $_POST['deliveryemail'] : $row_user['email'],
        'updated_at' => date('Y-m-d H:i:s'),
        'updated_by' => $userid,
        'status' => 2


    );
    $orderid = $order->order_insert($data_order, $insert = TRUE);
    if ($orderid != null) {
        foreach ($cart_list as  $cart_row) {
            $data_orderdetail = array(
                'orderid' => $orderid,
                'productid' => $cart_row['id'],
                'price' => $cart_row['price'],
                'quantity' => $cart_row['qty'],
                'amount' => $cart_row['amount']

            );
            $orderdetail->orderdetail_insert($data_orderdetail);
        }
    }
    unset($_SESSION['cart']);
    redirect('index.php');
}
?>
<?php require_once('views/header.php'); ?>
<section class="clearfix content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form action="index.php?option=cart&cat=buy" method="POST">

                    <h3>Thong Tin Khach Hang</h3>

                    <div class="form-group">
                        <label>Ho ten khach hang</label>
                        <input class="form-control" name="fullname" type="text" readonly value="<?php echo $row_user['fullname']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Dien Thoai</label>
                        <input class="form-control" name="fullname" type="text" readonly value="<?php echo $row_user['phone']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="fullname" type="text" readonly value="<?php echo $row_user['email']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Ho ten khach hang</label>
                        <input class="form-control" name="fullname" type="text" readonly value="<?php echo $row_user['fullname']; ?>" />
                    </div>
                    <h3>Thong Tin Don Hang</h3>
                    <div class="form-group">
                        <label>Người Nhận Hàng</label>
                        <input class="form-control" name="deliveryname" type="text" placeholder="Người Nhận Hàng" />
                    </div>
                    <div class="form-group">
                        <label>Dien Thoai Người Nhận</label>
                        <input class="form-control" name="deliveryphone" type="text" placeholder="Dien thoai" />
                    </div>
                    <div class="form-group">
                        <label>Email người nhận</label>
                        <input class="form-control" name="deliveryemail" type="text" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <label>Địa Chỉ Người Nhận</label>
                        <input class="form-control" name="deliveryaddress" type="text" placeholder="Địa Chỉ" />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit" name="LUU">Thanh Toán</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <?php if ($cart_list != null) : ?>
                    <h3>Gio Hang</h3>
                    <table class="table table-bordered">

                        <tr>
                            <td>Ma</td>
                            <td style="width:50px;">Hinh</td>
                            <td>Ten San Pham</td>
                            <td>Gia</td>
                            <td>So Luong</td>
                            <td>Thanh Tien</td>
                            <td></td>
                        </tr>
                        <?php $total_money = 0; ?>
                        <?php foreach ($cart_list as $cat_row) : ?>

                            <tr>
                                <td> <?php echo $cat_row['id']; ?></td>
                                <td><img src="public/images/<?php echo $cat_row['img']; ?>" class="card-img-top" alt="..."></td>
                                <td><?php echo $cat_row['name']; ?></td>
                                <td><?php echo $cat_row['price']; ?></td>
                                <td><?php echo $cat_row['qty']; ?></td>
                                <td><?php echo $cat_row['amount']; ?></td>

                            </tr>
                            <?php $total_money += $cat_row['amount']; ?>
                        <?php endforeach; ?>
                        <tr>

                            <td colspan="5" class="text-right">Tong Tien</td>
                            <td colspan="2"><strong><?php echo $total_money; ?></strong></td>
                        </tr>
                    </table>

                <?php endif; ?>
            </div>



        </div>
    </div>
</section>
<?php require_once('views/footer.php'); ?>