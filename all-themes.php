<?php
    session_start();
    include "config/dbconfig.php";
    include "includes/header.php";
    include "functions/usersfunctions.php";
?>
    
    <!-- Breadcrumbs -->
    <div class="breadcrumbs overlay">
        <div class="container">
            <div class="bread-inner">
                <div class="row">
                    <div class="col-12">
                        <h2>Blog Single</h2>
                        <ul class="bread-list">
                            <li><a href="index.php">Accueil</a></li>
                            <li><i class="icofont-simple-right"></i></li>
                            <li class="active">Bibliotheques themes</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <section class="blog section" id="blog">
        <div class="container">
            <div class="row">
                <?php

                    $themes = getAllThemeDes("themes");
                    
                    if(mysqli_num_rows($themes) > 0){
                        foreach ($themes as $item){
                            ?>
                            <div class="col-lg-4 col-md-6 col-12 mt-3">
                                <!-- Single Blog -->
                                <div class="single-news">
                                    <div class="news-head">
                                        <img src="uploads/<?= $item['image']?>" alt="#" class="w-100" height="10px">
                                    </div>
                                    <div class="news-body">
                                        <div class="news-content">
                                            <div class="date">
                                                <?php echo date('D d, Y', strtotime($item['created_at'])); ?>
                                            </div>
                                            <h2><a href="blog-single.php?id=<?= $item['id_themes']?>"><?= htmlspecialchars_decode($item['libelle_theme'])?></a></h2>
                                            <p class="blog-text">
                                                <?= nl2br(htmlspecialchars_decode(substr($item['description_theme'], 0, 100))) . '...'?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Single Blog -->
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                            <em class="w-100 fw-bold text-white bg-danger">Aucun theme trouve</em>
                        <?php
                    }

                ?>
            </div>
        </div>
    </section>
<?php
    include "includes/footer.php";
?>