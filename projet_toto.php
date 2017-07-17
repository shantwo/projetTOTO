<?php

/* -- Part 1 = Organisation --
------------------------------
- cr�er l'arborescence suivante :
	inc/
		config.php
		db.php
		functions.php
	view/
		header.php
		footer.php
		home.php
		list.php
		student.php
		add.php
	public/
		css/
		img/
		js/
		index.php
		list.php
		student.php
		add.php
		edit.php

- inc/config.php :
	* cr�er un tableau $config avec en valeurs les donn�es n�cessaires � la connexion � la DB (host, username, password, database)
	* inclure les fichiers db.php et functions.php

- inc/db.php :
	* �crire le code de connexion � la base de donn�es (PDO + dsn) en se basant sur les valeurs du tableau $config

- inclure le fichier de config dans chaque fichier "public"

- view/header.php :
	* mettre en place un menu en haut de page (bootstrap est pas mal ^^) avec les liens suivants :
		** Home => index.php
		** Toutes les sessions => index.php
		** Toutes les �tudiants => list.php
		** Ajout d'un �tudiant => add.php

- view/footer.php :
	* mettre un footer avec un copyright et l'ann�e courante => � 2017 | Tous droits r�serv�s

- public/index.php
	* en fin de script, inclure les vues "header", "home" & "footer"
*/

/* -- Part 2 = Page liste --
----------------------------

- public/list.php :
	* en fin de script, inclure les vues "header" & "footer"
	* r�cup�rer toutes les informations sur tous les �tudiants en DB
	* inclure la vue correspondant � la page "list"
	* afficher les informations (id, nom, pr�nom, email et date de naissance) sous forme de tableau (<table>). Attention, l'affichage se fait dans la vue (view)

*/

/* -- Part 3 = Page student --
----------------------------

- public/list.php :
	* pour chaque ligne du tableau (<table>), ajouer un bouton (lien) qui envoie sur la page student

- public/student.php :
	* r�cup�rer toutes les informations pour l'�tudiant sp�cifi�
	* inclure la vue correspondant � la page "student"
	* afficher les informations (id, nom, pr�nom, email, date de naissance, age, ville, sympathie, num�ro et nom de session). Attention, l'affichage se fait dans la vue (view) et je ne veux pas de tableau (<table>)

*/

/* -- Part 4 = Page add/ajout --
--------------------------------
	
- public/add.php :
	* inclure la vue correspondant � la page "add"
	* dans la vue, �crire le formulaire HTML permettant de saisir les donn�es suivantes sur un student :
		nom, pr�nom
	* apr�s soumissions du formulaire :
		** r�cup�rer les donn�es envoy�es en POST par le formulaire
		** traiter et valider les donn�es
		** si toutes les donn�es sont valides, ajouter en DB puis rediriger sur la page "student" de l'�tudiant ajout�
	* r�cup�rer toutes les villes de la DB (ou utiliser l'array)
	* r�cup�rer toutes les sessions de la DB
	* si tout fonctionne, ajouter les champs suivants (et leur traitement, validation, etc.) :
		date de naissance, email, sympathie, session (menu d�roulant <select>) et ville (menu d�roulant <select>)

*/

/* -- Part 5 = Pagination --
----------------------------

- demander le cours sur cette partie
- view/list.php :
	* ajouter des boutons suivants et pr�c�dents

- public/list.php :
	* limiter les r�sultats de la requ�te � 5 �tudiants
	* mettre en place un syst�me de pagination en passant le num�ro de page dans l'URL : list.php?page=2

*/

/* -- Part 6 = recherche --
-----------------------------

- view/header.php :
	* dans la barre de menu, ajouter un formulaire permettant d'effectuer une recherche
		Ce formulaire renvoie sur list.php avec le mot recherch�e en GET

- public/list.php :
	* r�cup�rer le param�tre GET contenant le mot recherch�
	* si l'ID est fourni :
		** modifier la requ�te pour filtrer sur le mot recherch� dans les champs textuels suivants :
			nom/pr�nom/email/ville de l'�tudiant
		** afficher "x r�sultat(s) pour le mot XX" avant le tableau (<table>) des �tudiants

*/

/* -- Part 7 = Home --
----------------------

- public/index.php :
	* r�cup�rer toutes donn�es sur les sessions en DB (nom de la session, num�ro, dates et lieu)
	* inclure la vue correspondant � la page "home"
	* afficher toutes les sessions, regroup�es par lieu

*/

