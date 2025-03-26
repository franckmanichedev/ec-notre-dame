<?php
    session_start();
    include "includes/header.php";
    include "functions/usersfunctions.php";

    if(isset($_GET['id'])){
        $themes_id = intval($_GET['id']);

        $themes = getThemeById("themes", $themes_id);

        if(mysqli_num_rows($themes) > 0){
        foreach($themes as $item){
?>
        <!-- Breadcrumbs -->
        <div class="breadcrumbs overlay">
            <div class="container">
                <div class="bread-inner">
                    <div class="row">
                        <div class="col-12">
                            <h2>Blog Single</h2>
                            <ul class="bread-list">
                                <li><a href="index.php">Home</a></li>
                                <li><i class="icofont-simple-right"></i></li>
                                <li><a href="./all-themes.php">Blog Single</a></li>
                                <li><i class="icofont-simple-right"></i></li>
                                <li class="active"><?= htmlspecialchars($item['libelle_theme']) ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumbs -->
        
        <!-- Single News -->
        <section class="news-single section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="single-main">
                                    <!-- News Head -->
                                    <div class="news-head">
                                        <img src="uploads/<?= htmlspecialchars($item['image']) ?>" alt="#">
                                    </div>
                                    <!-- News Title -->
                                    <h1 class="news-title"><a href="news-single.html"><?= htmlspecialchars($item['libelle_theme']) ?></a></h1>
                                    <!-- Meta -->
                                    <div class="meta">
                                        <div class="meta-left">
                                            <span class="author"><a href="#"><img src="./assets/img/author1.jpg" alt="#"><?= htmlspecialchars($item['exposants']) ?></a></span>
                                            <span class="date"><i class="fa fa-clock-o"></i><?php echo date('M d, Y', strtotime($item['created_at'])); ?></span>
                                        </div>
                                    </div>
                                    <!-- News Text -->
                                    <div class="news-text">
                                        <?= $item['content']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="main-sidebar">
                            <!-- Single Widget -->
                            <div class="single-widget search">
                                <div class="form">
                                    <input type="email" placeholder="Search Here...">
                                    <a class="button" href="#"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <!--/ End Single Widget -->
                            <!-- Single Widget -->
                            <div class="single-widget category">
                                <h3 class="title">Activite Proches</h3>
                                <?php
                                    // Recuperation de la date actuelle
                                    $dateActuelle = new DateTime();

                                    $activity = getAllActivity("activity");
                                    
                                    if(mysqli_num_rows($activity) > 0){
                                        foreach ($activity as $item){

                                            $dateActivity = new DateTime($item['date_activity']);

                                            //Calcul de la difference entre les deux date
                                            $interval = $dateActuelle->diff($dateActivity);
                                            ?>
                                                <ul class="categor-list">
                                                    <li class="row d-flex flex-colum justify-content-between">
                                                        <a href="activity-detail.php?id=<?= $item['id_activity']?>" class="col-md-7 fw-bold">
                                                            <?= htmlspecialchars($item['libelle_activity']) ?><br>
                                                            <?= 
                                                                $interval->m . " Mois " .
                                                                $interval->d . " Jours " ;
                                                            ?>
                                                        </a>
                                                        <p class="col-md-5 ms-auto"><?= htmlspecialchars($item['date_activity']) ?></p>
                                                    </li>
                                                </ul>
                                            <?php
                                        }
                                    }

                                ?>
                            </div>
                            <!--/ End Single Widget -->
                            <!-- Single Widget -->
                            <div class="single-widget recent-post">
                                <h3 class="title">Recent thèmes</h3>
                                <?php

                                    $themes = getAllTheme("themes");
                                    
                                    if(mysqli_num_rows($themes) > 0){
                                        foreach ($themes as $item){
                                            ?>
                                                <!-- Single Post -->
                                                <div class="single-post">
                                                    <div class="image">
                                                        <img src="uploads/<?= htmlspecialchars($item['image']) ?>" alt="#">
                                                    </div>
                                                    <div class="content">
                                                        <h5><a href="blog-single.php?id=<?= $item['id_themes']?>"><?= htmlspecialchars($item['libelle_theme']) ?></a></h5>
                                                        <ul class="comment">
                                                            <li>
                                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                                <?php echo date('M d, Y', strtotime($item['created_at'])); ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <!-- End Single Post -->
                                            <?php
                                        }
                                    }

                                ?>
                            </div>
                            <!--/ End Single Widget -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ End Single News -->

<?php
            }
        }
    }
    include "includes/footer.php";
?>
<script>
    // Fonction pour mettre à jour le compte à rebours
    function updateCompteRebours() {
        // Récupération de la date entrée par l'utilisateur
        var dateUtilisateur = new Date(document.getElementById('date').value);

        var dateActuelle = new Date();
        var interval = dateUtilisateur.getTime() - dateActuelle.getTime();
        var jours = Math.floor(interval / (1000 * 60 * 60 * 24));
        var heures = Math.floor((interval % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((interval % (1000 * 60 * 60)) / (1000 * 60));
        var secondes = Math.floor((interval % (1000 * 60)) / 1000);
        document.getElementById('compteRebours').innerHTML = jours + " jours, " + heures + " heures, " + minutes + " minutes, " + secondes + " secondes";
    }

    // Actualisation du compte à rebours toutes les secondes
    setInterval(updateCompteRebours, 1000);

    // Mettre a jour la date utilisateur a chaque changement de date
    document.getElementById('date').addEventListener('changer', updateCompteRebours);
</script>