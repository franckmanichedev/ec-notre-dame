<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    
?>

<div class="container">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card strpied-tabled-with-hover">
                <?php 
                    if(isset($_SESSION['message'])){
                        ?>
                            <div class="alert alert-success" role="alert">
                                <a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Hey!</strong> <?= $_SESSION['message']; ?>
                            </div>
                        <?php
                        unset($_SESSION['message']);
                    } 
                ?>
                <div class="card-body table-full-width table-responsive" id="category_table">
                    <table class="table table-hover cursor-pointer table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Libelles</th>
                            <th>Date</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </thead>
                        <tbody>
                            <?php 
                                $themes = getAll("activity");

                                if(mysqli_num_rows($themes) > 0){
                                    foreach ($themes as $item){
                                        ?>
                                            <tr>
                                                <td><?= $item['id_activity'] ?></td>
                                                <td><?= $item['libelle_activity'] ?></td>
                                                <td><?= $item['date_activity']?></td>
                                                <td>
                                                    <a href="edit-activity.php?id=<?= $item['id_activity'] ?>" class="btn btn-primary">Modifier</a>
                                                </td>
                                                <td>
                                                    <form action="code.php" method="POST">
                                                        <input type="hidden" name="themes_id" value="<?= $item['id_activity'] ?>" />
                                                        <button class="btn btn-danger" type="submit" name="delete_theme_btn">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td class='alert alert-danger' colspan='5'>Aucune catégorie trouvée</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("./includes/footer.php"); ?>