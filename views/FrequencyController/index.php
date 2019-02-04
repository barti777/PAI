<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.php'); ?>

<body>

<?php include(dirname(__DIR__).'/navbar.php'); ?>

<div class="container">
    <div class="row">
       <div>
        <h1 class="col-12 dom">Obecność</h1>
        </div>
        <div class="col-12">    
            <a class="btn-style green margin-tit" href="http://localhost/ADRIANWII-PAI?page=frequency_add">Dodaj osobę</a>
        </div>
        <div class="col-12"> 
        <div class="frequency-wrapper">
                   
            <table class="table table-responsive">
                <thead>
                    <tr class="line-head">
                        <th>Data</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Obecność</th>
                        <th>Usuń pozycję</th>  
                    </tr>            
                </thead>
                <tbody class="frequency-container">
                </tbody>
            </table>
            
        </div>
        </div>
    </div>
</div>

<script>



getFrequences();
function getFrequences() {
    const apiUrl = "http://localhost/ADRIANWII-PAI";
    $.ajax({
        type: 'POST',
        url : apiUrl + '/?page=frequency_list',
        dataType : 'json',
        error: function(data) {
            $('.frequency-container .frequency').remove();
        },
        success: function(data) {
            $('.frequency-container .frequency').remove();

            data.forEach(el => {
                let deleteButton = `<button class="btn-style red" type="button" onclick="deleteFrequency(${el.id})">Usuń</button>`;

                <?php
                    if($_SESSION['role'] != "ADMIN") {
                        echo "deleteButton = '';";
                    }
                ?>
                $('.frequency-container').append(`
                <tr class="frequency">
                    <td>${el.date}</td>
                    <td>${el.name}</td>
                    <td>${el.surname}</td>
                    <td>${el.frequency == "on" ? 'Tak' : 'Nie'}</td>                 
                    <td class="margin-btn">${deleteButton}</td>
                </tr>`);
            })
        }
    })
}

function deleteFrequency(id) {
    if (!confirm('Do you want to delete this frequency?')) {
        return;
    }

    const apiUrl = "http://localhost/ADRIANWII-PAI";

    $.ajax({
        url : apiUrl + '/?page=frequency_delete',
        method : "POST",
        data : {
            id : id
        },
        success: function() {
            setTimeout(function() {
                getFrequences();
            }, 500);
        }
    });
}

</script>

</body>
</html>