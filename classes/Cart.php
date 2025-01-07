<?php

class CartManager extends DBManager {

    private $clientId;

    public function __construct()
    {
        parent::__construct();
        $this->columns = ['id', 'client'];
        $this->tableName = 'carts';

        $this->_initializeClientIdFromSession();
    }

    public function getCurrentCartId(){
        $cartId = 0;
        $result = $this->db->query("SELECT * FROM carts WHERE client = '$this->clientId'");
        if(count($result) > 0){
            $cartId = $result[0]['id'];
        } else {
            $cartId = $this->create([
                'client' => $this->clientId
            ]);
        }

        return $cartId;
    }

    public function addToCart($productId, $cartId){
        $quantity = 0;
        $result = $this->db->query("SELECT quantity FROM cart_items WHERE cart_id = $cartId AND product_id = $productId");
        if(count($result) > 0){
            $quantity = $result[0]['quantity'];
        } 
        $quantity++;

        if(count($result) > 0){
            $this->db->execute("UPDATE cart_items SET quantity = $quantity WHERE cart_id = $cartId AND product_id = $productId");
        } else {
            $cartItemMgr = new CartItemManager();
            $newId = $cartItemMgr->create([
                'cart_id' => $cartId,
                'product_id' => $productId,
                'quantity' => 1
            ]);
        }
    }

    // private methods 
    private function _initializeClientIdFromSession(){
        if(isset($_SESSION['client'])){
            $this->clientId = $_SESSION['client'];
        } else {
            $str = $this->random_string();

            $_SESSION['client'] = $str;
            $this->clientId = $str;
        }
    }

    private function random_string(){
        return substr(md5(mt_rand()), 0, 20);
    }
}

class CartItemManager extends DBManager {

    public function __construct()
    {
        parent::__construct();
        $this->columns = ['id', 'cart_id', 'product_id', 'quantity'];
        $this->tableName = 'cart_items';
    }
}

?>