/* -- Part 8 = Liste pour 1 session --
--------------------------------------

- public/index.php :
	* mettre un lien sur les noms, dates et lieux dans sessions. Ce lien renvoit sur list.php pour afficher les �tudiants de cette session uniquement (filtre)

- public/list.php :
	* r�cup�rer le param�tre GET contenant l'ID de la session demand�e
	* si l'ID est fourni :
		** modifier la requ�te pour filtrer sur l'ID de session
		** afficher "Etudiants pour la session n�X � XXX" avant le tableau (<table>) des �tudiants

*/

/* -- Option 1 = home --
------------------------

- public/index.php :
	* r�cup�rer la statistique suivante (agr�gation) :
		le nombre d'�tudiants par ville
	* dans la vue, afficher les villes et leur nombres d'�tudiants, sous forme de tableau (<table>)

*/

/* -- Option 2 = Suppression �tudiant --
----------------------------------------

- public/list.php :
	* dans la vue, ajouter un bouton "Supprimer" (lien) pour chaque �tudiant
	* supprimer l'�tudiant dont l'ID est pass� en GET, dans la DB

*/

/* -- Option 3 = Modification --
--------------------------------

- public/student.php :
	* dans la vue, ajouter un bouton "Modifier" (lien) qui renvoi sur edit.php
	* si besoin, cr�er une vue pour "edit"
	* pr�-remplir le formulaire de modification avec les donn�es de l'�tudiant
	* g�rer la soumission du formulaire comme pour add.php (r�cup�ration, traitement, validation, update)

*/

/* -- Option 4 = Organiser son code --
--------------------------------------

- inc/functions.php :
	* �crire une fonction pour chaque requ�te SQL. Ces fonctions retourneront le tableau de r�sultats (fetchAll)

- public/*.php :
	* il ne doit plus y avoir de requ�tes. Il faut toutes les d�placer dans une fonction dans inc/functions.php
	* ne pas oublier d'appeler la fonction cr��e, puis de r�cup�rer son r�sultat

*/

/* -- Extra 1 = Add/Edit --
-------------------------

- public/add.php & public/edit.php :
	* comme les 2 fichiers sont similaires, faire en sorte d'ajouter et modifier dans un seul et unique fichier

*/

/* -- Extra 2 = Filtres --
------------------------

- view/list.php :
	* ajouter un formulaire (en GET) permettant de filtrer les �tudiants par "session", par "training", par date, par statut (session termin�e, active ou future)

- public/list.php :
	* r�cup�rer les donn�es du formulaire de "filtre"
	* modifier la requ�te pour prendre en compte ces filtres

*/

/* -- Extra 3 = Nombre de r�sultats par page param�trable --
------------------------------------------------------------

- view/list.php :
	* ajouter un formulaire (en GET) permettant de d�finir un nombre de r�sultats par page (<select>)

- public/list.php :
	* r�cup�rer cette donn�e en GET
	* modifier le calcul de l'offset, et la requ�te pour prendre en compte ce changement

*/

/* -- Extra 4 = Export --
-------------------------

- public/list.php :
	* dans la vue, ajouter un formulaire en POST avec un bouton "Exporter en CSV" (sur la m�me page)
	* si formulaire export sousmis :
		** ex�cuter la m�me requ�te (filtres) et r�cup�rer les donn�es
		** cr�er un fichier export.csv (regarder le format CSV) dans le r�pertoire tmp (� cr�er), avec les donn�es nom, pr�nom, email, date de naissance et ville
		** renvoyer au navigateur le contenu du fichier csv, avec le bon header HTTP, pour l'internaute t�l�charge le fichier
		** supprimer le fichier csv

*/

/* -- Extra 5 = CRUDs --
------------------------

- public/index.php :
	* dans la liste des sessions, ajouter un bouton renvoyant sur la page de modification d'une session

- public/session_add.php :
	* comme pour "student", mettre en place l'interface permettant d'ajouter/modifier une session

- public/index.php :
	* dans la liste des sessions, ajouter un lien sur le nom du "training" renvoyant sur la page de modification d'un "training"

- public/training_add.php :
	* comme pour "session_add", mettre en place l'interface permettant d'ajouter/modifier une session

*/
