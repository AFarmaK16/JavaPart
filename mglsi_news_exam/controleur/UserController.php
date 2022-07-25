<?php

	require_once 'modele/Article.php';
	require_once 'modele/Categorie.php';
   	require_once 'modele/ConnexionManager.php';
    require_once 'modele/Users.php';

	class UserController
	{
		
		function __construct()
		{
			
		}

		public function ManageUsers()
		{
          $users= Users::getAllUsers();
		  $categories = Categorie::getList();
		  
		  require_once 'vue/GestionUser.php';
		}
		// CONNECTION
		function UserLogin($login,$password,$role)
		{
			require_once 'vue/Login.php';
		  $users= Users::getUser($login,$password,$role);
		//   $categories = Categorie::getList();
		  
		}
		public function ajouterUser($login,$mdp,$role)
	{
		$resultat = Users::addUser($login,$mdp,$role);
		return $resultat;
	}
	public function suppUser($id)
	{
		$result = Users::deleteUser($id);
		return $result;
	}
	public function modifierUser($id,$login,$password,$role)
	{
		$result = Users::updateUser($id,$login,$password,$role);
		return $result;
	}
	}
?>