<header class="site-header">
    <img width="300" height="100" src="public/img/CAMP APP.svg"/>
    <nav>
        <ul class="nav-wrapper">
            <li class="nav-item"><a href="/places">Search for camping</a></li>
            <?php if(isset($_SESSION['user']) &&
                $_SESSION['user']->getAccountType() == 'business'):?>
            <li class="nav-item no-underline"><a href="/addPlace">Add camping</a></li>
            <?php endif;?>

            <?php if(isset($_SESSION['user'])): ?>
            <li class="nav-item no-underline"><a href="/logout">Logout</a></li>
            <?php else: ?>
            <li class="nav-item no-underline"><a href="/login">Login</a></li>
            <li class="nav-item no-underline"><a href="/register">Register</a></li>
            <?php endif;?>
        </ul>
    </nav>
</header>