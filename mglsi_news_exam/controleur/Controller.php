<?php

	require_once 'modele/Article.php';
	require_once 'modele/Categorie.php';
	require_once 'modele/ConnexionManager.php';

	class Controller
	{
		
		function __construct()
		{
			
		}

		public function showAccueil()
		{
			$articles = Article::getList();
			$categories = Categorie::getList();

			require_once 'vue/accueil.php';
		}

		public function showArticle($id)
		{
			$article = Article::getById($id);
			$categories = Categorie::getList();
			
			require_once 'vue/article.php';
		}

		public function showCategorie($id)
		{
			$articles = Article::getByCategoryId($id);
			$categories = Categorie::getList();
			
			require_once 'vue/articleByCategorie.php';

		}

		public function ManageArticles()
	{
		$articles = Article::getList();
		$categories = Categorie::getList();

		require_once 'vue/manageArticles.php';
	}
	public function UpdateArticle($id, $titre, $contenu,$categorie)
	{
		$result = Article::updateArticle($id, $titre, $contenu,$categorie);
		// $categories = Categorie::getList();
		return $result;
	}
	public function DeleteArticle($id)
	{
		$result = Article::deleteArticle($id);
		return $result;
	}
	public function addArticle($titre, $contenu,$categorie)
	{
		$result = Article::addArticle($titre, $contenu,$categorie);
		return $result;
	}
	public function addCategorie($categorie)
	{
		$result = Article::addCategorie($categorie);
		return $result;
	}
	public function deleteCategorie($id)
	{
		$result = Article::deleteCategorie($id);
		return $result;
	}
	public function updateCategorie($id,$categorie)
	{
		$result = Article::updateCategorie($id,$categorie);
		return $result;
	}


	}
?>