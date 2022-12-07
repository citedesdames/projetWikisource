# projetWikisource
Site de choix de pages pour un projet pédagogique sur Wikisource (https://fr.wikisource.org/wiki/Wikisource:Projets_pédagogiques)

Demander le nom de chaque étudiante ou étudiant sans le faire apparaitre dans l'interface a pour objectif de permettre une éventuelle évaluation avec attribution d'un bonus ou d'une note à chacun et chacune. Mais la base de données contient alors des informations à caratère personnel susceptibles de dévoiler l'identité associée à des pseudos Wikipédia/Wikisource, en les croisant avec l'historique des pages Wikisource concernées : attention à bien la sécuriser.

## Installation
Installer sur un serveur permettant l'hébergement d'applications web PHP/MySQL :
* créer la table `wikisourceHeptameron` dans la base de données en utilisant le fichier [`wikisourceHeptameron.sql`](https://github.com/citedesdames/projetWikisource/blob/main/wikisourceHeptameron.sql), par exemple en l'important dans la base depuis phpMyAdmin.
* modifier le fichier [`connexion.php`](https://github.com/citedesdames/projetWikisource/blob/main/connexion.php) pour indiquer les bons paramètres de connexion à la base de données (serveur, port, identifiant, mot de passe)
* adapter le contenu du fichier [`index.php`](https://github.com/citedesdames/projetWikisource/blob/main/index.php) en fonction de l'ouvrage Wikisource choisi pour le projet de relecture : contenu des variables `$url`, `$table`, `$pageDebut`, `$pageFin`, modifier le titre indiqué dans les balises `h1` et `title`, modifier la mention RGPD indiquée en bas de page, dans la balise `footer`

## Copie d'écran de l'application projetWikisource
![Copie d'écran de l'application projetWikisource!](/screenshot-projet-Wikisource.png "Copie d'écran de l'application projetWikisource")