<?php 

$errMsg = '';

if(isset($loggedInUser)){
    echo '<script>location.href="'.ROOT_URL.'public"</script>';
}

if (isset($_POST['login'])) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Esegui login
    $userMgr = new UserManager();
    $result = $userMgr->login($email, $password);

    if ($result) {
        echo '<script>location.href="'.ROOT_URL.'public"</script>';
    } else {
        $errMsg = 'Login Fallito. Credenziali errate.';
    }
}
?>

<form method="post" class="text-center w-75 mx-auto">
    <h1 class="h3 mb-3 fw-normal">Login</h1>

    <div class="form-floating mb-3">
        <input name="email" autocomplete="off" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating mb-3">
        <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
    </div>
    <div class="text-danger mb-3">
        <?php echo $errMsg ?>
    </div>

    <button type="submit" name="login" class="btn btn-success">Entra</button>
</form>