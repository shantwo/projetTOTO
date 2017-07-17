<?php
if (!empty($_GET)){
  if (isset($_GET['act'])){
    $_SESSION=[];
    setcookie('projet_toto',"", 0, null, null, false, true);
  }
}
if (isset($_SESSION['duree_de_vie'])){
  if (time() > $_SESSION['duree_de_vie']){
    session_destroy();
  }
}

if (isset($_COOKIE['projet_toto']) && !isset($_SESSION['duree_de_vie'])){
  $utilisateur = getExpDate($_COOKIE['projet_toto'],$pdo);
  $_SESSION['duree_de_vie'] = $utilisateur['expiration'];
  $mail = $_COOKIE['projet_toto'];
  $_SESSION['id_user'] = $mail;
}

if(isset($_SESSION) && !empty($_SESSION)){
  $email = $_SESSION['id_user'];
  $default = "";
  $size = 40;
  $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
}
// print_r($_COOKIE['projet_toto']);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.99.0/css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css" />
    <title></title>
  </head>
  <body>
    <?php if(isset($_SESSION['ip_user'])):?>
    <?php checkIP($_SESSION,$_SERVER['REMOTE_ADDR']); ?>
  <?php endif; ?>
    <nav class="light-blue darken-4" style="margin-bottom:4%">
      <div class="nav-wrapper light-blue darken-4">
        <span class="brand-logo" style="margin-left:1%">WEBFORCE</span>
        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <?php if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])):?>
            <li>
              <form action="" method="get">
                <input type="submit" value="DECONNEXION" style="background-color:transparent;border:none;">
                <input type="hidden" name="act" value="run">
              </form>
            </li>
          <?php endif; ?>
          <li>
            <form method="GET" action="list.php">
              <input type="text" name="recherche" PLACEHOLDER="SEARCH"/>
            </form>
          </li>
        </ul>
        <ul class="side-nav" id="mobile-demo">
          <li>
            <div class="input-field">
              <form method="GET" action="list.php">
                <input type="text" name="recherche" PLACEHOLDER="SEARCH"/>
              </form>
            </div>
          </li>
        </ul>
      </div>
      <div class="nav-content light-blue darken-4">
        <ul class="tabs tabs-transparent">
          <li class="tab" id="5"><a href="index.php">ALL SESSIONS</a></li>
          <?php if (isset($_SESSION['user_role']) && authLevel($_SESSION['user_role']) !== "0") : ?>
          <li class="tab" id="1"><a href="list.php">ALL STUDENTS</a></li>
          <li class="tab" id="2"><a href="add.php">ADD STUDENT</a></li>
        <?php endif; ?>
          <?php if (!isset($_SESSION['id_user']) || empty($_SESSION['id_user'])): ?>
          <li class="tab" id="3"><a href="signup.php">CREATE USER</a></li>
          <li class="tab" id="4"><a href="signin.php">CONNECT USER</a></li>
          <?php endif; ?>
          <?php if(isset($_SESSION) && !empty($_SESSION)):?>
            <li class="tab"><?= $_SESSION['id_user']?></li>
          <?php endif;?>
        </ul>
      </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>
    $(function(){
      $('#1').on('click',function(){
        window.open('list.php','_self');
      });
      $('#2').on('click',function(){
        window.open('add.php','_self');
      });
      $('#3').on('click',function(){
        window.open('signup.php','_self');
      });
      $('#4').on('click',function(){
        window.open('signin.php','_self');
      });
      $('#5').on('click',function(){
        window.open('index.php','_self');
      });
    });
    </script>
