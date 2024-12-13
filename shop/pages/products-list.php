<?php 
    $productMgr = new ProductManager();
    $products = $productMgr->getAll();
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
                    <a href="#" class="btn btn-primary d-block my-2">Aggiungi al Carrello</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <p>Nessun prodotto disponibile...</p>
    <?php endif; ?>

</div>
