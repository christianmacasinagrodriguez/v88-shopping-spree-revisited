<?php 
defined('BASEPATH') OR exit('No kenemerut');

class Products extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('cart-count')) {
            $this->session->set_userdata('cart-count', 0);
        }   
        $this->load->helper('security'); 
    }

    public function index() {
        $this->load->model('Product');
        $this->session->set_userdata('catalog', true);
        $this->session->set_userdata('cart', false);  
        $view_data = array(
            'products' => $this->Product->get_all_products(),
            'cart_count' => $this->session->userdata('cart-count'),
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash(),
        );
        $this->load->view('products/index', $view_data);
    }
    
    public function cart() { 
        $this->load->model('Product');
        $cart_items = $this->Product->get_all_cart_items();
        $view_data = array(
            'cart_items' => $cart_items,
            'csrf_name' => $this->security->get_csrf_token_name(),
            'csrf_hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('products/cart', $view_data);        
    }

    public function toggle() {
        if($this->input->post()) {
            switch($this->input->post('toggle')) {
                case 'cart':
                    $this->session->set_userdata('catalog', false);
                    $this->session->set_userdata('cart', true);  
                    redirect('/products/cart');
                    break;
                case 'index':
                    $this->session->set_userdata('catalog', true);
                    $this->session->set_userdata('cart', false);  
                    redirect('/');
                    break;
            }
        } else {
            redirect('/');
        }
    }

    public function add($id) {  
        if($this->input->post()) {
            $this->load->model('Product');
            $quantity = $this->input->post('quantity', TRUE);
            if($this->Product->add_to_cart($id, $quantity)) {
                $cart_products = $this->Product->get_all_cart_items();
                $this->session->set_userdata('cart-count', count($cart_products));
                redirect('/');
            }
        } else {
            redirect('/');
        }   
    }

    public function delete($id) {
        if($this->input->post()) {
            $this->load->model('Product');
            $this->Product->delete_cart_item($id);
            $this->session->set_userdata('cart-count', count($cart_products));
            redirect('/products/cart');
        } else {
            redirect('/products/cart');
        }
    }
}
?>