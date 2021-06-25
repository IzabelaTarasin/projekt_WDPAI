<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/places.css">
    <link rel="stylesheet" type="text/css" href="public/css/sliders.css">
    <link rel="stylesheet" type="text/css" href="public/css/calendars.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/23b90dae98.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/place.js" defer></script>
    <title>Details</title>
</head>

<body>
    <div class="base-container">
        <main>
            <?php
            if(isset($messages))
            {
                foreach($messages as $message)
                {
                    echo $message;
                }
            }
            ?>

            <img src="<?= isset($place) ? $place->getImagePath() : '';?>" width="500" height="500">
            <form action="book" method="POST">
                <input type="hidden" name="id" value="<?= isset($place) ? $place->getId() : '';?>">

                <?php if(isset($_SESSION['user'])):?>
                    <input id="has-animals-switch" type="checkbox" name="hasAnimals">
                    <label for="start">Start date:</label>
                    <input type="date" id="start-date-input" name="startDate">

                    <label for="end">End date:</label>
                    <input type="date" id="end-date-input" name="endDate">
                    <input id="book-button" type="submit" value="Book">
                <?php else:?>
                    <p>Only logged in users can book. <a href="/login">Login</a></p>
                <?php endif;?>
            </form>
            <p id="info"></p>
            <p>Total price is:</p>
            <p id="total-price"></p>
        </main>
    </div>
</body>