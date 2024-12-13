<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'homepage.php';
?>

<?php include './template-parts/header.php' ?>

<main class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-9">
                <?php include './pages/' . $page ?>
            </div>
            <?php include './template-parts/sidebar.php' ?>
        </div>
    </div>
</main>

<?php include './template-parts/footer.php' ?>

    