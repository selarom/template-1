<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); 
  
class Cart extends CI_Controller { 
  
    function Cart() { 
        parent::__construct();
        $this->load->model('products_model', 'Product');
        $data['site_name'] = $this->config->item('site_name');
        $data['company_name'] = $this->config->item('company_name');
        $this->load->vars($data); 
        //$this->output->nocache();
    } 

    function index() {
        $data['page_title'] = 'Shopping Cart';
        $this->load->view('header', $data);
        if ( ! $this->cart->contents() ) {
            $this->load->view('cart/cart_empty');
        } else {
            
            $this->load->view('cart/cart_contents');
            
        }  
        $this->load->view('footer'); 
    }

    function add() {
        $notFound = TRUE;
        $cart = $this->cart->contents();
        $id = $this->input->post('product_id');

        $quantity = $this->input->post('quantity');

        if( isset($_POST['quantity']) || isset($_POST['produc_id'])) {
            foreach($cart as $items) {
                if($items['id'] == $id) {
                    $qty = $items['qty'] + $quantity;
                    
                    $tmp = array (
                            'rowid' => $items['rowid'],
                            'qty'   => $qty);
                    $this->cart->update($tmp);
                    $notFound=FALSE;
                
                    break;
                }
            }

            if($notFound) {
                $product = $this->Product->get($id);
        
                $products = array(
                    'id'      => $product->product_id,
                    'qty'     => $quantity,
                    'price'   => $product->price,
                    'name'    => $product->name,
                    'image_name' => $product->image_name
                );
        

                $this->cart->insert($products);
                
            }
        }
        redirect('cart'); 
    }

    function update() {
        if(strpos($this->input->post('remove'), 'remove') === FALSE) {
            $product = $this->input->post('rowid');
          
            $qty = $this->input->post('qty');
         
            $total = count($product);

            for($i=0;$i < $total;$i++)  
            {  
                $data = array(  
                      'rowid' => $product[$i], 
                      'qty'   => $qty[$i]  
                   );   
                $this->cart->update($data);  
            }
            redirect('cart');
        } else {
            $str=explode('_',$this->input->post('remove'));
            $id=$str[0];

            $data = array(  
                      'rowid' => $id, 
                      'qty'   => '0'  
            );   
            
            $this->cart->update($data);  

            redirect('cart'); 
        }
    }

    function empty_cart() {
        $cart = $this->cart->contents();
        $this->cart->destroy($cart);

        redirect('cart');
    }
}