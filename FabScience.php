<?php

///LOCALHOST///
//identifier votre BDD
$database = "la_courtille";
//identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

///SERVEUR WEB///
//identifier votre BDD
/*$database = "dbs5254611";
//identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
$db_handle = mysqli_connect('db5006292334.hosting-data.io', 'dbu1630546', 'zegregh56ozfl');
$db_found = mysqli_select_db($db_handle, $database);*/

session_start();

if ($db_found) {

  $sql = "SELECT * FROM activites";
  $result = mysqli_query($db_handle, $sql);
  while ($activite = mysqli_fetch_assoc($result)) { 
       $activites[] = $activite; 
     }

  if (isset($_POST["savemodif"])){

      for($i=9; $i<10; $i++)//jusqu'au nombre de modification
      {
        $modi = "modif".$i;
        $textmodif1 = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST[$modi])); 

        $y=$i+1;
        $req = "UPDATE modification SET textModif = '$textmodif1' WHERE idModif = '$y'";
        $update = mysqli_query($db_handle, $req);

      }
        
        echo " <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
        Page modifiée avec succès !
       <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
       </div>";

      }

    $sql = "SELECT * FROM modification";
    $result = mysqli_query($db_handle, $sql);
    while ($modif = mysqli_fetch_assoc($result)) { 
        $modifs[] = $modif; 
      }
      
  }//end if
  

  error_reporting(0);
  $id_session = $_SESSION['id'];
  $edit=$_GET['edit'];
  
  

  $req = "SELECT * FROM users WHERE idUser = '$id_session'";
  $res = mysqli_query($db_handle, $req);
  $user = mysqli_fetch_assoc($res);

    $type = $user['type'];
    error_reporting(E_ALL);
    foreach ($modifs as $key => $modif) {
      # code...
      if ($modif['idModif'] == $key+1)
      {
        
        $tid=$modif['idModif'];
        $ttext=$modif['textModif'];
        $idm[$key] = $tid;
        $m[$key] = $ttext;
      }
    }
    /*foreach ($idm as $idms) {
    echo $idms.' '; // Avec insertion d'un espace entre 2 valeurs
}*/

    /*foreach ($modifs as $modif) {
      if ($modif['idModif'] == "1")
      {
        $idm1 = $modif['idModif'];
        $m1 = $modif['textModif'];
      }
    }*/
    //echo "$m1";

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Site Tittle -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CDI - La Courtille</title>

  <!-- Plugins css Style -->
  <link href='assets/css/all.min.css' rel='stylesheet'>
  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css' rel='stylesheet'>
  <link href='assets/css/animate.css' rel='stylesheet'>

  <link href='assets/css/jquery.fancybox.min.css' rel='stylesheet'>
  <link href='assets/css/isotope.min.css' rel='stylesheet'>
  <link href="assets/css/nivo-slider.css" rel="stylesheet">
  
  <link href='assets/css/owl.carousel.min.css' rel='stylesheet' media='screen'>
  <link href='assets/css/owl.theme.default.min.css' rel='stylesheet' media='screen'>
  <link href='assets/css/settings.css' rel='stylesheet'>
  <link href='assets/css/layers.css' rel='stylesheet'>
  <link href='assets/css/navigation.css' rel='stylesheet'>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Dosis:300,400,600,700|Open+Sans:300,400,600,700" rel="stylesheet">

  <!-- Custom css -->
  <link href="assets/css/style.css" id="option_style" rel="stylesheet">

  <!-- Favicon -->
  <link href="assets/img/favicon.png" rel="shortcut icon">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body id="body" class="up-scroll">
  <!-- ====================================
  ——— PRELOADER
  ===================================== -->
  <div id="preloader" class="smooth-loader-wrapper">
    <div class="smooth-loader">
      <div class="loader">
        <span class="dot dot-1"></span>
        <span class="dot dot-2"></span>
        <span class="dot dot-3"></span>
        <span class="dot dot-4"></span>
      </div>
    </div>
  </div>

  <!-- ====================================
  ——— HEADER
  ===================================== -->

  <?php if($type == "admin" && $edit != "1") : ?>
    <div class="boutonModifier">
      <a href="cdi.php?edit=1">
      <button class="btn mt-6 btn-primary" >Modifier</button>
    </a>
  </div>
