<?php

namespace App\Views;

use App\Base\BasicAuth;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="asset/style/main.css">
    <title>Project</title>

</head>
<body>
    <div class='navbar'>
        <a class='logo' href="">Project</a>
        <p class='username'><?=$_SERVER['PHP_AUTH_USER']?></p>
        <form action='' class="auth" method='post'>
            <input type='hidden' name='SeenBefore' value='1' />
            <input type='hidden' name='OldAuth' value='<?=htmlspecialchars($_SERVER['PHP_AUTH_USER'])?>'/>
            <input class='auth' type='submit' value='<?=BasicAuth::isAuth() ? Выйти : Войти?>'/>
            </form>
    </div>
    <?php require_once "app/Views/" . $content . ".php";?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"  crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="asset/js/app.js"></script>
</body>
</html>