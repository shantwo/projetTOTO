<?php

// Config
require 'inc/config.php';

// Initialisations
$successTxt = '';
$errorList = array();
$email = '';

if (!empty($_POST)) {
	// Récupération & Traitement des données
	$email = isset($_POST['emailToto']) ? strip_tags(trim($_POST['emailToto'])) : '';
	$password1 = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) : '';
	$password2 = isset($_POST['passwordToto2']) ? trim($_POST['passwordToto2']) : '';

	// Validation des données
	$formValid = true;

	if (empty($email)) {
		$formValid = false;
		$errorList['emailToto'][] = 'L\'email est vide';
	}
	else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$formValid = false;
		$errorList['emailToto'][] = 'L\'email est invalide';
	}

	if (empty($password1) || empty($password2)) {
		$formValid = false;
		$errorList['passwordToto'][] = 'Le password est vide';
	}
	if ($password1 !== $password2) {
		$formValid = false;
		$errorList['passwordToto'][] = 'Les password sont différents';
	}
	if (strlen($password1) < 6 || strlen($password2) < 6) {
		$formValid = false;
		$errorList['passwordToto'][] = 'Le password doit faire au moins 6 caractères';
	}
	// TODO, vérifier que l'email n'est pas déjà dans la DB

	// Si tout est ok => on ajoute en DB
	if ($formValid) {
		$sql = "
			INSERT INTO user (usr_email, usr_password, usr_date_creation)
			VALUES (:email, :password, NOW())
		";
		// Prepare la requete
		$pdoStatement = $pdo->prepare($sql);
		// bindValues
		$pdoStatement->bindValue(':email', $email);
		// Clear password
		//$hashedPassword = $password1;
		// md5
		//$hashedPassword = md5($password1);
		// md5 + salt
		//$hashedPassword = md5('salt à_moi:)'.$password1);
		// password_hash
		$hashedPassword = password_hash($password1, PASSWORD_BCRYPT);

		$pdoStatement->bindValue(':password', $hashedPassword);

		// Execution
		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		// Si aucun erreur SQL
		else {
			$successTxt = 'Votre inscription a bien été prise en compte';
		}
	}
}

?>
<html>
<head>
	<title>User sign up</title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
			<div class="col-md-8 col-sm-8 col-xs-12">
				<div class="page-header">
		  			<h1>Sign up</h1>
				</div>

				<?php if (!empty($successTxt)) : ?>
				<div class="alert alert-success">
					<?= $successTxt ?>
				</div>
				<?php endif; ?>
	
				<form method="post" action="">
					<fieldset>
						<?php if (!empty($errorList['emailToto'])) : ?>
						<div class="alert alert-danger">
							<?php foreach ($errorList['emailToto'] as $currentError) : ?>
								<?= $currentError ?><br>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
						<input type="email" class="form-control" name="emailToto" value="<?= $email ?>" placeholder="Email address" /><br />
						<?php if (!empty($errorList['passwordToto'])) : ?>
						<div class="alert alert-danger">
							<?php foreach ($errorList['passwordToto'] as $currentError) : ?>
								<?= $currentError ?><br>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
						<input type="password" class="form-control" name="passwordToto1" value="" placeholder="Your password" /><br />
						<input type="password" class="form-control" name="passwordToto2" value="" placeholder="Confirm your password" /><br />
						<input type="submit" class="btn btn-success btn-block" value="Sign up" />
					</fieldset>
				</form>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
		</div>

	</div>

</body>
</html>