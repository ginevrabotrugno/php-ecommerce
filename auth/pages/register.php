<?php 

$errMsg = '';

if(isset($loggedInUser)){
    echo '<script>location.href="'.ROOT_URL.'public"</script>';
}

if (isset($_POST['register'])) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirmed = htmlspecialchars(trim($_POST['confirm-password']));

    // Esegui register
    $userMgr = new UserManager();
    if($userMgr->passwordsMatch($password, $confirmed)){
        $result = $userMgr->register($email, $password);
    
        if ($result) {
            echo '<script>location.href="'.ROOT_URL.'auth/?page=login"</script>';
        } else {
            $errMsg = 'Regitsrazione Fallita. Mail già presente nel sistema.';
        }
    } else {
        $errMsg = 'Regitsrazione Fallita. Le password non corrispondono.';
    }
}
?>

<form method="post" class="text-center w-75 mx-auto">
    <h1 class="h3 mb-3 fw-normal">Registrazione</h1>

    <div class="form-floating mb-3">
        <input name="email" autocomplete="off" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating mb-3">
        <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating mb-3">
        <input name="confirm-password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Conferma Password</label>
    </div>
    <div class="text-danger mb-3">
        <?php echo $errMsg ?>
    </div>

    <button type="submit" name="register" class="btn btn-success">Registrati</button>

    <p class="mt-3">
        Hai già un account?
        <a href="<?php echo ROOT_URL ?>auth?page=login">Entra</a>
    </p>

</form>