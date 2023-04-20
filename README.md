# Spout's Gambling

Projet réaliser dans le cadre des cours de développement web de L1 Mathématiques à l'université de Tours.

Il vous faut un serveur Apache et SQL.\
Sur le serveur SQL, créez une base de données, executez y "spouts_gambling.sql", et renseignez les informations dans "/ressources/fonctions/info_base_donnee.php".\
L'execution se fait par l'insertion de ce projet dans le dossier htdocs d'un serveur Apache et la connexion à ce-dernier.

---
Participants:
---
- Mellin
- Proust
- Piou
- Petit
- Lerat
- Jourdain

Dans l'ensemble, le projet a en grande partie été réalisé en groupe lors de sessions communes ou chacun s'investissait afin de penser au rendu des différentes pages, de les concrétiser en code ainsi que pour trouver des idées innovantes pour rendre le site dynamique et complet.

Base de données:
---
La structure de la base de données a été exportée depuis phpMyAdmin dans le fichier "spouts_gambling.sql"

Information:
---
- Un seul jeu a été coder, à cause de la difficulté à mettre en place le système de points et de sécurité (Toutes les actions se passe côté serveur, l'utilisateur ne fait qu'indiquer ses choix dont les calculs tiennent compte)
- Les autres jeux sont fictif, et n'ayants pas de codes, ils déclencheront une erreur php à leurs lancement.
- Les formulaires sont tous fonctionnels, il n'est juste pas encore possible de modifier son adresse e-mail ou son mot de passe (un espace a été prévu à droite de l'écran lorsque l'utilisateur consulte sa page)
- Aucun compte n'est créé dans la base de données fournie, vous pourrez en créer autant que voulu avec des adresses e-mail fictives (ou non).
- Le système d'amitié fonctionne, même s'il est à sens unique.
- Les systèmes de bannissement temporaire et permanent ne sont pas fonctionnels, et vont être integrer dans des tables à part.
- Les administrateurs ont une petite pastille apparaître sur leur photo de profil, et auront dans le futur un onglet supplémentaire leurs permettant d'accéder à une page de gestion qui leurs est dédiée.
Pour modifier les informations de la base de données, vous pous pouvez accéder au document avec le lien suivant : /ressources/fonctions/info_base_donnee.php

Note:
---
Le site a été développer sous Google Chrome et sur des écrans d'ordinateurs 16:9 principalement, même s'il est responsive, quelques problèmes peuvent survenir lors d'un changement de taille d'écran ou du visionnage sur un trop petit écran, ainsi que des problèmes liés au navigateur.

Pour rendre un premier utilisateur administrateur, vous devrez passer par la base de données et modifier le booléen de la colonne user_admin.

Le site fonctionne avec des séries de "include", tous partants du fichier "index.php" dans le dossier principal
- Le fichier "index.php" est donc présenté avec du html correcte, là où les autres fichiers ne sont que des insertions de code dans ce premier.

Les URL sont rendus avec le fichier ".htaccess" (dans le dossier principal):
- /fr/game/1
	équivaut à "index.php?lang='fr'&content='game'&id='1'"
	(Cela ne vaut que pour les langues 'fr' et 'en')
