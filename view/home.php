<h3>Liste des sessions de formation</h3>
<table class="striped">
  <thead>
    <tr>
      <td>Nom de la formation</td>
      <td>Numero</td>
      <td>Date de debut</td>
      <td>Date de fin</td>
      <td>Lieu</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($sessionListing as $currentsession) : ?>
    			<tr>
    				<td><a href="list.php?ref=tra_name&valeur=<?= $currentsession['nom'] ?>"><?= $currentsession['nom'] ?></a></td>
    				<td><?= $currentsession['numero'] ?></td>
    				<td><a href="list.php?ref=ses_start_date&valeur=<?= $currentsession['debut'] ?>"><?= $currentsession['debut'] ?></a></td>
    				<td><a href="list.php?ref=ses_end_date&valeur=<?= $currentsession['fin'] ?>"><?= $currentsession['fin'] ?></a></td>
    				<td><a href="list.php?ref=loc_name&valeur=<?= $currentsession['lieu'] ?>"><?= $currentsession['lieu'] ?></a></td>
    			</tr>
    <?php endforeach; ?>
  </tbody>
</table>
<h3>Nombre d etudiants par ville</h3>
<table class="striped">
  <thead>
    <tr>
      <td>Ville</td>
      <td>Etudiants</td>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($studentbycity as $key => $value): ?>
      <tr>
        <td>
          <?= $value['cit_name'] ?>
        </td>
        <td>
          <?= $value['count'] ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
