<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/style.css">
    <title>PHP Ecommerce</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="<?php echo ROOT_URL; ?>public/?page=homepage">PHP Ecommerce</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ROOT_URL; ?>public/?page=about">Chi Siamo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ROOT_URL; ?>public/?page=services">Servizi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ROOT_URL; ?>shop">Prodotti</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo ROOT_URL; ?>public/?page=contacts">Contatti</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link position-relative mx-3" href="<?php echo ROOT_URL; ?>shop/?page=cart">
                                <i class="fa-solid fa-cart-shopping fs-4 "></i>
                                <span id="js-totCart" class="position-absolute top-5 start-95 translate-middle badge rounded-pill text-bg-success">
                                </span> 
                            </a>
                        </li>
                        <!-- MENU OSPITE -->
                        <?php if(!$loggedInUser): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Area Riservata</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo ROOT_URL; ?>auth?page=login">Login</a></li>
                            </ul>
                        </li>
                        <!-- MENU AMMINISTRATORE -->
                        <?php elseif($loggedInUser && $loggedInUser->is_admin): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Amministratore</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo ROOT_URL; ?>admin">Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?php echo ROOT_URL; ?>auth?page=logout">Logout</a></li>
                            </ul>
                        </li>
                        <!-- MENU UTENTE REGOLARE -->
                        <?php elseif($loggedInUser && $loggedInUser->is_admin === false): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false"><?php echo $loggedInUser->email ?></a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo ROOT_URL; ?>auth?page=logout">Logout</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>