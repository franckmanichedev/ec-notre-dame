<?php
    $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);
?>

<div class="sidebar" data-image="../assets/img/sidebar-5.jpg">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="" class="simple-text">
                ZONE TRAVEL Services
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item <?= $page == "index.php" ? "active":"";?>">
                <a class="nav-link" href="index.php"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Tompson">
                    <i class="icofont icofont-home"></i>
                    <p>Accueil</p>
                </a>
            </li>
            <?php
                if(isset($_SESSION['auth'])){
                    if($role = $_SESSION['role'] == 1){

                        $spiritMember = getAllSpirit('admin');
                        if(mysqli_num_rows($spiritMember) > 0){ 
                            foreach($spiritMember as $item){
                                $role_as = $item['role'];

                                if($role_as != 1){
                                    ?>
                                        <li class="nav-item <?= $page == "add-theme.php" ? "active":"";?>">
                                            <a class="nav-link" href="add-theme.php">
                                                <i class="icofont icofont-file-document"></i>
                                                <p>Ajouter theme</p>
                                            </a>
                                        </li>
                                        <li class="nav-item <?= $page == "all-themes.php" ? "active":"";?>">
                                            <a class="nav-link" href="all-themes.php">
                                                <i class="icofont icofont-document-folder"></i>
                                                <p>Expose</p>
                                            </a>
                                        </li>
                                    <?php
                                }
                            }
                        }
                    }
                }
            ?>
            <li class="nav-item <?= $page == "add-activity.php" ? "active":"";?>">
                <a class="nav-link" href="add-activity.php">
                    <i class="icofont icofont-file-fill"></i>
                    <p>Ajouter activite</p>
                </a>
            </li>
            <li class="nav-item <?= $page == "all-activity.php" ? "active":"";?>">
                <a class="nav-link" href="all-activity.php">
                    <i class="icofont icofont-files-stack"></i>
                    <p>Activites</p>
                </a>
            </li>
            
            <li class="nav-item <?= $page == "add-event.php" ? "active":"";?>">
                <a class="nav-link" href="add-event.php">
                    <i class="icofont icofont-ui-calendar"></i>
                    <p>Ajouter galerie</p>
                </a>
            </li>
            <li class="nav-item <?= $page == "all-events.php" ? "active":"";?>">
                <a class="nav-link" href="all-events.php">
                    <i class="icofont icofont-picture"></i>
                    <p>Galerie</p>
                </a>
            </li>
            <li class="nav-item <?= $page == "../index.php" ? "active":"";?>">
                <a class="nav-link" href="../index.php">
                    <i class="icofont icofont-globe"></i>
                    <p>Site web</p>
                </a>
            </li>
            <li class="nav-item active active-pro">
                <a class="nav-link active" href="../logout.php">
                    <i class="bi bi-box-arrow-right"></i>
                    <p>Se deconnecter</p>
                </a>
            </li>
        </ul>
    </div>
</div>