<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    
?>

<!-- Inclure TinyMCE avec votre clé API -->
<script src="https://cdn.tiny.cloud/1/bmevvriwz3wi0l9q6jkokbmbbiv8gnouiakm9h1gtjrkqu30/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea[name="content"]',
        plugins: [
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown', 'importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
</script>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            
            <?php
                if(isset($_GET['id']) && !empty($_GET['id'])){
                    $id = $_GET['id'];
                    $visa = getThemeById("themes", $id);

                    if(mysqli_num_rows($visa) > 0){
                        $data = mysqli_fetch_assoc($visa);
                        ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                        Modifier un type de visa
                                        <a href="all-themes.php" class="btn btn-primary float-end"><i class="bi bi-reply-fill"></i> Retour</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12"></div>
                                            <div class="col-lg-12">
                                                <input type="hidden" name="theme_id" value="<?= $data['id_themes']?>">
                                                <label for="">Libelle</label>
                                                <input type="text" name="libelle_theme" value="<?= htmlspecialchars($data['libelle_theme'])?>" placeholder="Entrer le nouveau libelle" class="form-control" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="">Description</label>
                                                <input syle="height: 100px;" type="text" name="description_theme" class="form-control" required value="<?= htmlspecialchars($data['description_theme'])?>">
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="">Expose</label>
                                                <textarea rows="5" name="content" class="form-control" required><?= ($data['content'])?></textarea>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="">Modifier image</label>
                                                <input type="file" name="image" class="form-control">
                                                <label for="">Image actuelle</label>
                                                <input type="hidden" name="old_image" value="<?= $data['image']?>">
                                                <img src="../uploads/<?= $data['image'] ;?>" alt="<?= $data['image'] ;?>" height="50px" width="auto">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Exposants</label>
                                                <input type="text" name="exposants" class="form-control" required value="<?= htmlspecialchars($data['exposants'])?>">
                                            </div>
                                            <div class="col-lg-12">
                                                <button type="submit" class="btn btn-primary" name="update_theme_btn">Modifier</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php
                    } else {
                        echo "<p class='alert alert-danger'>Oops, l'id a ete perdu !</p>";
                    }

                } else {
                    echo "<p class='alert alert-danger'>Hey, l'id a ete perdu !</p>";
                }
            ?>
        </div>
    </div>
</div>

<?php include("./includes/footer.php"); ?>