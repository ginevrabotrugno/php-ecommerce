<?php

$cm = new CartManager();
$cartId = $cm->getCurrentCartId();

$cart_total = $cm->getCartTotal($cartId);
$cart_items = $cm->getCartItems($cartId);

?>

<div class="order-md-last m-4">
    
    <?php if(count($cart_items) > 0): ?>
    <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-primary">Carrello</span>
        <span class="badge bg-primary rounded-pill"><?php echo $cart_total['num_products']?></span>
    </h4>

    <ul class="list-group mb-3">
        <?php foreach ($cart_items as $item): ?>
            <li class="list-group-item d-flex justify-content-between lh-sm p-4">
                <div class="row w-100 align-items-center justify-content-between">
                    <div class="col-6 col-lg-4">
                        <h6 class="my-0"><?php echo $item['name'] ?></h6>
                        <small class="text-muted"><?php echo $item['description'] ?></small>
                    </div>
                    <div class="col-6 col-lg-2 text-center">
                        <span class="text-muted">€<?php echo $item['single_price'] ?></span>
                    </div>
                    <div class="col-6 col-lg-4 text-center">
                        <div class="cart_btns btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-primary">-</button>
                            <span class="text-muted text-center border-top border-bottom my-auto py-1" style="width:50px;"><?php echo $item['quantity'] ?></span>
                            <button type="button" class="btn btn-sm btn-primary">+</button>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2 text-center">
                        <strong class="text-primary">€<?php echo $item['total_price'] ?></strong>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
        <li class="list-group-item d-flex justify-content-between p-4">
            <span class="fs-4">Totale</span>
            <strong class="col-6 col-lg-2 text-center text-primary fs-4 mx-3">€<?php echo $cart_total['total']?></strong>
        </li>
    </ul>
    
    <button type="submit" class="btn btn-primary d-block w-100">Checkout</button>
    <?php else: ?>
        <p class="lead">Nessun elemento nel carrello...</p>
        <a href="<?php echo ROOT_URL ?>shop/?page=products-list" class="btn btn-primary">Torna a fare acquisti &raquo;</a>
    <?php endif; ?>
</div>

