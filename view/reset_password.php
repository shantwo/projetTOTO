<form class="container" method="post" action="reset_password.php">
  <label>Password</label>
  <?php if (!empty($errorList['password'])) : ?>
  <div class="alert alert-danger">
    <?php foreach ($errorList['password'] as $currentError) : ?>
      <?= $currentError ?><br>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
  <input type="password" name="password" placeholder="ENTREZ VOTRE PASSWORD SVIP" value=''/>
  <label>Verifier le Password</label>
  <input type="password" name="verif_password" placeholder="VERIFIEZ VOTRE PASSWORD SVIP" value=''/>
  <input type="hidden" name="id" value="<?= $_GET['sig_id'] ?>">
    <input type="submit" />
</form>
