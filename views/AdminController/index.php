<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.php'); ?>

<body>
<div class="container">
    <div class="row">
        <h1 class="col-12 pl-0">ADMIN PANEL</h1>

        <h4 class="mt-4">Your data:</h4>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="users">
            <tr>
                <td><?= $user->getName(); ?></td>
                <td><?= $user->getSurname(); ?></td>
                <td><?= $user->getEmail(); ?></td>
                <td><?= $user->getRole(); ?></td>
                <td>-</td>
            </tr>
            </tbody>
        </table>

        <button class="btn btn-dark btn-lg" type="button" onclick="getUsers()">Get all users</button>
    </div>
</div>

<script>


function getUsers() {
    const apiUrl = "http://localhost/ADRIANWII-PAI";
    $.ajax({
        type: 'POST',
        url : apiUrl + '/?page=admin_users',
        dataType : 'json',
        success: function(data) {
            $('.users tr:not(:first)').remove();
            data.forEach(el => {
                $('.users').append(`<tr>
                    <td>${el.name}</td>
                    <td>${el.surname}</td>
                    <td>${el.email}</td>
                    <td>${el.role}</td>
                    <td>
                    <button class="btn btn-danger" type="button" onclick="deleteUser(${el.id})">
                        <i class="material-icons">delete_forever</i>
                    </button>
                    </td>
                    </tr>`);
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