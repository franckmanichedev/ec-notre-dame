<!-- Start Blog Area -->
<section class="blog section" id="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Nos recents thèmes de spiritualité.</h2>
                    <img src="assets/img/section-img.jpg" height="50px" width="50px" alt="#">
                    <p>Les thèmes sont developpé et fait par les adhérents de notre groupe</p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php

                $themes = getAllTheme("themes");
                
                if(mysqli_num_rows($themes) > 0){
                    foreach ($themes as $item){
                        ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Blog -->
                            <div class="single-news">
                                <div class="news-head">
                                    <img src="uploads/<?= $item['image']?>" alt="<?= $item['image']?>">
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
                    ?>
                        <div class="col-md-12 d-flex justify-content-center mt-5">
                            <a href="all-themes.php" class="col-md-2 btn text-white view-all-btn">Voir tout</a>
                        </div>
                    <?php
                } else {
                    ?>
                        <em class="w-100 fw-bold text-white bg-danger">Aucun theme trouve</em>
                    <?php
                }

            ?>
        </div>
    </div>
</section>
<!-- End Blog Area -->
<style>
    .view-all-btn{
        animation: move 5s linear infinite;
        /* animation-delay: 5s; */
    }
    @keyframes move {
        0% {transform: translateY(0);}
        20% {transform: translateY(-10px);}
        30% {transform: translateY(-20px);}
        50% {transform: translateY(-5px);}
        60% {transform: translateY(0px);}
        70% {transform: translateY(0px);}
        85% {transform: translateY(1px);}
        93% {transform: translateY(2px);}
        100% {transform: translateY(0px);}
    }
</style>