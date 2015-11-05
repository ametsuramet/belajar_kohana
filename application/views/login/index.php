<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="description" content="slick Login">
    <meta name="author" content="Webdesigntuts+">
    <link href="<?= URL::base() ?>assets/css/login.css" rel="stylesheet">

    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script type="text/javascript" src="<?= URL::base() ?>assets/js/placeholder.js"></script>
</head>
 
<body>
    <form id="slick-login" action="/login/create" method="post">
        <label for="username">username</label><input type="text" name="username" class="placeholder" placeholder="me@email.com">
        <label for="password">password</label><input type="password" name="password" class="placeholder" placeholder="password">
        <input type="submit" value="Log In">
    </form>
</body>
 
</html>