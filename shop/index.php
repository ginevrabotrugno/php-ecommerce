<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'products-list';
?>

<?php include '../inc/init.php' ?>
<?php include ROOT_PATH . 'public/template-parts/header.php' ?>

<main class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <?php include ROOT_PATH . 'shop/pages/' . $page . '.php' ?>
            </div>
            <?php include ROOT_PATH . 'public/template-parts/sidebar.php' ?>
        </div>
    </div>
</main>

<?php include ROOT_PATH . 'public/template-parts/footer.php' ?>

    