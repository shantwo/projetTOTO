<h2>Liste des &Eacute;tudiant(e)s</h2>
<h3><?= $compteurPage ?> Resultats</h3>
<?php if (isset($studentListing) && sizeof($studentListing) > 0) : ?>
<table class="striped">
  <thead>
    <tr>
      <td>Identifiants</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($studentListing as $currentEtudiant) : ?>
    			<tr>
    				<td><?= $currentUser['email'] ?></td>
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
