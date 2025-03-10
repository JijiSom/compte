<?php


declare(strict_types=1);

session_start();

include './model/model_users.php';
include './utils/function.php';

$message="";
$messageSO="";



//  Test donnée Formulaire d' inscription 
function inscriptionCompte(): array{

    if(empty($_POST["login_user"]) || empty($_POST["Mdp"])){
        return ["Nom"=>'',"Prenom" => '',"login_user"=>'',"NewMdp"=>'',"Mdp"=>'',"erreur"=>'Veuillez remplir le login et le mot de passe!'];
    
    }

    $Nom = sanitize($_POST['Nom'] ?? '');
    $Prenom= sanitize($_POST['Prenom'] ?? '');
    $login = sanitize($_POST["login_user"] ?? '');
    $Nmdp = sanitize($_POST['NewMdp'] ?? '');
    $mdp = sanitize($_POST['Mdp'] ?? '');


    if(!filter_var($login, FILTER_VALIDATE_EMAIL)){
        return ["Nom"=>$Nom, "Prenom"=>$Prenom, "login_user"=>$login, "NewMdp"=> $Nmdp, "Mdp"=> $mdp , "erreur"=>"mail du sorcier incorrect"];
       
    }   
        $hashedMdp = password_hash($mdp, PASSWORD_BCRYPT);
        
        return ["Nom"=>$Nom, "Prenom"=>$Prenom, "login_user"=>$login, "NewMdp"=> $Nmdp, "Mdp"=> $hashedMdp ];

    }

// Formulaire de connexion 

function connexionCompte(): array{

    if(empty($_POST["loginCo"]) || empty($_POST["MdpCo"])){
  
        return ["loginCo"=>'',"MdpCo"=>'',"erreur"=>'Veuillez remplir les champs affichés'];
     }

        $login = sanitize($_POST["loginCo"]);
        $Mdp = sanitize($_POST["MdpCo"]);

        if(!filter_var($login, FILTER_VALIDATE_EMAIL)){
            return["loginCo"=>'',"MdpCo"=>'',"erreur"=>'login pas bon'];
        }
        return["loginCo"=> $login, "MdpCo"=> $Mdp,"erreur"=>''];
    
}


// Envoi donnée en  insertion de BDD  
function addUser($login, $Nmdp,$mdp, $Nom = "", $Prenom = ""){
    $bdd = new PDO('mysql:host=localhost;dbname=WITCH','','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    try{
        $req = $bdd->prepare('INSERT INTO users (Nom, Prenom, login_user, Nmdp,mdp) VALUES (?,?,?,?,?)');

        $req->bindParam(1,$Nom,PDO::PARAM_STR);
        $req->bindParam(2,$Prenom,PDO::PARAM_STR);
        $req->bindParam(3,$login,PDO::PARAM_STR);
        $req->bindParam(4,$Nmdp,type: PDO::PARAM_STR);
        $req->bindParam(5,$mdp,type: PDO::PARAM_STR);

        $req->execute();

        return "$Nom $Prenom , dont le login est : $login , a été enregistré avec succès !";
    }catch(EXCEPTION $error){
    
        return $error->getMessage();
    }
}

 
function readWitch(){
    $bdd = new PDO('mysql:host=localhost;dbname=WITCH','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    try{
        $req = $bdd->prepare('SELECT id, Nom, Prenom, login_user, mdp, Nmdp FROM users');

        $req->execute();

        $req->fetchAll(PDO::FETCH_ASSOC);

        return $req->fetchAll(PDO::FETCH_ASSOC);
    }catch(EXCEPTION $error){
        return "erreur sorcier:" . $error->getMessage();
    }
}

function readWitchLogin($login_user){
    $bdd = new PDO('mysql:host=localhost;dbname=WITCH','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    try{
        $req = $bdd->prepare('SELECT Id, Nom, Prenom, login_user, Nmdp, mdp FROM users WHERE login_user = ?');

        $req->bindParam(1,$login_user,PDO::PARAM_STR);

        $req->execute();

        $data = $req->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }catch(EXCEPTION $error){
        return $error->getMessage();
    }
}




// Inscription envoyer 

if(isset($_POST["inscription"])){
    $tab = inscriptionCompte();

    if($tab['erreur'] != ''){
        $message = $tab['erreur'];
    }else{
        if(empty(readWitchLogin($tab['login_user']))){
            $message = addUser($tab['login_user'],$tab['Nmdp'],$tab['mdp'],$tab['Nom'],$tab['Prenom']);

        }else{
            $message="Ce Prénom de sorcier existe déja  !";
        }
    }
}

// Connexion Envoyer 

if(isset($_POST['connexion'])){
    $tab = connexionCompte();

    if($tab['erreur'] != ''){
        $messageCo = $tab['erreur'];
    }else{
        $data = readWitchLogin($tab['loginCo']);

        if(gettype($data) == 'string'){
            $messageCo = $data;
        }else{
            if(empty($data)){
                $messageCo = "Il y a une erreur petit sorcier !";
            }else{
                if(!password_verify($tab['passwordCo'],$data[0]['mdp'])){
                    $messageCo = "Une erreur dans ce mot de passe jeune sorcier  !";
                }else{
                    $_SESSION['id'] = $data[0]['id'];
                    $_SESSION['Nom'] = $data[0]['Nom'];
                    $_SESSION['Prenom'] = $data[0]['Prenom'];
                    $_SESSION['login_user'] = $data[0]['login_user'];
                    
                    $messageCo = "{$_SESSION['login_user']} est connecté avec succés !";
                }
            }
        }
    }
}





include  './view/view_accueil_connexion.php';
include './view/view_accueil_ inscription.php';
include './view/view_compte.php';
?>