<?php 

    // session_start();
    include("../middleware/adminMiddleware.php");
    include("includes/header.php");
    include "../Parsedown.php";
    
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
                                    <label for="">Libelle</label>
                                    <input type="text" name="libelle_theme" placeholder="Entrer le theme du jour" class="form-control" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Descfiption</label>
                                    <input type="text" name="description_theme" placeholder="Entrer la description du theme" class="form-control" required>
                                </div>
                                <div class="col-lg-12">
                                    <label for="">Contenue</label>
                                    <textarea rows="" name="content" placeholder="Entrer le contenue du theme ici" class="form-control content-theme" required></textarea>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Selectionner un image</label>
                                    <input type="file" name="image" class="form-control" required>
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Nom de l'exposants</label>
                                    <input type="text" name="exposants" placeholder="Entrer le nom de celui qui a expose" class="form-control" required>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-danger" name="add_theme_btn">Enregistrer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include("./includes/footer.php"); ?>