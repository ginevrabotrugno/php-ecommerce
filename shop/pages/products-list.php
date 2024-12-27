<?php 
    if(!defined('ROOT_URL')){
        die;
    }
    $productMgr = new ProductManager();
    $products = $productMgr->getAll();

    if(isset($_POST['add_to_cart'])){
        $productId = htmlspecialchars(trim($_POST['id']));
        $cm = new CartManager();
        $cartId = $cm->getCurrentCartId();
      
        $cm->addToCart($productId, $cartId);
      }
?>

<div class="row flex-wrap justify-content-around">
    <?php if($products) : ?>
        <?php foreach($products as $product) : ?>
            <div class="card mb-5" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"> <?php echo $product->name ?> </h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary"> <?php echo $product->price ?> €</h6>
                    <p class="card-text"> <?php echo $product->description ?> </p>
                    <a href="<?php echo ROOT_URL . 'shop/?page=view-product&id=' . $product->id ?>" class="btn btn-success d-block my-2">Dettagli</a>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $product->id ?>">
                        <input type="submit" name="add_to_cart" class="btn btn-primary d-block w-100 my-2" value="Aggiungi al carrello">
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Nessun prodotto disponibile...</p>
    <?php endif; ?>

</div>
