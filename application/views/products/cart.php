<?php $this->load->view('partials/header') ?>
<?php $this->load->view('partials/nav') ?>
    <main class="checkout">
        <h2>Checkout</h2>
        <h4>Total: $
<?php 
    $total = 0; 
    foreach($cart_items as $item) {
        $total = $total + $item['total'];
    } 
?>
        <?= $total ?>
        </h4>
        <table>
            <tr>
                <th>Item name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
<?php
    if($cart_items) {
        foreach($cart_items as $item) {
?>
            <tr>
                <td><?= $item['name'] ?></td>
                <td><?= $item['qty'] ?></td>
                <td>$<?= $item['price'] ?></td>
                <td><form action="/products/delete/<?= $item['product_id'] ?>" method="post">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_hash ?>" />
                    <input type="submit" value="x">
                </form></td>
            </tr>
<?php 
        }
    }
?>
        </table>
    </main>
<?php $this->load->view('partials/footer') ?>