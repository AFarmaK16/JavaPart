<?php

class Users
{
  public static function getAllUsers()
  {
    $bdd = ConnexionManager::getInstance();
    $requete = $bdd->query('SELECT * FROM user');
    $users = $requete->fetchAll();
    return $users;
  }
  public static function getUser($login,$password,$role)
  {
    $bdd = ConnexionManager::getInstance();
    $requete = $bdd->prepare('SELECT * FROM user where email=?,password=?,role=?');
    if ($requete->execute([$login,$password,$role])) {
      return true;
    }

    return false;
  }
  public static function addUser($login, $motdepasse, $role)
  {
    $bdd = ConnexionManager::getInstance();
    $requete = $bdd->prepare("INSERT INTO user (email,password,role) VALUES ('$login','$motdepasse','$role')");
    if ($requete->execute(array(
      'login' => $login,
      'motdepasse' => $motdepasse,
      'role' => $role
    ))) {
      return true;
    }

    return false;
  }

  public static function updateUser($id, $email, $password, $role)
  {
    $bdd = ConnexionManager::getInstance();
    // $x='password';
    $requete = $bdd->prepare("UPDATE user SET email=? , password=?,role=? WHERE id=?");
    if ($requete->execute([
      $email, $password, $role, $id
    ])) {
      return true;
    }

    return false;
    // $bdd = ConnexionManager::getInstance();
    // $requete = $bdd->query('SELECT * FROM user');
    // if($users = $requete->fetchAll()){
    //   return true;
    // }
    // return 'false';
  }

  public static function deleteUser($id)
  {
    $bdd = ConnexionManager::getInstance();
    $requete = $bdd->prepare("DELETE FROM user WHERE id=:id");
    if ($requete->execute(array(
      'id' => $id
    ))) {
      return true;
    }

    return false;
  }
}
