<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<?php if (isset($_SESSION['user_role']) && authLevel($_SESSION['user_role']) == "1") : ?>
<form <?php if (isset($modifNom)
              || isset($modifPrenom)
              || isset($modifEmail)
              || isset($modifSympa)
              || isset($modifSession)
              || isset($modifVille)) :?> action="add.php?modif=o"
      <?php else: ?> action="add.php"
      <?php endif;?> enctype="multipart/form-data" class="container" method="post">
  <label>Nom</label>
  <input type="text" name="nom" placeholder="ENTREZ LE NOM SVIP" class="col s6" value='<?= isset($modifNom)?$modifNom:"" ?>'>
  <br />
  <label>Prenom</label>
  <input type="text" name="prenom" placeholder="ENTREZ LE PRENOM SVIP" value='<?= isset($modifPrenom)?$modifPrenom:"" ?>' />
  <br />
  <label>Date de Naissance</label>
  <input type="text" name="naissance" placeholder="ENTREZ LA DATE DE NAISSANCE mois/jour/annee SVIP" value='<?= isset($modifDate)?$modifDate:"" ?>'/>
  <label>E-Mail</label>
  <input type="email" name="email" placeholder="ENTREZ L'EMAIL SVIP" value='<?= isset($modifEmail)?$modifEmail:"" ?>'/>
  <label>Indice de sympathie</label>
  <select name="sympa">
    <option value = "1" <?php if (isset($modifSympa) && $modifSympa == 1): ?> selected <?php endif; ?>>Pas Cool</option>
    <option value = "2" <?php if (isset($modifSympa) && $modifSympa == 2): ?> selected <?php endif; ?>>Normal</option>
    <option value = "3" <?php if (isset($modifSympa) && $modifSympa == 3): ?> selected <?php endif; ?>>Sympa</option>
    <option value = "4" <?php if (isset($modifSympa) && $modifSympa == 4): ?> selected <?php endif; ?>>Marrant</option>
    <option value = "5" <?php if (isset($modifSympa) && $modifSympa == 5): ?> selected <?php endif; ?>>Genialissime</option>
  </select>
  <select name="session">
    <option value="">Numero de session</option>
    <?php foreach ($sessionArray as $key => $value): ?>
      <option value="<?= $value ?>" <?php if (isset($modifSession) && $modifSession == $value): ?> selected <?php endif; ?>><?= $value ?></option>
    <?php endforeach; ?>
  </select>
  <select name="ville">
    <option value="">Ville</option>
    <?php foreach ($villeArray as $key => $value): ?>
      <option value="<?= $key ?>" <?php if (isset($modifVille) && $modifVille == $value): ?> selected <?php endif; ?>><?= $value ?></option>
    <?php endforeach; ?>
  </select>
  <input type="hidden" name="id" value = "<?= isset($modifID)?$modifID:''?>" />
  <!-- Envoi d images ------------------------------------------------------------------------------------------------->
  <fieldset>
    <!-- POUR CONFIRMER L ENVOI DU FORM  -->
  <input type="hidden" name="submitFile" value="1" />
  <label for="fileForm">Fichier</label>
  <input type="file" name="fileForm" id="fileForm" />
  </fieldset>
  <!-- FIN Envoi d images ------------------------------------------------------------------------------------------------->
    <input type="submit" />
</form>
<?php elseif (isset($_SESSION['user_role']) && authLevel($_SESSION['user_role']) !== "1") : ?>
  <h1>ACCESS FORBIDDEN</h1>
  <a href="login.php">revenir a l index</a>
<?php else: ?>
  <?php  Header("Location:index.php") ?>
<?php endif; ?>
<script>
$('form').on('submit', function(e){
  // e.preventDefault();
  // var lname = $('#lname').val();
  // var fname = $('#fname').val();
  // var email = $('#email').val();
  // var password = $('#password').val();
  // var password2 = $('#password2').val();
  var formvalue = $('form').serialize();
  //lance une requete ajax
  $.ajax({
    //vers ce fichier,
    method:'POST',
    url: "ajax/add.php",
    data: formvalue
  })
  //si la requete est lancee
  .always(function(){
  })
  //si la requete a reussi
  .done(function(data) {
  })
  //si la requete a echoue
  .fail(function() {
    alert("Bad news BRO, some gremlins ate your code!!");
  });
})
</script>
