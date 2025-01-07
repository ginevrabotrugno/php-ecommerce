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

    public function getCartTotal($id){
        $result = $this->db->query("
        SELECT SUM(quantity) AS num_products , SUM(quantity* price) AS total FROM cart_items INNER JOIN products ON cart_items.product_id = products.id WHERE cart_id = $id
        ");

        return $result[0];
    }

    public function getCartItems($id){
        return $this->db->query("
            SELECT products.name AS name , products.description AS description , products.price AS single_price , cart_items.quantity AS quantity , products.price * cart_items.quantity AS total_price , products.id AS id FROM cart_items INNER JOIN products ON cart_items.product_id = products.id WHERE cart_items.cart_id =  $id
        ");
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

    public function removeFromCart($productId, $cartId){
        $quantity = 0;
        $result = $this->db->query("SELECT quantity , id FROM cart_items WHERE cart_id = $cartId AND product_id = $productId");
        $cartItemId = $result[0]['id'];
        if(count($result) > 0){
            $quantity = $result[0]['quantity'];
        } 
        $quantity--;

        if($quantity > 0){
            $this->db->execute("UPDATE cart_items SET quantity = $quantity WHERE cart_id = $cartId AND product_id = $productId");
        } else {
            $cartItemMgr = new CartItemManager();
            $cartItemMgr->delete($cartItemId);
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