-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : ven. 25 juin 2021 à 10:21
-- Version du serveur :  5.7.24
-- Version de PHP : 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wf3-906-blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id_article` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `category_id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `title`, `content`, `created_at`, `category_id`, `image`) VALUES
(1, 'L’affaire Mimi Marchand perturbe la rédaction de « Paris Match »', 'La cocotte minute Paris Match bout à gros bouillons et menace de déborder. Vendredi 18 juin, 85 % de sa rédaction a voté en faveur d’une lettre très critique, rédigée par la Société des journalistes et les élus du personnel, à l’encontre de son directeur de la rédaction, Hervé Gattegno. A l’origine de ce courroux : les conditions de la publication par Paris Match d’un entretien et de photos de Ziad Takieddine, réalisés à Beyrouth, à l’automne 2020, où l’affairiste revenait sur ses propos contre Nicolas Sarkozy, qui l’accusaient d’avoir touché de l’argent de Mouammar Kadhafi pour financer sa campagne présidentielle de 2007.\r\nArticle réservé à nos abonnés Lire aussi Rétractation de Ziad Takieddine : Mimi Marchand, papesse de la presse people, mise en examen\r\n\r\nCe reportage a abouti, le 5 juin, à la mise en examen de Michèle Marchand, dite « Mimi Marchand », la fondatrice l’agence photo Bestimage, pour « subornation de témoin » et « association de malfaiteurs ». Les juges veulent savoir si l’homme d’affaires franco-libanais a été forcé de se livrer à ce revirement, voire a été soudoyé, et quel rôle la papesse de la presse people a joué dans l’affaire. Cette dernière, qui conteste ces accusations, a été incarcérée, vendredi 18 juin, après avoir violé son contrôle judiciaire.\r\n\r\nPourquoi et comment cet entretien a-t-il été organisé ? C’est l’interrogation de la rédaction, après que les juges ont interdit au directeur de la rédaction, Hervé Gattegno, « d’entrer en communication » avec Mimi Marchand, Nicolas Sarkozy et son avocat Thierry Herzog. « Ces faits (…), s’ils étaient démontrés, porteraient atteinte à la crédibilité de notre titre et de la rédaction dans son ensemble », s’émeut la lettre, se désolant que la « direction [n’ait] pas jugé bon de s’expliquer sur cet épisode ».', '2021-06-09 10:44:43', 2, 'https://picsum.photos/seed/1/800/300'),
(2, 'Euro 2021, la gazette : « KDB », la lucarne de « Titi » et le non-boycott', 'Dans un groupe B très ouvert, le Danemark va tenter de grappiller ses premiers points dans cet Euro face à la Russie. Auteurs d’une très belle prestation contre la Belgique malgré la défaite, les coéquipiers de Christian Eriksen, qui est sorti de l’hôpital après son malaise cardiaque, peuvent toujours espérer se qualifier. Mais cela passe forcément par une victoire contre la Russie. Dans l’autre match du groupe, la Belgique (6 points) affronte la Finlande (3 points), qui peut, elle aussi, espérer se qualifier.\r\n\r\nDans le groupe C, la deuxième place se jouera entre l’Autriche et l’Ukraine, qui possèdent chacune trois points. Un match nul et ce sont les joueurs d’Andreï Chevtchenko qui valideraient leur billet pour les huitièmes. Dans l’autre match du groupe, les Pays-Bas, assurés de finir premiers, pourront faire tourner l’effectif face à la Macédoine (0 point).', '2021-06-01 10:46:23', 1, 'https://picsum.photos/seed/2/800/300'),
(3, 'Nouvelle sortie réussie dans l’espace pour Thomas Pesquet', 'L’astronaute français Thomas Pesquet a regagné sans encombre dimanche 20 juin l’intérieur de la Station spatiale internationale (ISS) après une nouvelle sortie dans l’espace de plus de six heures, consacrée à l’installation de nouveaux panneaux solaires sur l’ISS.\r\n\r\nC’est la quatrième sortie de Thomas Pesquet dans l’espace, et la deuxième lors de cette mission, menée avec son coéquipier américain Shane Kimbrough. A 11 h 42 GMT, les deux hommes, arrivés à bord de la Station à la fin d’avril, ont mis en route la batterie interne de leur combinaison, puis ont ouvert l’écoutille du sas de décompression de l’ISS.\r\nLire aussi Thomas Pesquet dans la Station spatiale internationale : c’est peut-être un détail pour vous…\r\n\r\nThomas Pesquet, est sorti dans le vide en premier, suivi de son coéquipier. Durant six heures et vingt-huit minutes, les astronautes ont fini de positionner, fixer, brancher et déployer un premier panneau solaire nouvelle génération, long de 19 mètres, et commencé à en installer un second. Appelés iROSA, ces panneaux solaires sont censés augmenter les capacités de production d’énergie de l’ISS et ont été livrés par un cargo de SpaceX.', '2021-06-05 10:47:07', 4, 'https://picsum.photos/seed/3/800/300');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `label` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id_category`, `label`) VALUES
(1, 'Nature'),
(2, 'International'),
(3, 'Economie'),
(4, 'PHP');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `article_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `content`, `created_at`, `article_id`, `user_id`) VALUES
(17, 're jttyk yrukryuk', '2021-06-23 14:25:52', 1, 2),
(18, 'ihomiom', '2021-06-23 15:04:41', 3, 2),
(19, 'rj tryty jtjty', '2021-06-23 15:14:26', 3, 2),
(20, 'ty kjyukyukyu', '2021-06-25 10:13:26', 1, 2),
(21, 'AAAAAAAAAAAAA', '2021-06-25 10:13:32', 1, 2),
(22, 'BBBBBBBBBBBBB', '2021-06-25 11:25:59', 1, 2),
(23, 'CCCCCCCCCCC', '2021-06-25 12:03:18', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `firstname`, `lastname`, `email`, `password`, `created_at`) VALUES
(1, 'Alfred', 'Dupont', 'alfred@gmail.com', '$2y$10$rxuchjJhF3MNOMaFde1xQeyNOIyf/AJLwXRz5o58.8C/bY5qPDNfS', '2021-06-22 16:09:19'),
(2, 'Olivier', 'Meunier', 'oli.meunier@gmail.com', '$2y$10$xNYrR4d5THOYQjKj0nlI8Ob8f0dEhkE12NdIDDp9yf3dRgKz356E.', '2021-06-22 16:31:01'),
(3, 'rt h reytjtyj', 'trk ryuk ryu', 'admin@admin.com', '$2y$10$Rne/Fsh/C6347ABWP/I.lOYTwJWL5rHsBOQDuGNoOBAKb/Gc5YHgC', '2021-06-22 16:34:20'),
(4, 'ukukutiktui', 'yukyi', 'admiuikuikn@admin.com', '$2y$10$RP.kBCwyvXGmZPF9nqF/ru/7Zj4WY.D0EG05VYipW1xYBLtmCMRAG', '2021-06-23 12:16:49'),
(5, 'dtyjdtyj', 'dkyk yukr yu k', 'adrthrthmin@admhrthrin.com', '$2y$10$gybSODS1xr3RKFF38G03a.CZ/H0/5Ao67KO/OUFnfwSIN9s3pc9a.', '2021-06-23 12:27:54'),
(6, 'yukyuky', 'ukyukyuk', 'admiyukyukn@admin.com', '$2y$10$U10WkECWa6DzErfJhNBOieswWbLAnOFNTefDtWseN6IVgS0Fu8UgW', '2021-06-23 15:04:10'),
(7, 'tyuiyui', 'tyuityui', 'admyuiryuiin@admin.com', '$2y$10$w9OmIuWCYK4oKQSQAvEw2.zk3q9luq/KvJ89t0UBpCeS2o4KUXhNW', '2021-06-25 10:26:50'),
(8, 'er zrethr', 'trthteyh', 'admin@admtyjtryjin.com', '$2y$10$uC0.NXSZ0Y.gxVfDSpQ5eu/jqzPMBjaPmqXtUMzNU.7DeQvaR1WEC', '2021-06-25 12:09:03');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
