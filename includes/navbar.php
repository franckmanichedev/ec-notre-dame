<?php
  $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1);
?>
<!-- Header Inner -->
<div class="header-inner">
  <div class="container">
    <div class="inner">
      <div class="row d-flex justify-content-between">
        <div class="col-lg-2 col-md-3 col-12">
          <!-- Start Logo -->
          <div class="logo">
            <a href="index.php">
              <img src="assets/img/logo-ec.png" height="75px" width="75px" alt="#">
            </a>
          </div>
          <!-- End Logo -->
          <!-- Mobile Nav -->
          <div class="mobile-nav"></div>
          <!-- End Mobile Nav -->
        </div>
        <div class="col-lg-7 col-md-9 col-12">
          <!-- Main Menu -->
          <div class="main-menu">
            <nav class="navigation float-end">
              <ul class="nav menu">
                <li class="<?= $page == "index.php" ? "active":"";?>">
                  <a href="index.php">
                    Accueil
                  </a>
                </li>
                <li class="<?= $page == "all-themes.php" ? "active":"";?>">
                  <a href="all-themes.php">Spiritualité</a>
                </li>
                <li class="<?= $page == "all-activity.php" ? "active":"";?>">
                  <a href="all-activity.php">Activites</a>
                </li>
                <li class="<?= $page == "contact.php" ? "active":"";?>">
                  <a href="contact.php">Contacter</a>
                </li>
                <?php
                  if(isset($_SESSION['auth'])){
                      if(($_SESSION['role'] == 1)){
                          ?>
                              <li class="nav-item">
                                  <a class="nav-link" href="admin/index.php">Dashboard</a>
                              </li>
                          <?php
                      }
                      ?>
                      <li class="nav-item dropdown">
                          <li><a href="#"><?= $_SESSION['auth_user']['nom']; ?> <i class="icofont-rounded-down"></i></a>
                            <ul class="dropdown">
                              <li><a href="#">Action</a></li>
                              <li><a href="#">Another action</a></li>
                              <li><a href="../logout.php">Se deconnecter</a></li>
                            </ul>
                          </li>
                      </li>
                  <?php 
                  } else {
                    ?>
                      <li class="nav-item <?= $page == "register.php" ? "active":"";?>">
                        <a class="nav-link" href="register.php">S'incrire</a>
                      </li>
                      <li class="nav-item <?= $page == "login.php" ? "active":"";?>">
                        <a class="nav-link" href="login.php">Se connecter</a>
                      </li>
                    <?php
                  }
                ?>
              </ul>
            </nav>
          </div>
          <!--/ End Main Menu -->
        </div>
      </div>
    </div>
  </div>
</div>
<!--/ End Header Inner -->