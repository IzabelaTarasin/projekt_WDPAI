<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>REGISTER</title>
</head>

<body>
<div class="container">
    <div class="logo">
        <img src="public/img/CAMP APP.svg">
    </div>
    <div class="login-container">
        <form class="register" action="register" method="POST">
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="email" type="text" placeholder="email@email.com">
            <input name="password" type="password" placeholder="password">
            <input name="confirmedPassword" type="password" placeholder="confirm password">
            <input name="name" type="text" placeholder="name">
            <input name="surname" type="text" placeholder="surname">
            <div>
                <input type="radio" id="standard" name="accountType" value="standard" checked>
                <label for="standard">Standard</label>
            </div>
            <div>
                <input type="radio" id="business" name="accountType" value="business">
                <label for="business">Business</label>
            </div>

            <button type="submit">REGISTER</button>
        </form>
    </div>
</div>
</body>