<?php

// Config
require 'inc/config.php';

// Initialisations
$errorList = array();

// Si formulaire soumis
if (!empty($_POST)) {
	//print_r($_POST);exit;
	// Récupération & traitement des données
	$email = isset($_POST['emailToto']) ? strip_tags(trim($_POST['emailToto'])) : '';
	$password = isset($_POST['passwordToto1']) ? trim($_POST['passwordToto1']) : '';

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

	if (empty($password)) {
		$formValid = false;
		$errorList['passwordToto'][] = 'Le password est vide';
	}
	if (strlen($password) < 6) {
		$formValid = false;
		$errorList['passwordToto'][] = 'Le password doit faire au moins 6 caractères';
	}

	// Si tout est ok
	if ($formValid) {
		/*$sql = '
			SELECT *
			FROM user
			WHERE usr_email = :email
			AND usr_password = :password
		';
		$pdoStatement = $pdo->prepare($sql);
		// bindValues
		$pdoStatement->bindValue(':email', $email);
		// Clear password
		//$pdoStatement->bindValue(':password', $password);
		// md5
		//$pdoStatement->bindValue(':password', md5($password));
		// md5 + salt
		$pdoStatement->bindValue(':password', md5('salt à_moi:)'.$password));
		// execution
		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		else {
			if ($pdoStatement->rowCount() > 0) {
				echo 'Utilisateur connecté<br>';
				// TODO connect the user
				$userData = $pdoStatement->fetch(PDO::FETCH_ASSOC);
			}
			else {
				echo 'Email/Password non reconnus<br>';
			}
		}*/
		$sql = '
			SELECT *
			FROM user
			WHERE usr_email = :email
		';
		$pdoStatement = $pdo->prepare($sql);
		// bindValues
		$pdoStatement->bindValue(':email', $email);

		// execution
		if ($pdoStatement->execute() === false) {
			print_r($pdoStatement->errorInfo());
		}
		else {
			if ($pdoStatement->rowCount() > 0) {
				$userData = $pdoStatement->fetch(PDO::FETCH_ASSOC);

				// Vérification du mot de passe
				if (password_verify($password, $userData['usr_password'])) {
					echo 'Utilisateur connecté<br>';
					// TODO connect the user
					$_SESSION['userId'] = $userData['usr_id'];
					$_SESSION['userRole'] = $userData['usr_role'];
				}
				else {
					echo 'Mot de passe incorrect<br>';
				}
			}
			else {
				echo 'Email non reconnu<br>';
			}
		}
	}
}

?>
<html>
<head>
	<title>User sign in</title>
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
		  			<h1>Sign in</h1>
				</div>

				<form action="" method="post">
					<fieldset>
						<?php if (!empty($errorList['emailToto'])) : ?>
						<div class="alert alert-danger">
							<?php foreach ($errorList['emailToto'] as $currentError) : ?>
								<?= $currentError ?><br>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
						<input type="email" class="form-control" name="emailToto" value="" placeholder="Email address" /><br />
						<?php if (!empty($errorList['passwordToto'])) : ?>
						<div class="alert alert-danger">
							<?php foreach ($errorList['passwordToto'] as $currentError) : ?>
								<?= $currentError ?><br>
							<?php endforeach; ?>
						</div>
						<?php endif; ?>
						<input type="password" class="form-control" name="passwordToto1" value="" placeholder="Your password" /><br />
						<input type="submit" class="btn btn-success btn-block" value="Sign in" />
					</fieldset>
				</form>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-0"></div>
		</div>

	</div>

</body>
</html>
