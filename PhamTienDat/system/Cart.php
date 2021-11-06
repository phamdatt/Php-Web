<?php
class Cart
{
    function cart_add($data)
    {
        if (!isset($_SESSION['cart'])) {
            $mycart[] = $data; //Mang 2 chieu
            $_SESSION['cart'] = $mycart; //cart mang 2 chieu
        } else {
            $mycart = $_SESSION['cart']; //Lay cart ra
            if ($this->check_product($mycart, $data) == true) {
                $mycart = $this->cart_update_qty($mycart, $data);
            } else {
                $mycart[] = $data;
            }
            $_SESSION['cart'] = $mycart;
        }
    }
    function cart_update($data)
    {
        $mycart = $_SESSION['cart'];
        foreach ($data as $key => $item) {
            foreach ($mycart as $keycart => $rcart) {
                if ($data[$key]['id'] == $mycart[$keycart]['id']) {
                    if ($data[$key]['qty'] <= 0) {
                        unset($mycart[$keycart]);
                    } else {
                        $mycart[$keycart]['qty'] = $data[$key]['qty'];
                        $mycart[$keycart]['amount'] = ($mycart[$keycart]['qty'] * $mycart[$keycart]['price']);
                    }
                }
            }
        }
        $_SESSION['cart'] = $mycart;
    }
    function check_product($mycart, $data)
    {
        foreach ($mycart as $r) {
            if ($r['id'] == $data['id']) {
                return true;
            }
        }
        return false;
    }
    function cart_update_qty($mycart, $data)
    {
        foreach ($mycart as $key => $r) {
            if ($r['id'] == $data['id']) {
                $mycart[$key]['qty'] += $data['qty'];
                $mycart[$key]['amount'] += $data['amount'];
            }
        }
        return $mycart;
    }
    function cart_content()
    {
        if (isset($_SESSION['cart'])) {
            return $_SESSION['cart'];
        }
        return NULL;
    }
    function cart_delete($id = null)
    {
        if ($id != null) {
            $mycart = $_SESSION['cart'];
            foreach ($mycart as $key => $row) {
                if ($row['id'] == $id) {
                    unset($mycart[$key]);
                }
            }
            $_SESSION['cart'] = $mycart;
        } else {
            unset($_SESSION['cart']);
        }
    }
    function cart_qty()
    {
        $mycart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : null;
        $sl = 0;
        if ($mycart  != null) {


            foreach ($mycart as $r) {
                $sl += $r['qty'];
            }
        }
        return $sl;
    }
}
