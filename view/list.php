<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<?php if (isset($_SESSION['user_role']) && authLevel($_SESSION['user_role']) !== "0") : ?>
  <h2>Liste des &Eacute;tudiant(e)s</h2>
  <h3><?= $compteurPage ?> Resultats</h3>
  <?php if (isset($studentListing) && sizeof($studentListing) > 0) : ?>
  <table class="striped">
    <thead>
      <tr>
        <td>Nom</td>
        <td>Prenom</td>
        <td>Date de naissance</td>
        <td>E-mail</td>
        <td>Ville</td>
        <td>Pays</td>
        <td>Session</td>
        <td>Indice de Sympathie</td>
        <td>Liens</td>
        <td>Gestion</td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($studentListing as $currentEtudiant) : ?>
      			<tr>
      				<td><?= $currentEtudiant['nom'] ?></td>
      				<td><?= $currentEtudiant['prenom'] ?></td>
      				<td><?= $currentEtudiant['dateDeNaissance'] ?></td>
      				<td><?= $currentEtudiant['email'] ?></td>
      				<td><?= $currentEtudiant['ville'] ?></td>
      				<td><?= $currentEtudiant['pays'] ?></td>
      				<td><?= $currentEtudiant['session'] ?></td>
      				<td><?= $currentEtudiant['sympathie'] ?></td>
      				<td><a href="" data="id<?= $currentEtudiant['id']?>">voir en detail</a></td>
              <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'):?>
              <td><a href=<?= "list.php?id=".$currentEtudiant['id']?>>Supprimer</a></td>
              <td><a href=<?= "add.php?id=".$currentEtudiant['id']?> data="id<?= $currentEtudiant['id']?>">Modifier</a></td>
              <?php endif; ?>
      			</tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <tfoot>
    <?php if($page>1): ?>
    <a href="list.php?page=<?= $page-1 ?>">Previous </a>
    <?php endif ?>
    <?php if($page < $maxpages): ?>
    <a href="list.php?page=<?= $page+1 ?>">Next </a>
    <?php endif ?>
  </tfoot>
  <?php else :?>
  	Aucun &Eacute;tudiant
  <?php endif ?>
<?php else: ?>
<?php  Header("Location:index.php") ?>
<?php endif ?>
<!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>ETUDIANT</h4>
      <ul>
        <li><strong>NOM : </strong><span id="nom"></span></li>
        <li><strong>PRENOM : </strong><span id="prenom"></span></li>
        <li><strong>DATE DE NAISSANCE : </strong><span id="naissance"></span></li>
        <li><strong>EMAIL : </strong><span id="email"></span></li>
        <li><strong>VILLE : </strong><span id="ville"></span></li>
        <li><strong>PAYS : </strong><span id="pays"></span></li>
        <li><strong>SESSION : </strong><span id="session"></span></li>
        <li><strong>SYMPATHIE : </strong><span id="sympa"></span></li>
      </ul>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>



<script>
$(function(){
  $('a[data^=id]').on('click',function(e){

    e.preventDefault();
    var idstudent = $(this).attr('data').substring(2);
    $.ajax({
      //vers ce fichier,
      method:'POST',
      url: "ajax/student_details.php",
      data: {'id':idstudent},
      dataType:'json'
    })
    //si la requete est lancee
    .always(function(){
    })
    //si la requete a reussi
    .done(function(data) {
      console.log(data);
      $('#modal1').modal('open');
      $('h4').html(data['stu_lastname']+" "+data['stu_firstname'])
      $('#nom').html(data['stu_lastname']);
      $('#prenom').html(data['stu_firstname']);
      $('#naissance').html(data['stu_birthdate']);
      $('#email').html(data['stu_email']);
      $('#ville').html(data['cit_name']);
      $('#pays').html(data['cou_name']);
      $('#session').html(data['ses_number']);
      $('#sympa').html(data['stu_friendliness']);
    })
    //si la requete a echoue
    .fail(function() {
      alert("Bad news BRO, some gremlins ate your code!!");
    });
  });
});



</script>
