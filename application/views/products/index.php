<?php $this->load->view('partials/header') ?>
<?php $this->load->view('partials/nav', array('csrf_name' => $csrf_name, 'csrf_hash' => $csrf_hash)) ?>
    <main class="index">
<?php 
    foreach($products as $product) {
?>
        <section>
            <div>
                <img src="<?= $product['url'] ?>" alt="car <?= $product['name'] ?>">
            </div>
            <form action="/products/add/<?= $product['id'] ?>" method="post">
            <input type="hidden" name="<?= $csrf_name ?>" value="<?= $csrf_hash ?>" />
                <fieldset>
                    <p><?= $product['name'] ?></p>
                    <p>$<?= $product['price'] ?></p>
                </fieldset>
                <fieldset>
                    <select name="quantity" id="quantity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <input type="submit" value="Buy">
                </fieldset>            
            </form>
        </section>
<?php 
    } 
?>
    </main>
<?php $this->load->view('partials/footer') ?>