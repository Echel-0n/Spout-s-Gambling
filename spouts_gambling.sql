-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 14 mai 2021 à 20:37
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `spouts_gambling`
--

-- --------------------------------------------------------

--
-- Structure de la table `amis`
--

CREATE TABLE `amis` (
  `amis_id` int(11) NOT NULL,
  `amis_ajouteur` int(11) NOT NULL,
  `amis_friend` int(11) NOT NULL,
  `amis_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amis_supprimer` tinyint(1) NOT NULL DEFAULT '0',
  `amis_date_supprim` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `faq_en`
--

CREATE TABLE `faq_en` (
  `faq_id` int(11) NOT NULL,
  `faq_question` varchar(255) NOT NULL,
  `faq_reponse` varchar(255) NOT NULL,
  `faq_reponseDetail` varchar(1000) NOT NULL,
  `faq_creationQuest` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq_en`
--

INSERT INTO `faq_en` (`faq_id`, `faq_question`, `faq_reponse`, `faq_reponseDetail`, `faq_creationQuest`) VALUES
(1, 'Is there a minimum age to register and play?', 'No,', 'The legal age to play at an online casino is 18 years old in France, however, since our site is a pawn system, it is accessible to anyone over 16 years old.', '2021-05-13 15:56:12'),
(2, 'How do online games guarantee random play?', 'Casino gaming software uses an algorithm,', 'called a \"random number generator\", which creates randomnessand ensures that the cards, dice and slot machine reels operate in a completely random fashion.', '2021-05-13 15:56:12'),
(3, 'Which games have the best chance of success?', 'Table games are generally more favorable to players than slot machine,', ' which rely primarily on luckand chance. For example, roulette gives players a good chance of success.', '2021-05-13 15:56:12'),
(4, 'Is it possible to win?', 'Yes,', 'under certain conditions such as not playing when you are tired or stressed and practicing your playing techniques.', '2021-05-13 15:56:12'),
(5, 'Which games are the most popular in France?', 'The French are very fond of slot machines.', 'The popularity of these games is probably due to the simplicity of their rules.', '2021-05-13 15:56:12'),
(6, 'Since there is no money involved, how does the reward system work?', 'There is a system of chips.', 'At our casinogames site, there is no money involved; therefore, wins and losses are based on a system of chips that you earn as you play and then put back into play the next time you play.', '2021-05-13 15:56:12'),
(7, 'Do I have to register to play?', 'Yes,', 'Otherwise you will not be able to play. Moreover, by registering, each time you play your progress will be recorded, and we give you 1,000 chips to start your climb.', '2021-05-13 15:56:12'),
(8, 'What are the risks associated with online gambling?', 'Gambling is a form of entertainment', 'that, like other consumer products, can sometimes lead to addiction or dependency that can be harmful to the player and those around him or her. To avoid this, set a maximum budget and a time limit for gambling.However,if you are in this situation, there are associations that can help you, for example : S.O.S Joueurs.', '2021-05-13 15:56:12'),
(9, 'Is it mandatory to play on a computer?', 'It is not mandatory to play on a computer.', 'Our site adapts to all technological devices, both verticaland horizontal, such as on a computer, laptop or tablet, or on your smartphone.However, it is more interesting to play on a tablet or computer because the screen is larger and offers better visibility.', '2021-05-13 15:56:12');

-- --------------------------------------------------------

--
-- Structure de la table `faq_fr`
--

CREATE TABLE `faq_fr` (
  `faq_id` int(11) NOT NULL,
  `faq_question` varchar(255) NOT NULL,
  `faq_reponse` varchar(255) NOT NULL,
  `faq_reponseDetail` varchar(1000) NOT NULL,
  `faq_creationQuest` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq_fr`
--

INSERT INTO `faq_fr` (`faq_id`, `faq_question`, `faq_reponse`, `faq_reponseDetail`, `faq_creationQuest`) VALUES
(1, 'Y a-t-il un âge minimum pour s\'inscrire et jouer ?', 'Non,', 'L\'âge légal pour jouer sur un casino en ligne est porté à 18 ans en France, cependant étant donner que sur notre site c\'est un système avec des pions il est accessible à toutes personnes de plus de 16 ans.', '2021-05-13 15:45:55'),
(2, 'Comment les jeux en lignes garantissent-ils des jeux aléatoires ?', 'Les logiciels de jeux de casino ont recours à un algorithme,', 'Appelé \"générateur de nombres aléatoires\", qui crée du hasard et s\'assure que les cartes, les dés et les rouleaux des machines à sous fonctionnent de manière totalement aléatoire.', '2021-05-13 15:45:55'),
(3, 'Avec quels jeux a-t-on les meilleures chances de réussir ?', 'Les jeux de table sont généralement plus favorables', 'aux joueurs que les machines à sous qui reposent essentiellement sur de la chance et du hasard. Par exemple la roulette donne de bonnes chances de réussite aux joueurs.', '2021-05-13 15:45:55'),
(4, 'Est-il possible de gagner ?', 'Oui,', 'à certaines conditions comme ne pas jouer lorsquevous êtes fatigué ou stressé et vous entrainer pour pouvoir acquérir des techniques de jeux.', '2021-05-13 15:45:56'),
(5, 'Quels jeux sont les plus populaires en France ?', 'Les Français aiment beaucoup les machines à sous.', ' La popularité de ces jeux s\'explique sans doute par la simplicité de leurs règles.', '2021-05-13 15:45:56'),
(6, 'Etant donné qu\'il n\'y a pas d\'argent mis en jeu, comment fonctionne le sytème de récompense ?', 'Il y a un système de jetons', 'Sur notre site de jeux de casino, en effet aucun argent n\'est mis en jeu; par conséquent, les victoires ainsi que les défaites fonctionnent avec un système de jetons que vous gagné au fur et à mesure des parties que vous remettez en jeu aux parties suivantes.', '2021-05-13 15:45:56'),
(7, 'Est-il obligatoire de s\'inscrire pour jouer ?', 'Oui,', 'Sinon vous ne pourrez pas jouer. De plus, en vous inscrivant, à chaque fois que vous jouerez votre progression sera enregistrer, et nous vous donnons 1 000 jetons pour commencer votre ascension.', '2021-05-13 15:45:56'),
(8, 'Quels sont les risques liés aux jeux d\'argent en ligne ?', 'Les jeux d\'argent constituent un divertissement', 'qui, comme d\'autres produits accessible à la consommation peuvent parfois entrainer une addiction ou une dépendance pouvant porter préjudices au joueur et à son entourage. Pour éviter cela, définissez-vous un budget maximum et un temps limite de jeu. Malgré tout si vous êtes dans cette situation, il existe des associations qui peuvent vous venir en aide, par exemple :S.O.S Joueurs.', '2021-05-13 15:45:56'),
(9, 'Doit-on obligatoirement jouer sur ordinateur ?', 'Il n\'est pas obligatoire de jouer sur un ordinateur.', 'Notre site s\'adapte à tous les appareils technologiques aussi bien verticale que horizontale, tel que sur ordinateur, sur ordinateur portable ou tablette , ou bien sur votre smartphone.Cependant, il est plus intéressant de jouer sur tablette ou ordinateur car l\'écran est plus large et offre une meilleure visibilité.', '2021-05-13 15:45:56');

-- --------------------------------------------------------

--
-- Structure de la table `game`
--

CREATE TABLE `game` (
  `id_game` int(11) NOT NULL,
  `nom_game` varchar(250) NOT NULL,
  `description_game` varchar(500) DEFAULT NULL,
  `image_game` varchar(500) NOT NULL,
  `image_profil_game` varchar(255) NOT NULL,
  `regles_game` varchar(1000) NOT NULL,
  `code_game` varchar(1000) NOT NULL,
  `effet_sonore_game` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `game`
--

INSERT INTO `game` (`id_game`, `nom_game`, `description_game`, `image_game`, `image_profil_game`, `regles_game`, `code_game`, `effet_sonore_game`) VALUES
(1, 'Yam\'s', 'blabla', 'yams.png', 'yams_square.png', 'blabla', 'yams', 'blabla'),
(2, 'jeu-2', 'blabla', 'fond_jeu_exemple.png', 'fond_jeu_exemple.png', 'blabla', 'blabla', 'blabla'),
(3, 'jeu-3', 'blabla', 'fond_jeu_exemple.png', 'fond_jeu_exemple.png', 'blabla', 'blabla', 'blabla'),
(4, 'jeu-4', 'blabla', 'fond_jeu_exemple.png', 'fond_jeu_exemple.png', 'blabla', 'blabla', 'blabla'),
(5, 'jeu-5', 'blabla', 'fond_jeu_exemple.png', 'fond_jeu_exemple.png', 'blabla', 'blabla', 'blabla'),
(6, 'jeu-6', 'blabla', 'fond_jeu_exemple.png', 'fond_jeu_exemple.png', 'blabla', 'blabla', 'blabla'),
(7, 'jeu-7', 'blabla', 'fond_jeu_exemple.png', 'fond_jeu_exemple.png', 'blabla', 'blabla', 'blabla'),
(8, 'jeu-8', 'blabla', 'fond_jeu_exemple.png', 'fond_jeu_exemple.png', 'blabla', 'blabla', 'blabla'),
(9, 'jeu-9', 'blabla', 'fond_jeu_exemple.png', 'fond_jeu_exemple.png', 'blabla', 'blabla', 'blabla'),
(10, 'jeu-10', 'blabla', 'fond_jeu_exemple.png', 'fond_jeu_exemple.png', 'blabla', 'blabla', 'blabla'),
(11, 'jeu-11', 'blabla', 'fond_jeu_exemple.png', 'fond_jeu_exemple.png', 'blabla', 'blabla', 'blabla'),
(12, 'jeu-12', 'blabla', 'fond_jeu_exemple.png', 'fond_jeu_exemple.png', 'blabla', 'blabla', 'blabla');

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

CREATE TABLE `partie` (
  `partie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `partie_debut` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `partie_fin` datetime DEFAULT NULL,
  `partie_gagne` tinyint(1) DEFAULT NULL,
  `partie_fini` tinyint(1) NOT NULL DEFAULT '0',
  `partie_jetonMise` int(11) NOT NULL,
  `partie_jetonGagne` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `partie_evolution`
--

CREATE TABLE `partie_evolution` (
  `partie_evolution_id` int(11) NOT NULL,
  `partie_id` int(11) NOT NULL,
  `partie_evolution_action` varchar(255) NOT NULL,
  `partie_evolution_value` varchar(1000) DEFAULT NULL,
  `partie_evolution_moment` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `ticket_type` varchar(255) NOT NULL,
  `ticket_content` varchar(1500) NOT NULL,
  `ticket_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ticket_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_mdp` varchar(255) NOT NULL,
  `user_pseudo` varchar(255) NOT NULL,
  `user_nb_jeton` int(255) NOT NULL,
  `user_admin` tinyint(1) NOT NULL,
  `user_ban_def` tinyint(1) NOT NULL,
  `user_ban_temp` datetime DEFAULT NULL,
  `user_nom` varchar(255) NOT NULL,
  `user_prenom` varchar(255) NOT NULL,
  `user_birth` date NOT NULL,
  `user_creation_compte` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_image` varchar(255) NOT NULL DEFAULT 'user-default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `amis`
--
ALTER TABLE `amis`
  ADD PRIMARY KEY (`amis_id`),
  ADD KEY `amis_premier` (`amis_ajouteur`),
  ADD KEY `amis_second` (`amis_friend`);

--
-- Index pour la table `faq_en`
--
ALTER TABLE `faq_en`
  ADD PRIMARY KEY (`faq_id`);

--
-- Index pour la table `faq_fr`
--
ALTER TABLE `faq_fr`
  ADD PRIMARY KEY (`faq_id`);

--
-- Index pour la table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id_game`);

--
-- Index pour la table `partie`
--
ALTER TABLE `partie`
  ADD PRIMARY KEY (`partie_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `game_id` (`game_id`);

--
-- Index pour la table `partie_evolution`
--
ALTER TABLE `partie_evolution`
  ADD PRIMARY KEY (`partie_evolution_id`),
  ADD KEY `partie_id` (`partie_id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `ticket_user` (`ticket_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `amis`
--
ALTER TABLE `amis`
  MODIFY `amis_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `faq_en`
--
ALTER TABLE `faq_en`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `faq_fr`
--
ALTER TABLE `faq_fr`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `game`
--
ALTER TABLE `game`
  MODIFY `id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `partie`
--
ALTER TABLE `partie`
  MODIFY `partie_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partie_evolution`
--
ALTER TABLE `partie_evolution`
  MODIFY `partie_evolution_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `amis`
--
ALTER TABLE `amis`
  ADD CONSTRAINT `amis_ibfk_1` FOREIGN KEY (`amis_ajouteur`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `amis_ibfk_2` FOREIGN KEY (`amis_friend`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `partie`
--
ALTER TABLE `partie`
  ADD CONSTRAINT `partie_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `partie_ibfk_2` FOREIGN KEY (`game_id`) REFERENCES `game` (`id_game`);

--
-- Contraintes pour la table `partie_evolution`
--
ALTER TABLE `partie_evolution`
  ADD CONSTRAINT `partie_evolution_ibfk_1` FOREIGN KEY (`partie_id`) REFERENCES `partie` (`partie_id`);

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`ticket_user`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
