<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/places.css">
    <link rel="stylesheet" type="text/css" href="public/css/sliders.css">
    <link rel="stylesheet" type="text/css" href="public/css/calendars.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/23b90dae98.js" crossorigin="anonymous"></script>
    <title>SEARCH PAGE</title>
</head>

<body>
    <div class="container">
        <main>
            <header>
                <div class="search-bar">
                    <button onClick="document.location.href='/places';">Home</button>
                </div>
            </header>
            <section class="place-form">
                <form class="form__container form" action="addPlace" method="POST" ENCTYPE="multipart/form-data">
                    <div class="messages">
                        <?php
                        if(isset($messages)){
                            foreach($messages as $message) {
                                echo $message;
                            }
                        }
                        ?>
                    </div>
                    <input name="name" type="text" placeholder="title">
                    <textarea name="description" rows="5" placeholder="description"></textarea>
                    <input id="animals-allowed-checkbox"type="checkbox" name="animalsAllowed" value="No" />
                    <label for="animals-allowed-checkbox">Are animals allowed?</label><br>
                    <input type="file" name="file">
                    <input type="submit" value="Add"/>
                </form>
            </section>
        </main>
    </div>
</body>