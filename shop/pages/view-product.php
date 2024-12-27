<?php

if(!defined('ROOT_URL')){
  die;
}

if(isset($_POST['add_to_cart'])){
  $productId = htmlspecialchars(trim($_POST['id']));
  $cm = new CartManager();
  $cartId = $cm->getCurrentCartId();

  $cm->addToCart($productId, $cartId);
}

$id = isset($_GET['id']) ? htmlspecialchars(trim($_GET['id'])) : null;
$pm = new ProductManager();
$product = $pm->get($id);

if(!(property_exists($product, 'id'))){
    echo '<script>location.href="'.ROOT_URL.'"</script>';
    exit;
}
?>

<div class="container my-5">
  <div class="p-5 bg-body-tertiary rounded-3">
    <h1 class="text-body-emphasis"> <?php echo $product->name ?> </h1>
    <h3><?php echo $product->price ?> €</h3>
    <hr>
    <p class="lead">
        <?php echo $product->description ?> <br>
    </p>
    <form method="post">
      <input type="hidden" name="id" value="<?php echo $product->id ?>">
      <input type="submit" name="add_to_cart" class="btn btn-primary" value="Aggiungi al carrello">
    </form>
  </div>
</div>