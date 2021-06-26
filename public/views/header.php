<header class="site-header">
    <img width="300" height="100" src="public/img/CAMP APP.svg"/>
    <nav>
        <ul class="nav-wrapper">
            <li class="nav-item"><a href="/places">Wyszukaj camping</a></li>
            <?php if(isset($_SESSION['user']) &&
                $_SESSION['user']->getAccountType() == 'business'):?>
            <li class="nav-item no-underline"><a href="/addPlace">Dodaj camping</a></li>
            <?php endif;?>

            <?php if(isset($_SESSION['user'])): ?>
            <li class="nav-item no-underline"><a href="/logout">Wyloguj</a></li>
            <?php else: ?>
            <li class="nav-item no-underline"><a href="/login">Logowanie</a></li>
            <li class="nav-item no-underline"><a href="/register">Rejestracja</a></li>
            <?php endif;?>
        </ul>
    </nav>
</header>