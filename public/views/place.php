<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/header.css">
    <link rel="stylesheet" type="text/css" href="public/css/sliders.css">
    <link rel="stylesheet" type="text/css" href="public/css/address.css">
    <link rel="stylesheet" type="text/css" href="public/css/place.css">
    <link rel="stylesheet" type="text/css" href="public/css/calendars.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/23b90dae98.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/place.js" defer></script>
    <title>Details</title>
</head>

<body>
    <?php include('header.php') ?>
    <div class="container">
        <div class="container__internal">
            <div class="place__description">
                <img src="<?= isset($place) ? $place->getImagePath() : '';?>" width="500" height="500">
                <?php include('address.php') ?>
            </div>
            <form action="book" method="POST">
                <?php include('messages.php') ?>
                <input type="hidden" name="id" value="<?= isset($place) ? $place->getId() : '';?>">

                <?php if(isset($_SESSION['user'])):?>
                    <label for="start">Start date:</label>
                    <input type="date" id="start-date-input" name="startDate">

                    <label for="end">End date:</label>
                    <input type="date" id="end-date-input" name="endDate">

                    <?php if(isset($place) && $place->isAnimalsAllowed()): ?>
                        <div class="animals">
                            <div>
                                <label class="switch">
                                    <input class="checkbox" id="has-animals-switch" type="checkbox" name="hasAnimals" value="No" />
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div>
                                <span>Animals allowed?</span>
                            </div>
                        </div>

                    <?php endif;?>

                    <p class="error" id="info"></p>
                    <p>Total price is:</p>
                    <p class="price" id="total-price"></p>

                    <button class="primary__button" id="book-button" type="submit">Book</button>
                <?php else:?>
                    <p>Only logged in users can book. <a href="/login">Login</a></p>
                <?php endif;?>
            </form>
        </div>
    </div>
</body>