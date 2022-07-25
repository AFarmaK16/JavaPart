<?php
	/**
	 * Classe métier représentant un article
	 */
	class Article
	{
		public $id;
		public $titre;
		public $contenu;
		public $categorie;
		public $dateCreation;
		public $dateModification;

		// private $bdd;

		// public function __construct()
		// {
		// 	$this->bdd = ConnexionManager::getInstance();
		// }

		public static function getList()
		{
			$bdd = ConnexionManager::getInstance();
			$data = $bdd->query("SELECT article.id,titre,dateCreation,contenu,libelle,categorie.id as categId FROM `article` ,`categorie` where article.categorie= categorie.id ORDER BY id ASC");
			$articles = $data->fetchAll(PDO::FETCH_CLASS, 'Article');
			$data->closeCursor();
			return $articles;
		}

		public static function getById($id)
		{
			$bdd = ConnexionManager::getInstance();
			$data = $bdd->query('SELECT * FROM Article WHERE id = '.$id);
			$article = $data->fetch(PDO::FETCH_OBJ);
			$data->closeCursor();
			return $article; 
		}

		public static function getByCategoryId($id)
		{
			$bdd = ConnexionManager::getInstance();
			$data = $bdd->query('SELECT * FROM Article WHERE categorie = '.$id);
			$articles = $data->fetchAll(PDO::FETCH_CLASS, 'Article');
			$data->closeCursor();
			return $articles;
		}

		// *******************ARTICLE MANAGE***************

	// ADD ARTICLE
	public static function addArticle($titre, $contenu, $categorie)
	{
		$bdd = ConnexionManager::getInstance();
		$create = $bdd->prepare("INSERT INTO article(titre,contenu,dateCreation,categorie) VALUES (:titre,:contenu,:dateCreation,:categorie)");

		if ($create->execute(array(
			'titre' => $titre,
			'contenu' => $contenu,
			'dateCreation' => date('Y-m-d H:i:s'),
			'categorie' => $categorie
		))) {
			return true;
		}

		return false;
	}

	// UPDATE ARTICLE
	public static function updateArticle($id, $titre, $contenu, $categorie)
	{
		$bdd = ConnexionManager::getInstance();
		$update = $bdd->prepare("UPDATE article SET titre=:titre , contenu=:contenu,dateCreation=:dateCreation,categorie=:categorie  WHERE id =:id");

		if ($update->execute(array(
			'titre' => $titre,
			'contenu' => $contenu,
			'dateCreation' => date('Y-m-d H:i:s'),
			'categorie' => $categorie,
			'id' => $id
		))) {
			return true;
		}

		return false;
	}

	//DELETE ARTICLE
	public static function deleteArticle($id)
	{
		$bdd = ConnexionManager::getInstance();
		$delete = $bdd->prepare("DELETE FROM article WHERE id =:id");
		if ($delete->execute(array(
			'id' => $id
		))) {
			return true;
		}

		return false;
	}

	// ***************CATEGORIE MANAGE****************
	// ADD CATEGORIE
	public static function addCategorie($categorie)
	{
		$bdd = ConnexionManager::getInstance();
		$create = $bdd->prepare("INSERT INTO categorie(libelle) VALUES (:libelle)");
		if ($create->execute(array(
			'libelle' => $categorie
		))) {
			return true;
		}

		return false;
	}

	// UPDATE CATEGORIE
	public static function updateCategorie($id, $categorie)
	{
		$bdd = ConnexionManager::getInstance();
		$update = $bdd->prepare("UPDATE categorie SET libelle=? WHERE id=?");
		if ($update->execute([$categorie, $id])) {
			return true;
		}
		return false;
	}
	//DELETE CATEGORIE
	public static function deleteCategorie($id)
	{
		$bdd = ConnexionManager::getInstance();
		$delete = $bdd->prepare("DELETE FROM categorie WHERE id =:id");
		if ($delete->execute(array(
			'id' => $id
		))) {
			return true;
		}

		return false;
	}
	}
	
?>