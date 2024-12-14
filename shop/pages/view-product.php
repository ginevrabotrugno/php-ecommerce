<?php

if(!defined('ROOT_URL')){
    die;
}

$id = htmlspecialchars(trim(isset($_GET['id'])));
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
    <a href="#" class="btn btn-primary">Aggiungi al carrello</a>
  </div>
</div>