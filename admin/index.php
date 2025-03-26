<?php

    include "../middleware/adminMiddleware.php";
    include "./includes/header.php";

?>
<div class="content">
    <div class="col-md-12">
        <div class="row">
            <?php 
                if(isset($_SESSION['message'])){
                    ?>
                        <div class="alert alert-warning" role="alert">
                            <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Hey!</strong> <?= $_SESSION['message']; ?>
                        </div>
                    <?php
                    unset($_SESSION['message']);
                } 
            ?>
            <div class="ms-3">
                <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
                <p class="mb-4">
                    Check the sales, value and bounce rate by country.
                </p>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Today's Money</p>
                                <h4 class="mb-0">$53k</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-primary shadow-dark shadow text-center border-radius-lg">
                                <i class="bi bi-calendar2-week opacity-10 "></i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+55% </span>than last week</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                                <h4 class="mb-0">2300</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                <i class="bi bi-person opacity-10"></i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3% </span>than last month</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Ads Views</p>
                                <h4 class="mb-0">3,462</h4>
                            </div>
                            <div class="icon icon-md icon-shape bg-gradient-warning shadow-dark shadow text-center border-radius-lg">
                                <i class="bi bi-clipboard-check opacity-10"></i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                        <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">-2% </span>than yesterday</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-header p-2 ps-3">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-sm mb-0 text-capitalize">Sales</p>
                            <h4 class="mb-0">$103,430</h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                            <i class="bi bi-bag-check opacity-10"></i>
                        </div>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-2 ps-3">
                    <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>than yesterday</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bouton pour générer le PDF -->
<div class="text-center mt-4">
    <a href="generate_pdf.php" class="btn btn-primary">Télécharger le PDF</a>
</div>

<?php 
    include "./includes/footer.php"; 
?>