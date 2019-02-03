<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.php') ?>

<body>

<?php include(dirname(__DIR__).'/navbar.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Załaduj pliki</h1>
        </div>
        <div class="col-12">
            <?php foreach($message as $item): ?>
                <div><?= $item ?></div>
            <?php endforeach; ?>
        </div>
        <div class="col-12">
            <form action="?page=upload" method="POST" ENCTYPE="multipart/form-data">
                <input type="file" name="file" />
                <br/>
                <input class="btn-style orange margin-tit" type="submit" value="send"/>
            </form>
        </div>
    </div>
</div>
</body>
</html>

