<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.php'); ?>

<body>

<?php include(dirname(__DIR__).'/navbar.php'); ?>

<div class="container">
    <div class="row">
        <h1 class="col-12 pl-0">Nowa osoba:</h1>

        <form class="form-margin" action="http://localhost/ADRIANWII-PAI/?page=frequency_save" method="post">
            <input type="hidden" name="id" value="">
            <input type="hidden" name="date" value="">
            <div class="top-bottom">
                <label class="block" for="name">Imię</label>
                <input type="name" name="name" value="">
            </div>

            <div class="top-bottom">
                <label class="block" for="surname">Nazwisko</label>
                <input type="surname" name="surname">
            </div>

            <div class="top-bottom">
                <label class="block" for="frequency">Obecność</label>
                <input type="checkbox" name="frequency" checked="checked" class="checkbox">
            </div>

            <div class="top-bottom">
                <a class="btn-style orange style-return" href="javascript:history.go(-1)">Wstecz</a>
                <button class="btn-style green style-return float-right" type="submit">Zapisz</button>
            </div>
        </form>

    </div>
</div>
</body>
</html>