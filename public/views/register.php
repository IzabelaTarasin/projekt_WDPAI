<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/register.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>REGISTER</title>
</head>

<body>
<div class="container__centered">
    <div class="register__container">
        <div class="logo__container">
            <img width="300" height="100" src="public/img/CAMP APP.svg">
        </div>
        <form action="register" method="POST">
            <?php include('messages.php') ?>
            <input name="email" type="text" placeholder="email@email.com">
            <input name="password" type="password" placeholder="password">
            <input name="confirmedPassword" type="password" placeholder="confirm password">
            <input name="name" type="text" placeholder="name">
            <input name="surname" type="text" placeholder="surname">
            <div>
                <input class="checkbox" type="radio" id="standard" name="accountType" value="standard" checked>
                <label for="standard">Standard</label>
            </div>
            <div>
                <input class="checkbox" type="radio" id="business" name="accountType" value="business">
                <label for="business">Business</label>
            </div>

            <button class="primary__button" type="submit">REGISTER</button>
            <p>Already have an accout? <a href="/login">Login</a></></p>
        </form>
    </div>
</div>
</body>