<?php

/*
EXERCICE 2 - projet TOTO
-------------------------
- compléter le système d'authentification du projet TOTO :
	* la page d'accueil ne nécessite aucune authentification
	* les modifications/ajouts/suppression nécessitent le role "admin"
	* les autres pages nécessitent un utilisateur connecté, avec au moins, le role "user"
- si l'utilisateur n'est pas connecté, rediriger sur la page de connexion
- si l'utilisateur connecté n'a pas les droits, afficher une page 403 "Forbidden"
- cacher les pages ou boutons qui nécessitent le role "admin"
*/