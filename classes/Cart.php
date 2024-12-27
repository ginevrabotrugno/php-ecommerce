<?php

class CartManager extends DBManager {

    public function __construct()
    {
        parent::__construct();
        $this->columns = ['id', 'client'];
        $this->tableName = 'carts';
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