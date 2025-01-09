<?php 

if(isset($loggedInUser)){
    echo '<script>location.href="'.ROOT_URL.'public"</script>';
}

if(isset($_POST['login'])){
    // logica di login 

    $user = (object) [
        'id' => 1,
        'email' => 'user@mail.it',
        'is_admin' => true
    ];

    $_SESSION['user'] = $user;

    echo '<script>location.href="'.ROOT_URL.'public"</script>';
}
?>

<form method="post">
    <button type="submit" name="login" class="btn btn-success">Login</button>
</form>
