<?php
function connectToDatabase(){

    // Définir les informations de connexion à la base de données
    define("MONHOST","localhost");
    define("MONUSER","root");
    define("MONPWD","");
    define("MABD","ghada");

    try {
        // Créer l'objet PDO pour la connexion à la base de données en utilisant les constantes définies
        $conn = new PDO("mysql:host=" . MONHOST . ";dbname=" . MABD, MONUSER, MONPWD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Retourner la connexion
        return $conn;
    } catch (PDOException $e) {
        // En cas d'erreur lors de la connexion, afficher l'erreur
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
        // Arrêter l'exécution du script en cas d'échec de la connexion
        die();
    }
}


function getAllCategories($conn){
    // Créer la requête SQL pour récupérer toutes les catégories
    $requete = "SELECT * FROM categories";

    // Exécuter la requête
    $resultat = $conn->query($requete);

    // Récupérer les résultats de la requête
    $categories = $resultat->fetchAll();

    // Retourner les catégories
    return $categories;
}

function getAllProducts($conn){
    // Créer la requête SQL pour récupérer tous les produits
    $requete = "SELECT * FROM produit";

    // Exécuter la requête
    $resultat = $conn->query($requete);

    // Récupérer les résultats de la requête
    $produit = $resultat->fetchAll();

    // Retourner les produits
    return $produit;
}

// Connexion à la base de données
$conn = connectToDatabase();

// Utilisation des fonctions pour récupérer les catégories et les produits
$categories = getAllCategories($conn);
$produits = getAllProducts($conn);

// Var_dump des résultats pour vérifier le bon fonctionnement
//var_dump($categories);
//var_dump($produits);

function searchProduits($conn, $keywords) {
    // Nettoyer les mots-clés pour éviter les injections SQL
    $keywords = "%$keywords%"; // Ajoute des jokers de pourcentage autour des mots-clés pour rechercher des correspondances partielles

    // Création de la requête
    $requette = "SELECT * FROM produit WHERE nom LIKE :keywords";

    // Préparation de la requête
    $statement = $conn->prepare($requette);

    // Liaison des valeurs des paramètres
    $statement->bindParam(':keywords', $keywords, PDO::PARAM_STR);

    // Exécution de la requête
    $statement->execute();

    // Récupération des résultats
    $resultats = $statement->fetchAll(PDO::FETCH_ASSOC);

    // Retourner les résultats de la recherche
    return $resultats;
}

function getProduitBYID($conn,$id){

// 1 creation de la requettte 

$requette ="SELECT * FROM produit WHERE id =$id  ";

// Préparation de la requête
$statement = $conn->prepare($requette);


// Exécution de la requête
    $statement->execute();

// Récupération des résultats
    $resultats = $statement->fetch();

// Retourner les résultats de la recherche
    return $resultats;
}
function getCategorieById($conn,$id){
    $requette ="SELECT * FROM categories WHERE id =$id  ";
    $statement = $conn->prepare($requette);
    $statement->execute();
    $resultats = $statement->fetch();
    return $resultats;
}
function getProduitByCategorie($conn,$id){
    $requette ="SELECT * FROM produit WHERE categorie =$id  ";
    $statement = $conn->prepare($requette);
    $statement->execute();  
    $resultats = $statement->fetchAll();
    return $resultats;
}

function AddVisiteur($conn, $data) {
    $mphash = md5($data['mp']); // Utilisation correcte de la variable $data['mp']

    $requette = "INSERT INTO visiteurs (nom, prenom, email, mp, telephone) VALUES ('$data[nom]', '$data[prenom]', '$data[email]', '$mphash', '$data[telephone]')";
    
    $resultat = $conn->query($requette);

    if ($resultat) {
        return true;
    } else {
        return false;
    }
}


function getVisiteurById ($conn, $id) {
    try {
        $requete = "SELECT * FROM visiteurs WHERE id=$id";
        $resultat = $conn->query($requete);
        if ($resultat === false) {
            // Gestion des erreurs en cas d'échec de la requête
            throw new Exception("Erreur lors de l'exécution de la requête.");
        }
        // Utilisation de fetchAll pour récupérer toutes les lignes de résultat
        $visiteur = $resultat->fetch();
        return $visiteur;
    } catch (Exception $e) {
        // Gestion des exceptions
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}


function ConnectVisiteur($conn, $data) {
    $email = $data['email'];
    $mp = md5($data['mp']);

    try {
        // Préparation de la requête
        $requete = $conn->prepare("SELECT * FROM visiteurs WHERE email=:email AND mp=:mp");

        // Liaison des paramètres
        $requete->bindParam(':email', $email);
        $requete->bindParam(':mp', $mp);

        // Exécution de la requête
        $requete->execute();

        // Récupération du résultat
        $user = $requete->fetch(PDO::FETCH_ASSOC);

        // Vérification si un utilisateur correspondant a été trouvé
        if ($user !== false) {
            return $user;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return false; // Retourner false en cas d'erreur
    }
}

function ConnectAdmin($conn,$data){

    $email = $data['email'];
    $mp = md5($data['mp']);

    try {
        // Préparation de la requête
        $requete = $conn->prepare("SELECT * FROM administrateur WHERE email=:email AND mp=:mp");

        // Liaison des paramètres
        $requete->bindParam(':email', $email);
        $requete->bindParam(':mp', $mp);

        // Exécution de la requête
        $requete->execute();

        // Récupération du résultat
        $user = $requete->fetch(PDO::FETCH_ASSOC);

        // Vérification si un utilisateur correspondant a été trouvé
        if ($user !== false) {
            return $user;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
        return false; // Retourner false en cas d'erreur
    }
}


function getAllVisitors($conn) {
    try {
        $requete = "SELECT * FROM visiteurs WHERE etat=0";
        $resultat = $conn->query($requete);
        if ($resultat === false) {
            // Gestion des erreurs en cas d'échec de la requête
            throw new Exception("Erreur lors de l'exécution de la requête.");
        }
        // Utilisation de fetchAll pour récupérer toutes les lignes de résultat
        $users = $resultat->fetchAll();
        return $users;
    } catch (Exception $e) {
        // Gestion des exceptions
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}

function getAllUsers($conn) {
    try {
        $requete = "SELECT * FROM visiteurs WHERE etat=1";
        $resultat = $conn->query($requete);
        if ($resultat === false) {
            // Gestion des erreurs en cas d'échec de la requête
            throw new Exception("Erreur lors de l'exécution de la requête.");
        }
        // Utilisation de fetchAll pour récupérer toutes les lignes de résultat
        $users = $resultat->fetchAll();
        return $users;
    } catch (Exception $e) {
        // Gestion des exceptions
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}

function EditAdmin($conn,$data){
    
            if($data['mp'] !=""){ //mot de passe a une valeur 

                $requete = "Update administrateur SET nom='".$data['nom']."' , email= '".$data['email']."' , mp='".md5($data['mp'])."'   where id='".$data['id_admin']."'  ";

            }else{
                $requete = "Update administrateur SET nom='".$data['nom']."' , email= '".$data['email']."'  where id='".$data['id_admin']."'  ";


            }


    
    $resultat = $conn->query($requete);

    return true;


}
function getAllPanier($conn) {
    try {
        $requete = "SELECT * FROM panier";
        $resultat = $conn->query($requete);
        if ($resultat === false) {
            // Gestion des erreurs en cas d'échec de la requête
            throw new Exception("Erreur lors de l'exécution de la requête.");
        }
        // Utilisation de fetchAll pour récupérer toutes les lignes de résultat
        $commandes = $resultat->fetchAll();
        return $commandes;
    } catch (Exception $e) {
        // Gestion des exceptions
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}


function getCommandePerPanier ($conn, $id) {
    try {
        $requete = "SELECT * FROM commandes WHERE panier=$id";
        $resultat = $conn->query($requete);
        if ($resultat === false) {
            // Gestion des erreurs en cas d'échec de la requête
            throw new Exception("Erreur lors de l'exécution de la requête.");
        }
        // Utilisation de fetchAll pour récupérer toutes les lignes de résultat
        $commandes = $resultat->fetchAll();
        return $commandes;
    } catch (Exception $e) {
        // Gestion des exceptions
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}

function getPanierByEtat ($etat ,$paniers) {
    $paniersEtat = array();

    foreach ($paniers as $panier) {
        if ($panier['etat'] == $etat) {
            array_push($paniersEtat, $panier);
        }
    }
    return $paniersEtat;
}

function getPanierByUser ($conn , $id) {
    try {
        $requete = "SELECT * FROM panier WHERE visiteur=$id";
        $resultat = $conn->query($requete);
        if ($resultat === false) {
            // Gestion des erreurs en cas d'échec de la requête
            throw new Exception("Erreur lors de l'exécution de la requête.");
        }
        // Utilisation de fetchAll pour récupérer toutes les lignes de résultat
        $commandes = $resultat->fetchAll();
        return $commandes;
    } catch (Exception $e) {
        // Gestion des exceptions
        echo "Erreur: " . $e->getMessage();
        return false;
    }

}

function getAllCommandes($conn) {
    try {
        $requete = "SELECT * FROM commandes";
        $resultat = $conn->query($requete);
        if ($resultat === false) {
            // Gestion des erreurs en cas d'échec de la requête
            throw new Exception("Erreur lors de l'exécution de la requête.");
        }
        // Utilisation de fetchAll pour récupérer toutes les lignes de résultat
        $commandes = $resultat->fetchAll();
        return $commandes;
    } catch (Exception $e) {
        // Gestion des exceptions
        echo "Erreur: " . $e->getMessage();
        return false;
    }
}
?>
