<div class="absolute">
    <div class="container">
        <div class="row">
            <ul>
                <li><a class="active" href="?page=index"><i class="material-icons">home</i></a></li>
                <li><a href="?page=news">Notatki</a></li>
                <li><a href="?page=upload">Pliki</a></li>
                <li><a href="?page=frequency">Lista obecności</a></li>
                <?php if($_SESSION != null && $_SESSION['role'] == "ADMIN"): ?>
                    <li><a href="?page=admin">Admin</a></li>
                <?php endif; ?>
                <li class="float-right"><a  href="?page=logout">Wyloguj</a></li>
            </ul>
        </div>
    </div>
</div>