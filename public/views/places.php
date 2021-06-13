<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <link rel="stylesheet" type="text/css" href="public/css/places.css">
    <link rel="stylesheet" type="text/css" href="public/css/sliders.css">
    <link rel="stylesheet" type="text/css" href="public/css/calendars.css">
    <link rel="stylesheet" type="text/css" href="public/css/searchTeriitorium.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/23b90dae98.js" crossorigin="anonymous"></script>
    <title>SEARCH PAGE</title>
</head>

<body>
    <div class="base-container">
        <nav>
            <img src="public/img/CAMP APP.svg">
            <ul>
                <li>
                    <i class="fas fa-tags"></i>
<!--                    <input type="range" min="1" max="100" value="50" class="slider" id="myRange">-->
                </li>
                <li>
                    <i class="fas fa-search"></i>
                </li>
                <li>
                    <i class="fas fa-calendar-alt"></i>
                    <label for="startdate">Start day</label>
                    <input class="calendar" type="date" name="startdate" id="startdate">
                </li>
                <li>
                    <i class="fas fa-calendar-alt"></i>
                    <label class="calendarlabel" for="enddate">End day</label>
                    <input class="calendar" type="date" name="enddate" id="enddate">
                </li>
                <li>
                    <i class="fas fa-user"></i>
                    <select name="persons" id="persons">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </li>
                <li>
                    <i class="fas fa-utensils"></i>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </li>
                <li>
                    <i class="fas fa-dog"></i>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </li>
                <li>
                    <i class="fas fa-bath"></i>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </li>
                <li>
                    <i class="fas fa-child"></i>
                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider round"></span>
                    </label>
                </li>
                <li>
                    <a href="#" class="button">search</a>
                </li>
            </ul>
        </nav>
        <main>
            <header>
                <div class="search-bar">
                    <form>
                        <input placeholder="search place">
                    </form>
                </div>
                <div class="add-place">
                    <i class="fas fa-plus"></i>
                    add place
                </div>
            </header>
            <section class="places">
                <div id="place-1">
                    <img src="public/img/1.png">
                    <div>
                        <h2>Title</h2>
                        <div class="rating-section">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                        <p>description</p>
                    </div>
                </div>
                <div id="place-2">
                    <img src="public/img/2.png">
                    <div>
                        <h2>Title</h2>
                        <div class="rating-section">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <p>description</p>
                    </div>
                </div>
                <div id="place-3">
                    <img src="public/img/3.png">
                    <div>
                        <h2>Title</h2>
                        <div class="rating-section">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <p>description</p>
                    </div>
                </div>
                <div id="place-4">
                    <img src="public/img/4.png">
                    <div>
                        <h2>Title</h2>
                        <div class="rating-section">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <p>description</p>
                    </div>
                </div>
            </section>
        </main>
    </div>
</body>