<!DOCTYPE html>
<head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/sliders.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/addPlace.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/23b90dae98.js" crossorigin="anonymous"></script>
    <title>SEARCH PAGE</title>
</head>

<body>
<?php include('header.php') ?>
    <div class="container">
        <div class="container__internal">
        <form class="form__container form" action="addPlace" method="POST" ENCTYPE="multipart/form-data">
            <?php include('messages.php') ?>
            <input name="name" type="text" placeholder="title">
            <textarea name="description" rows="5" placeholder="description"></textarea>

            <p>Address</p>
            <input name="postal-code" type="text" placeholder="Postal code">
            <input name="city" type="text" placeholder="City">
            <input name="street" type="text" placeholder="Street">
            <input name="number" type="text" placeholder="Number">

            <div class="animals">
                <div>
                <label class="switch">
                    <input class="checkbox" id="animals-allowed-checkbox"type="checkbox" name="animalsAllowed" value="No" />
                    <span class="slider round"></span>
                </label>
                </div>
                <div>
                    <span>Animals allowed?</span>
                </div>
            </div>
            <input type="file" name="file">
            <button class="primary__button" type="submit">Add</button>
        </form>
        </div>
    </div>
</body>