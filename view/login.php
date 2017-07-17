<form class="container" method="post" action="signup.php">

  <?php if (!empty($successTxt)) : ?>
  <div class="alert alert-success">
    <?= $successTxt ?>
  </div>
  <?php endif; ?>

  <label>E-Mail</label>
  <?php if (!empty($errorList['email'])) : ?>
  <div class="alert alert-danger">
    <?php foreach ($errorList['email'] as $currentError) : ?>
      <?= $currentError ?><br>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
  <input type="email" name="email" placeholder="ENTREZ L'EMAIL SVIP" value=''/>


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
    <input type="submit" />

    
</form>
