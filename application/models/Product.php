<?php 
class Product extends CI_Model {
    public function get_all_products() {
        return $this->db->query('SELECT * FROM shopping_spree.products')->result_array();
    }

    public function add_to_cart($id, $quantity) {
        $query = "INSERT INTO shopping_spree.cart (product_id, quantity, created_at, updated_at) VALUES (?,?,?,?)";
        $values = array($id, $quantity, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
        return $this->db->query($query, $values);
    }

    public function get_all_cart_items() {
        return $this->db->query("SELECT * , SUM(cart.quantity) AS qty, SUM(products.price * cart.quantity) AS total FROM shopping_spree.cart RIGHT JOIN shopping_spree.products ON  cart.product_id=products.id WHERE cart.product_id = products.id GROUP BY cart.product_id")->result_array();
    }

    public function delete_cart_item($id) {
        $query = "DELETE FROM shopping_spree.cart WHERE product_id = ?";
        $value = array($id);
        return $this->db->query($query, $value);
    }
}
?>