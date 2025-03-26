<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    
?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Ajouter un nouveau theme de spiritualite
                        <a href="index.php" class="btn btn-primary float-end"><i class="bi bi-reply-fill"></i> Retour</a>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12"></div>
                                <div class="col-lg-12">
                                    <label for="">Intitule de l'activite</label>
                                    <input type="text" name="libelle_activity" placeholder="Entrer le theme du jour" class="form-control" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Description de l'activite</label>
                                    <textarea rows="" name="description_activity" placeholder="Entrer le contenue du theme ici" class="form-control content-theme" required></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Jour de l'activite</label>
                                    <input type="date" name="date_activity" placeholder="Entrer le nom de celui qui a expose" class="form-control" required>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-danger" name="add_activity_btn">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("./includes/footer.php"); ?>