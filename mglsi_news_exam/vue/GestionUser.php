<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Actualités</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style1.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <script src="lib/jquery/jquery.min.js"></script>

</head>

<script>
    function addUser() {
        Swal.fire({
            title: `Ajout d'un nouveau utilisateur`,
            html: ` <input   id="swal-input1" class="swal2-input"  placeholder="login" >` +
                ` <input   id="swal-input2" class="swal2-input"  placeholder="mot de passe" >` +
                `<select id="swal-input3" class="swal2-input" placeholder="role"  >
                <option> admin </option>
                <option> editeur </option>
                </select>`,

            timer: 200000,
            showCancelButton: true,
            showConfirmButton: true,
            closeOnCancel: true,
            confirmButtonText: "ajouter",
            cancelButtonText: "annuler",
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "index.php",
                    data: {
                        profil: 'administrateur',
                        todo: 'add',
                        login: document.getElementById('swal-input1').value,
                        motdepasse: document.getElementById('swal-input2').value,
                        role: document.getElementById('swal-input3').value
                    },
                    success: function(data) {

                        if (data == 1) {
                            Swal.fire({
                                title: `L'utilisateur a bien été ajouté`,
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                timer: 2000,
                                timerProgressBar: true,
                            }).then(function() {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: data,
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                // timer: 2000,
                                timerProgressBar: true,
                            })
                        }
                    }
                })
            }
        })



    }

    function updateUser(id, login, mdp, role) {

        Swal.fire({
            title: `Modification de l'utilisateur avec l'id #${id}  `,
            html: ` <input   id="swal-input1" class="swal2-input"  placeholder="login" value="${login}">` +
                ` <input   id="swal-input2" class="swal2-input"  placeholder="mdp"  value="${mdp}">` +
                `<input   id="swal-input3" class="swal2-input"  placeholder="role" value="${role}">`,
            // timer: 200000,
            showCancelButton: true,
            showConfirmButton: true,
            closeOnCancel: true,
            confirmButtonText: "Modifier",
        }).then((result) => {
            console.log(result);
            if (result.isConfirmed) {
                $.ajax({
                    type: "GET",
                    url: "index.php",
                    data: {
                        profil: 'administrateur',
                        todo: 'update',
                        id: id,
                        login: document.getElementById('swal-input1').value,
                        mdp: document.getElementById('swal-input2').value,
                        role: document.getElementById('swal-input3').value
                    },
                    success: function(data) {

                        if (data == 1) {
                            Swal.fire({
                                title: `L'article #${id} a bien été modifié`,
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                timer: 2000,
                                timerProgressBar: true,
                            }).then(function() {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                title: data,
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                // timer: 2000,
                                timerProgressBar: true,
                            })
                        }
                    }
                })
            }
        })



    }

    function deleteUser(id) {
        Swal.fire({
            title: `Suppression de l'utilisateur #${id}`,
            timer: 1000,
            showCancelButton: false,
            showConfirmButton: false,
            closeOnCancel: false,
            // confirmButtonText: "Supprimer",
        }).then(function() {
            $.ajax({
                type: "GET",
                url: "index.php",
                data: {
                    profil: 'administrateur',
                    todo: 'delete',
                    id: id
                },
                success: function(data) {

                    if (data == 1) {
                        Swal.fire({
                            title: `Suppression de l'utilisateur #${id} effectue avec succes`,
                            icon: 'success',
                            showCancelButton: false,
                            showConfirmButton: false,
                            closeOnCancel: true,
                            timer: 2000,
                            timerProgressBar: true,
                        }).then(function() {
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            // title: data,
                            title: "Erreur lors de la suppression de l'utilisateur #${id}",
                            icon: 'error',
                            showCancelButton: false,
                            showConfirmButton: false,
                            closeOnCancel: true,
                            timer: 20000,
                            timerProgressBar: true,
                        })
                    }
                }
            })
        })
        // })



    }
</script>

<body>
    <div>
        <?php require_once 'inc/entete.php';
        require_once 'inc/menu.php';
        ?>
        <div id="contenu">
            <div class="container">
                <h4>Gestion des utilisateurs</h4>

                <table class="table table-responsive">
                    <tr>
                        <td>ID</td>
                        <td>login</td>
                        <td>role</td>
                        <td>Action</td>
                        <td> <button class="btn btn-dark" onclick="addUser();">Nouveau utilisateur</button>
                        </td>
                    </tr>

                    <?php foreach ($users as $user) : ?>

                        <tr>
                            <td> <?= $user['id'] ?> </td>
                            <td> <?= $user['email'] ?> </td>
                            <td> <?= $user['role'] ?> </td>
                            <td>
                                <i class='material-icons ed' onclick="updateUser(<?= $user['id'] ?>,'<?= $user['email'] ?>','<?= $user['password'] ?>','<?= $user['role'] ?>');" style=' cursor: pointer;' id='c$i'>edit</i>
                                <i class='material-icons ed' onclick="deleteUser(<?= $user['id'] ?>);" style=' cursor: pointer;' id='c$i'>delete</i>
                            </td>
                        </tr>

                    <?php endforeach ?>
                </table>


            </div>
        </div>
    </div>

</body>

</html>