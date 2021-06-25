<header>
    <div class="search-bar">
        <input id="search-bar" placeholder="search place">
    </div>
    <div>
        <a href="/places">Wyszukaj camping</a>
        <?php if(isset($_SESSION['user']) &&
            $_SESSION['user']->getAccountType() == 'business'):?>
            <a href="/addPlace">Dodaj camping</a>
        <?php endif;?>

        <?php if(isset($_SESSION['user'])): ?>
            <a href="/logout">Wyloguj</a>
        <?php else: ?>
            <a href="/login">Logowanie</a>
            <a href="/register">Rejestracja</a>
        <?php endif;?>
    </div>
</header>