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
    function addArticle(listCategories) {
        var listCateg = JSON.parse(JSON.stringify(listCategories));
        var selectInput = '<select id="swal-input2" class="swal2-input">';
        for (var i in listCategories) {
            selectInput += '<option  value="' + listCategories[i].id + '">' + listCategories[i].libelle + '</option>';
        }
        selectInput += '</select>';
        Swal.fire({
            title: `Ajout d'un nouveau article`,
            html: ` <input   id="swal-input1" class="swal2-input"  placeholder="titre" >` +
                selectInput +
                `<textarea  id="swal-input3"   placeholder="contenu" rows="9" cols="50"></textarea>`,
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
                        profil: 'editeur',
                        todo: 'addArticle',
                        titre: document.getElementById('swal-input1').value,
                        categorie: document.getElementById('swal-input2').value,
                        contenu: document.getElementById('swal-input3').value
                    },
                    success: function(data) {

                        if (data == 1) {
                            Swal.fire({
                                title: `L'article  a bien été ajouté`,
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
                                title: "Erreur lors de l'ajout de l'article",
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

    function updateArticle(listCategories, id, titre, contenu, categorie) {
        var listCategories = JSON.parse(JSON.stringify(listCategories));
        var selectInput = '<select id="swal-input2" class="swal2-input">';
        for (var i in listCategories) {
            selectInput += '<option  value="' + listCategories[i].id + '">' + listCategories[i].libelle + '</option>';
        }
        selectInput += '</select>';
        Swal.fire({
            title: `Modification de l'article #${id} de la categorie ${categorie}`,
            html: ` <input   id="swal-input1" class="swal2-input"  placeholder="titre" value="${titre}">` +
                selectInput +
                `<textarea  id="swal-input3"   placeholder="contenu" rows="9" cols="50">${contenu}</textarea>`,
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
                        profil: 'editeur',
                        todo: 'update',
                        id: id,
                        titre: document.getElementById('swal-input1').value,
                        categorie: document.getElementById('swal-input2').value,
                        contenu: document.getElementById('swal-input3').value
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
                                title: "Erreur lors de la modification de l'article",
                                icon: 'error',
                                showCancelButton: false,
                                showConfirmButton: false,
                                closeOnCancel: true,
                                timer: 2000,
                                timerProgressBar: true,
                            })
                        }
                    }
                })
            }
        })



    }

    function deleteArticle(id) {
        Swal.fire({
            title: `Suppression de l'article #${id}`,
            timer: 1000,
            showCancelButton: false,
            showConfirmButton: false,
            closeOnCancel: false,
        }).then(function() {
            $.ajax({
                type: "GET",
                url: "index.php",
                data: {
                    profil: 'editeur',
                    todo: 'deleteArticle',
                    id: id
                },
                success: function(data) {

                    if (data == 1) {
                        Swal.fire({
                            title: `Suppression de l'article #${id} effectue avec succes`,
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
                            title: "Erreur lors de la suppression de l'article #${id}",
                            icon: 'error',
                            showCancelButton: false,
                            showConfirmButton: false,
                            closeOnCancel: true,
                            timer: 2000,
                            timerProgressBar: true,
                        })
                    }
                }
            })
        })
    }

    function addCategorie() {
        Swal.fire({
            title: `Ajouter une nouvelle categorie`,
            html: ` <input   id="swal-input1" class="swal2-input"  placeholder="libelle" >`,
            // timer: 200000,
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
                        profil: 'editeur',
                        todo: 'addCateg',
                        categorie: document.getElementById('swal-input1').value
                    },
                    success: function(data) {

                        if (data == 1) {
                            Swal.fire({
                                title: `Nouvelle categorie ajoute avec succes`,
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
                                title: "Erreur lors de l'ajout de l'article",
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

    function updateCategorie(id, categorie) {
        Swal.fire({
            title: `Modification de la categorie #${id}`,
            html: ` <input   id="swal-input1" class="swal2-input"  placeholder="titre" value="${categorie}">`,
            timer: 200000,
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
                        profil: 'editeur',
                        todo: 'updateCateg',
                        id: id,
                        categorie: document.getElementById('swal-input1').value,
                    },
                    success: function(data) {

                        if (data == 1) {
                            Swal.fire({
                                title: `La categorie #${id} a bien été modifié`,
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
                                timerProgressBar: true,
                            })
                        }
                    }
                })
            }
        })



    }

    function deleteCategorie(id) {
        Swal.fire({
            title: `Suppression de la categorie #${id}`,
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
                    profil: 'editeur',
                    todo: 'deleteCateg',
                    id: id
                },
                success: function(data) {

                    if (data == 1) {
                        Swal.fire({
                            title: `Suppression de l'article #${id} effectue avec succes`,
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
                            title: "Erreur lors de la suppression de l'article #${id}",
                            icon: 'error',
                            showCancelButton: false,
                            showConfirmButton: false,
                            closeOnCancel: true,
                            timer: 2000,
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
    <?php require_once 'inc/entete.php'; ?>
    <?php
    require_once 'inc/menu.php';
    ?>

    <div id="contenu">

        <div class="container">
            <h4>Gerer les articles</h4>
            <?php
            $addArticle = 'addArticle(' . json_encode($categories) . ')';
            ?>
            <button class="btn btn-dark" onclick='<?= $addArticle; ?>'>Nouveau article</button>
            <button class="btn btn-dark" onclick="addCategorie();">Nouvelle categorie</button>

            <table class="table table-responsive">

                <tr>
                    <td>ID</td>
                    <td>titre</td>
                    <td>dateCreation</td>
                    <td>categorie</td>
                    <td>Contenu</td>
                    <td>Action</td>
                </tr>
                <?php if (!empty($articles)) : ?>
                    <?php foreach ($articles as $article) :
                        $a = json_encode($categories);
                        $updateArticle = 'updateArticle(' . $a . ',' . $article->id . ',"' . $article->titre . '","' . $article->contenu . '","' . $article->libelle . '")';
                    ?>
                        <tr>
                            <td><?= $article->id ?></td>
                            <td><?= $article->titre ?></td>
                            <td><?= $article->dateCreation ?></td>
                            <td><?= $article->libelle ?></td>
                            <td>
                                <p><?= substr($article->contenu, 0, 30) . '...' ?></p>
                            </td>
                            <td>
                                <i class='material-icons' onclick='<?= $updateArticle; ?>;'>edit</i>
                                <i class='material-icons' onclick="deleteArticle(<?= $article->id ?>);">delete</i>
                            </td>
                        </tr>
                    <?php endforeach ?>
            </table>
        <?php else : ?>
            <div class="message">Aucun article trouvé</div>
        <?php endif ?>
        </div>
        <!-- CATEGORIE TABLE -->
        <br><br><br>
        <div class="container">
            <h4>Gerer les categorie</h4>
            <button class="btn btn-dark" onclick="addCategorie();">Nouvelle categorie</button>
            <table class="table table-responsive">
                <tr>
                    <td>ID</td>
                    <td>libelle</td>
                    <td>Action</td>
                </tr>
                <?php if (!empty($categories)) : ?>
                    <?php foreach ($categories as $categorie) : ?>
                        <tr>
                            <td><?= $categorie->id ?></td>
                            <td><?= $categorie->libelle ?></td>

                            <td>
                                <i class='material-icons ed' onclick="updateCategorie(<?= $categorie->id ?>,'<?= $categorie->libelle ?>');" style=' cursor: pointer;' id='c$i'>edit</i>
                                <i class='material-icons ed' onclick="deleteCategorie(<?= $categorie->id ?>);" style=' cursor: pointer;' id='c$i'>delete</i>
                            </td>
                        </tr>
                    <?php endforeach ?>
            </table>
        <?php else : ?>
            <div class="message">Aucun article trouvé</div>
        <?php endif ?>
        </div>
    </div>

</body>

</html>