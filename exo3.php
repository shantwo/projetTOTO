<?php

/*
EXERCICE 3 - projet TOTO
-------------------------
- passer l'utilisation de PHPMailer dans une fonction d'envoi d'email --------------/
- Forgot password :
	* créer page "public/forgot_password.php", demandant l'email
	* récupérer en post
	* requete SQL pour connaitre ID
	* générer un token à partir de l'ID (md5($id.$salt))
	* stocker le token en DB
	* envoyer lien par email vers la page "Reset password"
- Reset password :
	* créer page "public/reset_password.php"
	* récupérer le token dans l'URL
	* faire une requete sur l'email et vérifier le token si valide
	* si oui, afficher le formulaire de changement de mot de passe
		** récupérer en post
		** modifier le password
		** supprimer le token
		** rediriger sur la page "Sign in"
	* si non, dire que le token est invalide

EXERCICE 3-extra
----------------------
- donner un lifetime du token (stocker en DB, dans champ supplémentaire)
*/