<?php endif ?>
<?php if($edit == "1") : ?>
    <div class="boutonTerminer">
      <a href="cdi.php">
      <button class="btn mt-6 btn-danger" >Terminer</button>
    </a>
  </div>
<?php endif ?>

  <header class="header" id="pageTop">
    <!-- Top Color Bar -->
    <div class="color-bars">
      <div class="container-fluid">
        <div class="row">
          <div class="col color-bar bg-warning d-none d-md-block"></div>
          <div class="col color-bar bg-success d-none d-md-block"></div>
          <div class="col color-bar bg-danger d-none d-md-block"></div>
          <div class="col color-bar bg-info d-none d-md-block"></div>
          <div class="col color-bar bg-purple d-none d-md-block"></div>
          <div class="col color-bar bg-pink d-none d-md-block"></div>
          <div class="col color-bar bg-warning"></div>
          <div class="col color-bar bg-success"></div>
          <div class="col color-bar bg-danger"></div>
          <div class="col color-bar bg-info"></div>
          <div class="col color-bar bg-purple"></div>
          <div class="col color-bar bg-pink"></div>
        </div>
      </div>
    </div>



        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-scrollUp navbar-sticky navbar-white">
      <div class="container p-0">
        <a class="navbar-brand" href="index.php">
          <img class="d-inline-block" src="assets/img/logo-la-courtille.jpg" alt="La Courtille" height="80">
        </a>

        

        <button class="navbar-toggler py-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
          aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav ms-lg-auto">
              <li class="nav-item dropdown bg-primary">
              <a class="nav-link " href="index.php">
                <i class="fas fa-laptop-house nav-icon" aria-hidden="true"></i>
                <span>Accueil</span>
              </a>
            </li>

            <li class="nav-item dropdown bg-purple">
              <a class="nav-link active text-blue" href="javascript:void(0)"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                <i class="fas fa-school nav-icon" aria-hidden="true"></i>
                <span>Présentation</span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                <li>
                  <a class="dropdown-item " href="presentation.html">L'établissement</a>
                </li>

                <li>
                  <a class="dropdown-item " href="association-sportive.php">Association sportive</a>
                </li>

                <li>
                  <a class="dropdown-item " href="projets-ateliers.php">Projets et ateliers</a>
                </li>

                <li>
                  <a class="dropdown-item " href="FabScience.php">FabScience</a>
                </li>

                <li>
                  <a class="dropdown-item " href="reglement.html">Règlement</a>
                </li>

                <li>
                  <a class="dropdown-item " href="organigramme.html">Organigramme</a>
                </li>

                <li>
                  <a class="dropdown-item " href="role-du-mediateur.php">Rôle du médiateur</a>
                </li>

                <li>
                  <a class="dropdown-item " href="cafe-des-parents.php">Café des parents</a>
                </li>

                <li>
                  <a class="dropdown-item " href="faq.html">F.A.Q.</a>
                </li>
                

              </ul>
            </li>

            <li class="nav-item dropdown bg-danger">
              <a class="nav-link " href="actualites.php">
                <i class="far fa-newspaper nav-icon" aria-hidden="true"></i>
                <span>Actualités</span>
              </a>
            </li>

            <li class="nav-item dropdown bg-info">
              <a class="nav-link" href="javascript:void(0)"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-scroll nav-icon" aria-hidden="true"></i>
                <span>Intendance</span>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                <li>
                  <a class="dropdown-item " href="javascript:void(0)">
                    Bourse <i class="fa fa-chevron-right" aria-hidden="true"></i>
                  </a>
                  <ul class="sub-menu">
                    <li><a class="" href="bourse-college.php">Collège</a></li>
                    <li><a class="" href="bourse-lycee.html">Lycée</a></li>
                  </ul>
                </li>
                <li>
                  <a class="dropdown-item " href="javascript:void(0)">
                    Demi-pension<i class="fa fa-chevron-right" aria-hidden="true"></i>
                  </a>
                  <ul class="sub-menu">
                    <li><a class="" href="inscription_cantine.php">Inscription</a></li>
                    <li><a class="" href="paiement_cantine.html">Paiement</a></li>
                    <li><a class="" href="reglement_cantine.html">Règlement</a></li>
                  </ul>
                </li>
                <li>
                  <a class="dropdown-item " href="noel.html">Inscription Noël</a>
                </li>
                <li>
                  <a class="dropdown-item " href="ramadan.html">Inscription Ramadan</a>
                </li>
                <li>
                  <a class="dropdown-item " href="tarification-particuliere.php">Tarification particulière</a>
                </li>
              </ul>
            </li>

            <li class="nav-item dropdown bg-success">
              <a class="nav-link " href="javascript:void(0)">
                <i class="fas fa-user-edit nav-icon" aria-hidden="true"></i>
                <span>Secrétariat</span>
              </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                <li>
                    <a class="dropdown-item " href="https://connexion.enthdf.fr/">Accès ENT</a>
                  </li>
                <li>
                    <a class="dropdown-item " href="modification_mdp_ent.php">Modification mot de passe ENT</a>
                  </li>
                  
                  <li>
                    <a class="dropdown-item " href="inscription-administrative.html">Inscription administrative</a>
                  </li>
                  <li>
                    <a class="dropdown-item " href="convention-de-stage.php">Convention de stage</a>
                  </li>
                  <li>
                  <a class="dropdown-item " href="les-dates-importantes.php">
                    Les dates importantes <i class="fa fa-chevron-right" aria-hidden="true"></i>
                  </a>
                  <ul class="sub-menu">
                    <li><a class="" href="les-dates-importantes.php#conseils-de-classe">Conseils de classe</a></li>
                    <li><a class="" href="les-dates-importantes.php#brevets-blanc">Brevets blancs</a></li>
                    <li><a class="" href="les-dates-importantes.php#DNB">DNB</a></li>
                    <li><a class="" href="les-dates-importantes.php#rentree-scolaire">Rentrée scolaire</a></li>
                  
                  </ul>
                </li>
                </ul>
            </li>

            <li class="nav-item dropdown bg-pink">
              <a class="nav-link " href="javascript:void(0)">
                <i class="fas fa-book nav-icon" aria-hidden="true"></i>
                <span>CDI</span>
              </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                  <li>
                    <a class="dropdown-item " href="cdi.php">Le C.D.I.</a>
                  </li>
                  <li>
                    <a class="dropdown-item " href="https://0931490p.esidoc.fr/">Site externe</a>
                  </li>
                </ul>
            </li>
            <li class="nav-item dropdown bg-blue">
              <a class="nav-link" href="contact.html">
                <i class="fas fa-phone nav-icon" aria-hidden="true"></i>
                <span>Contact</span>
              </a>
            </li>
            <?php if($_SESSION['email']): ?>
              <li class="nav-item dropdown bg-secondary">
              <a class="nav-link" href="admin.php">
                <i class="fas fa-user-circle nav-icon" style="color:#6c757d;font-size:2.4em;" aria-hidden="true"></i>
                <span>Admin</span>
              </a>
            </li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <div class="main-wrapper faq"> 
    
    <!-- ====================================
    ———	BREADCRUMB
    ===================================== -->
    <section class="breadcrumb-bg" style="background-image: url(assets/img/tableau.jpg); ">
      <div class="container">
        <div class="breadcrumb-holder">
          <div>
            <h1 class="breadcrumb-title">FabScience</h1>
            <ul class="breadcrumb breadcrumb-transparent">
              <li class="breadcrumb-item">
                <a class="text-white" href="index.php">Accueil</a>
              </li>
              <li class="breadcrumb-item text-white active" aria-current="page">
              Présentation
              </li>
              <li class="breadcrumb-item text-white active" aria-current="page">
              FabScience
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- ====================================
——— ABOUT MEDIA
===================================== -->

