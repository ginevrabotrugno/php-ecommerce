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