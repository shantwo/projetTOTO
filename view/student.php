
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- VERIFICATION DU ROLE DU USER -->
<?php if (isset($_SESSION['user_role']) && authLevel($_SESSION['user_role']) !== "0") : ?>
  <!-- <ul> -->
    <!-- si le user a choisi une image -->
    <?php /*if(isset($image)): ?>
      <li><img src=<?= "/files/".$image ?>></li>
    <?php else: ?>
        <li><img src="/files/default.jpg" width="100"></li>
    <?php endif; ?>
    <!-- **************************** -->
    <li><strong>NOM :</strong><?= $nom ?></li>
    <li><strong>PRENOM :</strong><?= $prenom ?></li>
    <li><strong>DATE DE NAISSANCE :</strong><?= $dateDeNaissance ?></li>
    <li><strong>E-MAIL :</strong><?= $email ?></li>
    <li><strong>VILLE :</strong><?= $ville ?></li>
    <li><strong>PAYS :</strong><?= $pays ?></li>
    <li><strong>SESSION :</strong><?= $session ?></li>
    <li><strong>INDICE DE SYMPATHIE :</strong><?= $sympathie ?></li>
  </ul>
<?php else : ?>
<!-- REDIRECTION -->
<?php  Header("Location:index.php") ?>
*/?>
<div id="studentContent">

</div>
  <script>
		//lance une requete ajax
		$.ajax({
			//vers ce fichier,
			type:'POST',
			url: "ajax/student.php",
                        dataType:"json",
			data: {'id':<?= $_GET['id'] ?>}
		})
		//si la requete est lancee
		.always(function(){
		})
		//si la requete a reussi
		.done(function(data) {
                        $('#studentContent').html(data);
		})
		//si la requete a echoue
		.fail(function() {
			alert("Bad news BRO, some gremlins ate your code!!");
		});

	</script>
<?php endif ?>
