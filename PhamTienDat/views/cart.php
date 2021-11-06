<?php
$cart = loadClass('cart');
$product = loadModel('product');
//the gio hang

if (isset($_REQUEST['addcart'])) {
    $id = $_REQUEST['addcart'];
    $row = $product->product_row(['id' => $id, 'status' => 1]);
    $qty = (isset($_POST['DATMUA'])) ? $_POST['qty'] : 1;
    $total_money += $cat_row['amount'];
    $data = array(
        'id' => $id,
        'name' => $row['name'],
        'img' => $row['img'],
        'price' => $row['price'],
        'qty' => $qty,
        'amount' => ($row['price'] * $qty)
    );
    $cart->cart_add($data);
    redirect("index.php?option=cart");
}
$title = 'Giỏ Hàng';
//xoa gio hang
if (isset($_REQUEST['delcart'])) {
    $id = $_REQUEST['delcart'];
    if ($id == 'all') {
        $cart->cart_delete();
    } else {
        $cart->cart_delete($id);
    }
    $cart->cart_delete($id);
    redirect("index.php?option=cart");
}
//update
if (isset($_REQUEST['updatecart']) && isset($_POST['CAPNHAT'])) {

    $qty = $_POST['qty'];
    $cart_list = $cart->cart_content();
    $i = 0;
    $data = array();
    foreach ($cart_list as $cat_row) {

        $row = array(
            'id' => $cat_row['id'],
            'qty' => $qty[$i],

        );
        $data[] = $row;
        $i++;
    }
    $cart->cart_update($data);
    redirect("index.php?option=cart");
}

?>
<?php
$cart_list = $cart->cart_content();
?>
<?php require_once('views/header.php'); ?>
<section class="clearfix content">
    <div class="container">
        <?php if ($cart_list != null) : ?>
            <h3>Gio Hang</h3>
            <form action="index.php?option=cart&updatecart=1" method="POST">
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
                            <td><?php echo number_format($cat_row['price']); ?></td>
                            <td><input type="number" value="<?php echo $cat_row['qty']; ?>" name="qty[]" /></td>
                            <td><?php echo number_format($cat_row['amount']); ?></td>
                            <td>
                                <a href="index.php?option=cart&delcart=<?php echo $cat_row['id']; ?>" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                        <?php $total_money += $cat_row['amount']; ?>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3">
                            <button name="CAPNHAT" type="submit" class="btn btn-success">Cap Nhat</button>
                            <a href="index.php?option=cart&delcart=all" class="btn btn-danger">Xóa Gio Hang</a>
                        </td>
                        <td colspan="2" class="text-right">Tong Tien</td>
                        <td colspan="2"><strong><?php echo $total_money; ?></strong></td>
                    </tr>
                </table>
            </form>
            <a href="index.php?option=cart&cat=buy" class="btn btn-success">Thanh Toan</a>
        <?php endif; ?>

    </div>
</section>
<?php require_once('views/footer.php'); ?>