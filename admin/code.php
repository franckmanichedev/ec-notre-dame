<?php

    session_start();
    include "../config/dbconfig.php";
    include "../functions/myfunctions.php";
    include "../Parsedown.php";

    // Create Update Delete themes Part
    if (isset($_POST['add_theme_btn'])){
        $libelle_theme = $con->real_escape_string(htmlspecialchars(($_POST["libelle_theme"])));
        $description_theme = $con->real_escape_string(htmlspecialchars(($_POST["description_theme"])));
        $content = $_POST["content"];
        $exposants = $con->real_escape_string(htmlspecialchars($_POST['exposants']));
        $auteur =  $_SESSION['auth_user']['nom'];
        
        // Initialisation du Parsedown
        $parsedown = new Parsedown();
        $content = $parsedown->text($content);

        $content = $con->real_escape_string($content);

        $image = $_FILES['image']['name'];
        $path = "../uploads";
        
        $image_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        $filename = time().".".$image_ext;

        // Préparez la requête pour insérer une nouvelle catégorie
        $themes_query = $con->prepare("INSERT INTO themes (libelle_theme, `description_theme`, content, `image`, exposants, author) VALUES (?, ?, ?, ?, ?, ?)");
        $themes_query->bind_param("ssssss", $libelle_theme, $description_theme, $content, $filename, $exposants, $auteur);
        
        // Vérifiez si l'insertion dans la base de données a réussi
        if($themes_query->execute()){
            // Verifier si le fichier est charge avec success
            if(move_uploaded_file($_FILES['image']['tmp_name'], $path ."/". $filename)){
                $_SESSION['message'] = "Categorie ajoute avec succes !";
                header('Location: all-themes.php');
                // redirect("themes.php", "Categorie ajoute avec succes !");
            } else {
                // Affichez des erreurs détaillées
                $error_message = "Erreur lors du telechargement du fichier !";
                switch ($_FILES['image']['error']) {
                    case UPLOAD_ERR_INI_SIZE:
                        $error_message .= " Le fichier téléchargé est trop lourd 2Mo maximum";
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        $error_message .= " Le fichier téléchargé dépasse la directive (2Mo maximum)";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $error_message .= " Le fichier n'a été que partiellement téléchargé.";
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        $error_message .= " Aucun fichier n'a été téléchargé.";
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $error_message .= " Il manque un dossier temporaire.";
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $error_message .= " Échec de l'écriture du fichier sur le disque.";
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        $error_message .= " Une extension PHP a arrêté le téléchargement du fichier.";
                        break;
                    default:
                        $error_message .= " Erreur inconnue.";
                        break;
                }
                $_SESSION['message'] = $error_message;
                header('Location: all-themes.php');
                // redirect("themes.php",$error_message);
            }
        } else {
            $_SESSION['message'] = "Erreur d'ajout du type de themes !" . $themes_query->error;
            header('Location: all-themes.php');
            // redirect("themes.php", "Erreur d'ajout de la categorie !" . $themes_query->error);
        }
        $themes_query->close();
    } else if (isset($_POST['update_theme_btn'])){
        $themes_id = $_POST['theme_id'];
        $libelle_theme = $con->real_escape_string(htmlspecialchars($_POST["libelle_theme"]));
        $description_theme = $con->real_escape_string(htmlspecialchars($_POST["description_theme"]));
        $content = $_POST["content"];
        $exposants = $con->real_escape_string(htmlspecialchars($_POST['exposants']));

        // Initialisation du Parsedown
        $parsedown = new Parsedown();
        $content = $parsedown->text($content);

        $content = $con->real_escape_string($content);

        $new_image = $_FILES['image']['name'];
        $old_image = $_POST['old_image'];

        if($new_image != ""){
            $update_filename = time() . "." . strtolower(pathinfo($new_image, PATHINFO_EXTENSION));
        } else {
            $update_filename = $old_image;
        }

        $path = "../uploads";

        $update_query = $con->prepare("UPDATE themes SET `libelle_theme`=?, description_theme=?, `image`=?, exposants=? WHERE id_themes = ?");
        $update_query->bind_param("ssssi", $libelle_theme, $description_theme, $update_filename, $exposants, $themes_id);
        
        if($update_query->execute()){
            if ($new_image != "") {
                if(move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $update_filename)){
                    if(file_exists('../uploads/'.$old_image)){
                        unlink('../uploads/'.$old_image);
                    }
                } else {
                    $_SESSION['message'] = "Categorie ajoute avec succes !";
                    header('Location: all-themes.php');
                    // redirect("edit-themes.php?id=$themes_id", "Categorie ajoute avec succes !");
                    exit();
                }
            }
            $_SESSION['message'] = "Type de themes modifier avec succes !";
            header('Location: all-themes.php');
            // redirect("edit-category.php?id=$themes_id", "Type de themes modifier avec succes !");
        } else {
            $_SESSION['message'] = "Erreur de mise a jour du type de themes !";
            header('Location: all-themes.php?id=$themes_id');
            // redirect("edit-category.php?id=$themes_id", "Erreur de mise a jour du type de themes !" . $update_query->error);
        }
        $update_query->close();
    } else if(isset($_POST['delete_theme_btn'])){
        $themes_id = $_POST['themes_id'];

        $themes_query = $con->prepare("SELECT * FROM themes WHERE id_themes = ?");
        $themes_query->bind_param("i", $themes_id);
        $themes_query->execute();
        $result = $themes_query->get_result();
        $themes_result = $result->fetch_assoc();

        $image = $themes_result['image'];

        $delete_query = $con->prepare("DELETE FROM themes WHERE id_themes=?");
        $delete_query->bind_param("i", $themes_id);
        $delete_query->execute();

        if($delete_query->affected_rows > 0){
            if(file_exists('../uploads/'.$image)){
                unlink('../uploads/'.$image);
            }
            $_SESSION['message'] = "Categorie supprimer avec succes !";
            header('Location: all-themes.php');
            // redirect("all-themes.php", "Category supprimer avec success !");
            // echo 200;
        } else {
            $_SESSION['message'] = "Erreur lors du chargement du fichier !";
            header('Location: all-themes.php');
            // redirect("all-themes.php", "Erreur lors du chargement du fichier !");
            // echo 500;
        }

    } 

    // Create Update Delete Activites Part
    if (isset($_POST['add_activity_btn'])){
        $libelle_activity = $con->real_escape_string(htmlspecialchars(($_POST["libelle_activity"])));
        $description_activity = $con->real_escape_string(htmlspecialchars(($_POST["description_activity"])));
        $date_activity = $con->real_escape_string(htmlspecialchars(($_POST["date_activity"])));
        $auteur =  $_SESSION['auth_user']['nom'];

        // Préparez la requête pour insérer une nouvelle catégorie
        $themes_query = $con->prepare("INSERT INTO activity (libelle_activity, `description_activity`, date_activity, author) VALUES (?, ?, ?, ?)");
        $themes_query->bind_param("ssss", $libelle_activity, $description_activity, $date_activity, $auteur);
        
        // Vérifiez si l'insertion dans la base de données a réussi
        if($themes_query->execute()){
            $_SESSION['message'] = "Categorie ajoute avec succes !";
            header('Location: all-activity.php');
            // redirect("all-activity.php", "Categorie ajoute avec succes !");
        } else {
            // Affichez des erreurs détaillées
            $_SESSION['message'] = "Erreur lors de l'enregistrement de l'activite";
            header('Location: all-activity.php');
            // redirect("all-activity.php","Erreur lors de l'enregistrement de l'activite");
        }
        $themes_query->close();
    } else if (isset($_POST['update_theme_btn'])){
        $themes_id = $_POST['theme_id'];
        $libelle_theme = $con->real_escape_string(htmlspecialchars($_POST["libelle_theme"]));
        $description_theme = $con->real_escape_string(htmlspecialchars($_POST["description_theme"]));
        $content = $con->real_escape_string(htmlspecialchars($_POST["content"]));
        $exposants = $con->real_escape_string(htmlspecialchars($_POST['exposants']));

        $new_image = $_FILES['image']['name'];
        $old_image = $_POST['old_image'];

        if($new_image != ""){
            $update_filename = time() . "." . strtolower(pathinfo($new_image, PATHINFO_EXTENSION));
        } else {
            $update_filename = $old_image;
        }

        $path = "../uploads";

        $update_query = $con->prepare("UPDATE themes SET `libelle_theme`=?, description_theme=?, `image`=?, exposants=? WHERE id_themes = ?");
        $update_query->bind_param("ssssi", $libelle_theme, $description_theme, $update_filename, $exposants, $themes_id);
        if($update_query->execute()){
            if ($new_image != "") {
                if(move_uploaded_file($_FILES['image']['tmp_name'], $path . "/" . $update_filename)){
                    if(file_exists('../uploads/'.$old_image)){
                        unlink('../uploads/'.$old_image);
                    }
                } else {
                    $_SESSION['message'] = "Categorie ajoute avec succes !";
                    header('Location: all-themes.php');
                    // redirect("edit-themes.php?id=$themes_id", "Categorie ajoute avec succes !");
                    exit();
                }
            }
            $_SESSION['message'] = "Type de themes modifier avec succes !";
            header('Location: all-themes.php');
            // redirect("edit-category.php?id=$themes_id", "Type de themes modifier avec succes !");
        } else {
            $_SESSION['message'] = "Erreur de mise a jour du type de themes !";
            header('Location: all-themes.php?id=$themes_id');
            // redirect("edit-category.php?id=$themes_id", "Erreur de mise a jour du type de themes !" . $update_query->error);
        }
        $update_query->close();
    } else if(isset($_POST['delete_theme_btn'])){
        $themes_id = $_POST['themes_id'];

        $themes_query = $con->prepare("SELECT * FROM themes WHERE id_themes = ?");
        $themes_query->bind_param("i", $themes_id);
        $themes_query->execute();
        $result = $themes_query->get_result();
        $themes_result = $result->fetch_assoc();

        $image = $themes_result['image'];

        $delete_query = $con->prepare("DELETE FROM themes WHERE id_themes=?");
        $delete_query->bind_param("i", $themes_id);
        $delete_query->execute();

        if($delete_query->affected_rows > 0){
            if(file_exists('../uploads/'.$image)){
                unlink('../uploads/'.$image);
            }
            $_SESSION['message'] = "Categorie supprimer avec succes !";
            header('Location: all-themes.php');
            // redirect("all-themes.php", "Category supprimer avec success !");
            // echo 200;
        } else {
            $_SESSION['message'] = "Erreur lors du chargement du fichier !";
            header('Location: all-themes.php');
            // redirect("all-themes.php", "Erreur lors du chargement du fichier !");
            // echo 500;
        }

    } 

    if(isset($_POST['add_admin_btn'])){
        $nom = $con->real_escape_string($_POST['nom']);
        $email = $con->real_escape_string($_POST['email']);
        $mdp = $_POST['password'];
        $cmdp = $_POST['confirm_password'];

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
                    redirect("admin.php", "Administrateur ajoute avec succes !");
                }
            } else {
                redirect("add-admin.php", "Les mots de passe ne correspondent pas !");
            }

        } else {
            redirect("add-admin.php", "L'email est déjà utilisé par un autre utilisateur.");
        }
    }

?>