<?php if($edit == "1") : ?>
<form action="FabScience.php?edit=1" method="post">
<?php endif ?>

<section class="py-7 py-md-10"">
  <div class="container">
    <div class="row wow fadeInUp">
      <div class="col-sm-6 col-xs-12 pe-5">
          <div class="section-title mb-4 wow fadeInUp">
            <h2 class="text-danger">L'atelier FabScience : </h2>
          </div>
          <div class="align-items-baseline mb-4 px-5">
          <p class="text-dark font-size-15 mb-4">Nous sommes 2 enseignantes, <strong class="text-danger">Technologie et Sciences physique</strong> en co-animation et nous avons 3 groupes de 15 élèves par semaine durant 1h chacun sur la pause méridienne. </p>
          <p class="text-dark font-size-15">
          Nous organisons nos séances en veillant à ce qu'<strong class="text-danger">un principe technique ou un principe physique ou les 2 soient mis en avant.</strong>
          Nous proposons à nos élèves des expérimentations ou des démarches d'investigation durant lesquelles ils réinvestissent les compétences acquises durant les enseignements. </p>
          <p class="text-dark font-size-15">
          Nous permettons également à nos élèves de <strong class="text-danger">proposer des expériences ou fabrications qu'ils souhaiteraient réaliser</strong> dans le but de développer une appétence pour les sciences et technologies et conserver un aspect ludique de l'atelier.
          </p>

          </div>
        
    </div>
    <div class="col-sm-6 col-xs-12">
        <div>
          <img class="img-fluid rounded" src="assets/img/collegeLaCourtille.jpg" width="100%" allowfullscreen="" loading="lazy">
        </div>
        
    </div>
  </div>
