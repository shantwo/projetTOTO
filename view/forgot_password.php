<form class="container" method="post" action="forgot_password.php">

  <label>E-Mail</label>
  <?php if (!empty($errorList['email'])) : ?>
  <div class="alert alert-danger">
    <?php foreach ($errorList['email'] as $currentError) : ?>
      <?= $currentError ?><br>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
  <input type="email" name="email" placeholder="ENTREZ L'EMAIL SVIP" value=''/>
  <input type="submit" />
</form>
