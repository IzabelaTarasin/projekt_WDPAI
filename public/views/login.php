<!DOCTYPE html>

<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <title>LOGIN PAGE</title>
</head>

<body>
    <div class="container__centered">
        <div class="login__container">
            <div class="logo__container">
                <img width="300" height="100" src="public/img/CAMP APP.svg">
            </div>
                <form action="login" method="POST">
                    <?php include('messages.php') ?>
                    <input name="email" type="text" placeholder="email@email.com">
                    <input name="password" type="password" placeholder="password">
                    <button class="primary__button" type="submit">LOGIN</button>
                    <p>You don't have an account? <a href="/register">Register</a></></p>
                </form>
        </div>
    </div>
</body>