</div>
</section>

<section class="bg-light py-7 py-md-10"">
  <div class="container">
    <div class="row wow fadeInUp">

      <div class="col-sm-5 col-xs-12">
        <div>
          <img class="img-fluid rounded" src="assets/img/collegeLaCourtille.jpg" width="100%" allowfullscreen="" loading="lazy">
        </div>
        
    </div>

      <div class="col-sm-7 col-xs-12 pe-5">
          <div class="section-title mb-4 wow fadeInUp">
            <h2 class="text-danger">Exemples de séances proposés <i>pour</i> ou <i>par </i> les élèves</h2>
          </div>
          <ul class="list-unstyled mb-5">
            <li class="d-flex align-items-baseline text-muted">
              <i class="fas fa-arrow-right me-2" aria-hidden="true"></i>
              <p>Eruption volcanique , avec fabrication d'un volcan et réaction chimique pour provoquer l'éruption</p>
            </li>
            <li class="d-flex align-items-baseline text-muted">
              <i class="fas fa-arrow-right me-2" aria-hidden="true"></i>
              <p>Fabrication assisté par ordinateur  de porte clefs/ pancarte/ déco de noël avec  usinage à la machine outil à commande numérique</p>
            </li>
            <li class="d-flex align-items-baseline text-muted">
              <i class="fas fa-arrow-right me-2" aria-hidden="true"></i>
              <p>Conception assistée par ordinateur et impression 3D</p>
            </li>
            <li class="d-flex align-items-baseline text-muted">
              <i class="fas fa-arrow-right me-2" aria-hidden="true"></i>
              <p>Fabrication de slim</p>
            </li>
            <li class="d-flex align-items-baseline text-muted">
              <i class="fas fa-arrow-right me-2" aria-hidden="true"></i>
              <p>Fabrication de balles anti stress</p>
            </li>
            <li class="d-flex align-items-baseline text-muted">
              <i class="fas fa-arrow-right me-2" aria-hidden="true"></i>
              <p>Réalisation d'un arc en ciel sur le principe de la densité</p>
            </li>
            <li class="d-flex align-items-baseline text-muted">
              <i class="fas fa-arrow-right me-2" aria-hidden="true"></i>
              <p>Réalisation de lampe à lave</p>
            </li>
            <li class="d-flex align-items-baseline text-muted">
              <i class="fas fa-arrow-right me-2" aria-hidden="true"></i>
              <p>Fabrication de différents véhicules (voitures, fusée...) avec différents moyens de propulsions ( réactions chimiques, pression...)</p>
            </li>
            <li class="d-flex align-items-baseline text-muted">
              <i class="fas fa-arrow-right me-2" aria-hidden="true"></i>
              <p>Et bien d'autres !</p>
            </li>
          </ul>
    </div>

          <p class="text-dark font-size-15 mb-4">
          Nous réalisons également en fin d'année <strong class="text-danger"> une exposition afin de présenter l'atelier</strong> ce qui nécessite également du matériel et des consommables ( feuilles, carton plume, feutres, cartouches d'imprimantes....).
          </p> 
    
  </div>
</div>
</section>

<section class="pt-4 pt-md-6 pb-10">
  <div class="container">
     <div class="section-title mb-4 wow fadeInUp">
        <h2 class="text-danger">Le matériel :</h2>
    </div>
    <div class="align-items-baseline mb-4 px-5">
          <p class="text-dark font-size-15 mb-4">Nous utilisons différents produits pour les différentes <strong class="text-danger">réactions chimiques</strong> (bicarbonate, colorant, sel, vinaigre, lessive, ....) et différents matériaux pour les fabrications des <strong class="text-danger"> objets techniques</strong> ( plaque de pvc , plaque de Pmma, bobine pour impression 3D, crochets, peinture, ficelle, colle, ruban adhésifs, pailles, bois, carton plume.....). </p>
          <p class="text-dark font-size-15 mb-4">
          Nous avons également besoin de matériel pour la réalisation des <strong class="text-danger"> expériences </strong>(  bécher, petit pot, balance, pipette, agitateur.....) et d'outils pour les fabrications ( tourne vis, multimètre, mocn, imprimante 3D, fer à souder, étain, marteau, perceuse, forets....).</p>

          
  </div>
    
  </div>
</section>


  
      <?php if($edit == "1") : ?>
        <div class="boutonModifier">
           <button class="btn mt-6 btn-primary" name="savemodif" type="submit">Enregistrer</button>
        </div>
        </form>
    <?php endif?>


    </div> <!-- element wrapper ends -->

<!-- ====================================
———	FOOTER
===================================== -->
<footer class="footer-bg-img">
<!-- Footer Color Bar -->
<div class="color-bar">
  <div class="container-fluid">
    <div class="row">
      <div class="col color-bar bg-warning"></div>
      <div class="col color-bar bg-danger"></div>
      <div class="col color-bar bg-success"></div>
      <div class="col color-bar bg-info"></div>
      <div class="col color-bar bg-purple"></div>
      <div class="col color-bar bg-pink"></div>
      <div class="col color-bar bg-warning d-none d-md-block"></div>
      <div class="col color-bar bg-danger d-none d-md-block"></div>
      <div class="col color-bar bg-success d-none d-md-block"></div>
      <div class="col color-bar bg-info d-none d-md-block"></div>
      <div class="col color-bar bg-purple d-none d-md-block"></div>
      <div class="col color-bar bg-pink d-none d-md-block"></div>
    </div>
  </div>
</div>

<!-- Copy Right -->

<div class="copyright">
  <div class="container">
    <div class="row py-4 align-items-center">
      <div class="col-sm-7 col-xs-12 order-1 order-md-0">
        <p class="copyright-text"><span id="copy-year"></span> © Copyright Collège La Courtille. Tous droits réservés.</a></p>
      </div>

    </div>
  </div>
</div>

</footer>




<!-- Javascript -->
<script src='assets/js/jquery.min.js'></script>
<script src='assets/js/bootstrap.bundle.min.js'></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src='assets/js/jquery.fancybox.min.js'></script>
<script src='assets/js/isotope.min.js'></script>
<script src='assets/js/imagesloaded.pkgd.min.js'></script>

<script src='assets/js/lazyestload.js'></script>
<script src='assets/js/velocity.min.js'></script>
<script src='assets/js/SmoothScroll.js'></script>

<script src="assets/js/jquery.nivo.slider.js"></script>

<script src='assets/js/owl.carousel.min.js'></script>
<script src='assets/js/jquery.themepunch.tools.min.js'></script>
<script src='assets/js/jquery.themepunch.revolution.min.js'></script>

<!-- Load revolution slider only on Local File Systems. The following part can be removed on Server -->
<!--
<script src='assets/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js'></script>
<script src='assets/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js'></script>
<script src='assets/plugins/revolution/js/extensions/revolution.extension.navigation.min.js'></script> 
-->

<script src='assets/js/wow.min.js'></script>

<script>
var d = new Date();
var year = d.getFullYear();
document.getElementById("copy-year").innerHTML = year;
</script>
<script src='assets/js/main.js'></script>

</body>

</html>
