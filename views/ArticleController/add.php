<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.php'); ?>

<body>

<?php include(dirname(__DIR__).'/navbar.php'); ?>

<div class="container">
    <div class="row">
        <h1 class="col-12">Nowa notatka</h1>

        <form class="form-margin" action="http://localhost/ADRIANWII-PAI/?page=news_save" method="post">
            <input type="hidden" name="id" value="">
            <input type="hidden" name="authorId" value="<?=$_SESSION['userId']?>">
            <div class="top-bottom">
                <label class="block" for="title">Tytuł</label>
                <input type="text" name="title">
            </div>
            
            <div class="top-bottom">
                <label class="block" for="content">Treść</label>
                <textarea name="content" id="" cols="60" rows="10"></textarea>
            </div>
            
            <div class="btn-area">
                <a href="javascript:history.go(-1)" class="btn-style orange tyle-return">Wstecz</a>
                <button class="btn-style green float-right tyle-return" type="submit">Zapisz</button>
            </div>
        </form>

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
                console.log(el.title);
                $('.news-container').append(`
                <hr class="news-hr">
                <section class="article">
                    <h2>${el.title}</h2>
                    <p>${el.content}</p>
                </section>`);
            })
        }
    })
}

function deleteUser(id) {
    if (!confirm('Do you want to delete this user?')) {
        return;
    }

    const apiUrl = "http://localhost/ADRIANWII-PAI";

    $.ajax({
        url : apiUrl + '/?page=admin_delete_user',
        method : "POST",
        data : {
            id : id
        },
        success: function() {
            setTimeout(function() {
                getUsers();
            }, 500);
        }
    });
}

</script>

</body>
</html>