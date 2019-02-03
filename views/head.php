<head>
    <meta charset="utf-8" />
    <title>Aplikacja do zatwierdzania nieobecności</title>
    <link rel="stylesheet" href="public/css/styles.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" />
    <!-- icons set: https://material.io/tools/icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
    <script src="public/js/script.js"></script>

    <?php
    if($_SESSION == null) {
        if($_GET['page'] != 'login') {
            header("Location: http://localhost/ADRIANWII-PAI?page=login");
        }
    }
    else
    {
        if($_GET != null && $_GET['page'] == 'login') {
            header("Location: http://localhost/ADRIANWII-PAI?page=index");
        }
    }
    
    ?>

</head>