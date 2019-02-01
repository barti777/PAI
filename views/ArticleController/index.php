<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.php'); ?>

<body>

<?php include(dirname(__DIR__).'/navbar.php'); ?>

<div class="container">
    <div class="row">
        <h1 class="col-12 pl-0">Notatki</h1>
        <a class="btn-style green margin-tit" href="http://localhost/ADRIANWII-PAI?page=news_add">Dodaj notatkę</a>
        <div class="news-container">

        </div>
    </div>
</div>

<script>

getArticles();
function getArticles() {
    const apiUrl = "http://localhost/ADRIANWII-PAI";
    $.ajax({
        type: 'POST',
        url : apiUrl + '/?page=news_list',
        dataType : 'json',
        success: function(data) {
            $('.news-container .news-hr').remove();
            $('.news-container .article').remove();

            data.forEach(el => {
                let deleteButton = `<button class="btn-style red margin-tit" type="button" onclick="deleteArticle(${el.id})">Usuń notatkę</button>`;

                <?php
                    if($_SESSION['role'] != "ADMIN") {
                        echo "deleteButton = '';";
                    }
                ?>
                $('.news-container').append(`
                <hr class="news-hr">
                <section class="article">
                    <h2>${el.title}</h2>
                    <p>${el.content}</p>
                    ${deleteButton}
                </section>`);
            })
        }
    })
}

function deleteArticle(id) {
    if (!confirm('Do you want to delete this article?')) {
        return;
    }

    const apiUrl = "http://localhost/ADRIANWII-PAI";

    $.ajax({
        url : apiUrl + '/?page=news_delete',
        method : "POST",
        data : {
            id : id
        },
        success: function() {
            setTimeout(function() {
                getArticles();
            }, 500);
        }
    });
}

</script>

</body>
</html>