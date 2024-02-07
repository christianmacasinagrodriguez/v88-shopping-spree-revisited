    <header>
        <nav>
            <h1>Shop Eey!</h1>
<?php 
    if($this->session->userdata('catalog')) {
?>
            <form action="/products/toggle" method="post">
                <input type="hidden" name="toggle" value="cart">
                <input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_hash ?>" />
                <input type="submit" value="Cart(<?= $cart_count ?>)">
            </form>
<?php 
    }
    if($this->session->userdata('cart')) {
?>
            <form action="/products/toggle" method="post">
                <input type="hidden" name="toggle" value="index">
                <input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_hash ?>" />
                <input type="submit" value="Catalog">
            </form>
<?php 
    }
?>
        </nav>
    </header>