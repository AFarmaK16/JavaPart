<?php
require_once 'controleur/Controller.php';
require_once 'controleur/UserController.php';
$controller = new Controller();
$UserController = new UserController();




if (isset($_GET['action'])) {
	if (strtolower($_GET['action']) === 'article') {
		if (isset($_GET['id'])) {
			$controller->showArticle($_GET['id']);
		}
	} else if (strtolower($_GET['action']) === 'categorie') {
		if (isset($_GET['id'])) {
			$controller->showCategorie($_GET['id']);
		}
	} else {
		$controller->showAccueil();
	}
	//ADMIN
} else if (isset($_GET['connect'])) {
	include 'vue/login.php';
	if ($_GET['profil'] == 'administrateur') {
		if (isset($_GET['todo'])) {
			if ($_GET['todo'] == 'update') {
				echo  $UserController->modifierUser($_GET['id'], $_GET['login'], $_GET['mdp'], $_GET['role']);
			} else if ($_GET['todo'] == 'add') {
				echo  $UserController->ajouterUser($_GET['login'], $_GET['motdepasse'], $_GET['role']);
			} else if ($_GET['todo'] == 'delete') {
				echo  $UserController->suppUser($_GET['id']);
			}
		} else {
			$UserController->ManageUsers();
		}
	} else {

		// EDITEUR

		if ($_GET['profil'] == 'editeur') {
			if (isset($_GET['todo'])) {
				if ($_GET['todo'] == 'update') {
					echo  $controller->UpdateArticle($_GET['id'], $_GET['titre'], $_GET['contenu'], $_GET['categorie']);
				} else if ($_GET['todo'] == 'addArticle') {
					echo  $controller->addArticle($_GET['titre'], $_GET['contenu'], $_GET['categorie']);
				} else if ($_GET['todo'] == 'addCateg') {
					echo  $controller->addCategorie($_GET['categorie']);
				} else if ($_GET['todo'] == 'updateCateg') {
					echo  $controller->updateCategorie($_GET['id'], $_GET['categorie']);
				} else if ($_GET['todo'] == 'deleteCateg') {
					echo  $controller->deleteCategorie($_GET['id']);
				} else {
					echo  $controller->DeleteArticle($_GET['id']);
				}
			} else {
				$controller->ManageArticles();
			}
		}
	}
} else {
	$controller->showAccueil();
}
