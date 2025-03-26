<?php

    session_start();
    include_once("myfunctions.php");

    if(isset($_POST["register_btn"])){
        $nom = $con->real_escape_string($_POST['nom']);
        $email = $con->real_escape_string($_POST['email']);
        $mdp = $_POST['mdp'];
        $cmdp = $_POST['c_mdp'];

        $check_query = $con->prepare("SELECT * FROM `admin` WHERE email = ?");
        $check_query->bind_param("s", $email);
        $check_query->execute();
        $result = $check_query->get_result();
        
        $check_users = $con->prepare("SELECT * FROM users WHERE email = ?");
        $check_users->bind_param("s", $email);
        $check_users->execute();
        $result = $check_users->get_result();

        if(mysqli_num_rows($result) == 0){
            if ($cmdp == $mdp){
                $hpwd = password_hash($mdp, PASSWORD_DEFAULT);

                $query_admin = $con->prepare("INSERT INTO `admin` (nom, email, `password`) VALUES (?, ?, ?)");
                $query_admin->bind_param("sss", $nom, $email, $hpwd);

                $role = 1;
                $query_user = $con->prepare("INSERT INTO users (nom, email, `password`, `role`) VALUES (?, ?, ?, ?)");
                $query_user->bind_param("sssi", $nom, $email, $hpwd, $role);
                $query_user->execute();

                if($query_admin->execute()){
                    $client_id = $query_admin->insert_id;
                    $_SESSION["message"] = "Compte administrateur creer avec succes !";
                    header("Location: admin/index.php");
                    // redirect("admin/index.php", "Administrateur ajoute avec succes !");
                }
            } else {
                $_SESSION["message"] = "Les mots de passe ne correspondent pas !";
                header("Location: admin/index.php");
                // redirect("admin/index.php", "Les mots de passe ne correspondent pas !");
            }

        } else {
            $_SESSION["message"] = "L'email est déjà utilisé par un autre utilisateur !";
            header("Location: ../register.php");
            // redirect("admin/index.php", "L'email est déjà utilisé par un autre utilisateur.");
        }
    } else if(isset($_POST["login_btn"])){
        $email = $con->real_escape_string($_POST['email']);
        $mdp = $_POST['mdp'];

        // On verifie si l'utilisateur existe dans la base de donnee
        $check_query = "SELECT * FROM users WHERE email = ?";
        $stmt = $con->prepare($check_query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $result_query = $result->num_rows;

        if ($result_query > 0) {
            $row = $result->fetch_assoc();

            // Execution si le le resultat est supperieur a zero
            // if(password_verify($mdp, $row['password']))
            if($mdp == $row['password']){
                $_SESSION['auth'] = true;
    
                $userid = $row['id'];
                $username = $row['nom'];
                $useremail = $row['email'];
                $role = $row['role'];
    
                $_SESSION['auth_user'] = [
                    'user_id' => $userid,
                    'nom' => $username,
                    'email' => $useremail,
                ];
    
                $_SESSION['role'] = $role;
    
                // On verifie si l'utilisateur a les droit d'administrateur
                if($role == 1){
                    $_SESSION["message"] = "Bienvenue dans votre dashboard !";
                    header("Location: ../admin/index.php");
                    // redirect("../admin/index.php", "Bienvenue dans votre dashboard");
                } else {
                    $_SESSION["message"] = "Connexion a votre compte reussi !";
                    header("Location: ../index.php");
                    // redirect("../index.php", "Connexion a votre compte reussi");
                }

            } else {
                $_SESSION["message"] = "Mot de passe incorrect !";
                header("Location: ../login.php");
                // redirect("../login.php", "Mot de passe incorrect");
            }
            
        } else {
            // Sinon on retourne que cet utilisateur n'existe pas
            redirect("../login.php", "L'email n'existe pas !");
        }
    }

?>