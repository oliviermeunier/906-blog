-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 22 juin 2021 à 08:43
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
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id_article`, `title`, `content`, `created_at`) VALUES
(1, 'L’affaire Mimi Marchand perturbe la rédaction de « Paris Match »', 'La cocotte minute Paris Match bout à gros bouillons et menace de déborder. Vendredi 18 juin, 85 % de sa rédaction a voté en faveur d’une lettre très critique, rédigée par la Société des journalistes et les élus du personnel, à l’encontre de son directeur de la rédaction, Hervé Gattegno. A l’origine de ce courroux : les conditions de la publication par Paris Match d’un entretien et de photos de Ziad Takieddine, réalisés à Beyrouth, à l’automne 2020, où l’affairiste revenait sur ses propos contre Nicolas Sarkozy, qui l’accusaient d’avoir touché de l’argent de Mouammar Kadhafi pour financer sa campagne présidentielle de 2007.\r\nArticle réservé à nos abonnés Lire aussi Rétractation de Ziad Takieddine : Mimi Marchand, papesse de la presse people, mise en examen\r\n\r\nCe reportage a abouti, le 5 juin, à la mise en examen de Michèle Marchand, dite « Mimi Marchand », la fondatrice l’agence photo Bestimage, pour « subornation de témoin » et « association de malfaiteurs ». Les juges veulent savoir si l’homme d’affaires franco-libanais a été forcé de se livrer à ce revirement, voire a été soudoyé, et quel rôle la papesse de la presse people a joué dans l’affaire. Cette dernière, qui conteste ces accusations, a été incarcérée, vendredi 18 juin, après avoir violé son contrôle judiciaire.\r\n\r\nPourquoi et comment cet entretien a-t-il été organisé ? C’est l’interrogation de la rédaction, après que les juges ont interdit au directeur de la rédaction, Hervé Gattegno, « d’entrer en communication » avec Mimi Marchand, Nicolas Sarkozy et son avocat Thierry Herzog. « Ces faits (…), s’ils étaient démontrés, porteraient atteinte à la crédibilité de notre titre et de la rédaction dans son ensemble », s’émeut la lettre, se désolant que la « direction [n’ait] pas jugé bon de s’expliquer sur cet épisode ».', '2021-06-09 10:44:43'),
(2, 'Euro 2021, la gazette : « KDB », la lucarne de « Titi » et le non-boycott', 'Dans un groupe B très ouvert, le Danemark va tenter de grappiller ses premiers points dans cet Euro face à la Russie. Auteurs d’une très belle prestation contre la Belgique malgré la défaite, les coéquipiers de Christian Eriksen, qui est sorti de l’hôpital après son malaise cardiaque, peuvent toujours espérer se qualifier. Mais cela passe forcément par une victoire contre la Russie. Dans l’autre match du groupe, la Belgique (6 points) affronte la Finlande (3 points), qui peut, elle aussi, espérer se qualifier.\r\n\r\nDans le groupe C, la deuxième place se jouera entre l’Autriche et l’Ukraine, qui possèdent chacune trois points. Un match nul et ce sont les joueurs d’Andreï Chevtchenko qui valideraient leur billet pour les huitièmes. Dans l’autre match du groupe, les Pays-Bas, assurés de finir premiers, pourront faire tourner l’effectif face à la Macédoine (0 point).', '2021-06-01 10:46:23'),
(3, 'Nouvelle sortie réussie dans l’espace pour Thomas Pesquet', 'L’astronaute français Thomas Pesquet a regagné sans encombre dimanche 20 juin l’intérieur de la Station spatiale internationale (ISS) après une nouvelle sortie dans l’espace de plus de six heures, consacrée à l’installation de nouveaux panneaux solaires sur l’ISS.\r\n\r\nC’est la quatrième sortie de Thomas Pesquet dans l’espace, et la deuxième lors de cette mission, menée avec son coéquipier américain Shane Kimbrough. A 11 h 42 GMT, les deux hommes, arrivés à bord de la Station à la fin d’avril, ont mis en route la batterie interne de leur combinaison, puis ont ouvert l’écoutille du sas de décompression de l’ISS.\r\nLire aussi Thomas Pesquet dans la Station spatiale internationale : c’est peut-être un détail pour vous…\r\n\r\nThomas Pesquet, est sorti dans le vide en premier, suivi de son coéquipier. Durant six heures et vingt-huit minutes, les astronautes ont fini de positionner, fixer, brancher et déployer un premier panneau solaire nouvelle génération, long de 19 mètres, et commencé à en installer un second. Appelés iROSA, ces panneaux solaires sont censés augmenter les capacités de production d’énergie de l’ISS et ont été livrés par un cargo de SpaceX.', '2021-06-05 10:47:07');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id_comment`, `content`, `created_at`, `article_id`) VALUES
(8, 't tyj ryukyuk yu', '2021-06-22 10:31:20', 1),
(9, 'yuk tyjtyjty', '2021-06-22 10:31:23', 1),
(10, 'ryukyrukry u', '2021-06-22 10:31:24', 1),
(11, 'tkjyuk yuk', '2021-06-22 10:32:03', 3),
(12, 'tyuky uiktuot uo', '2021-06-22 10:40:20', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `article_id` (`article_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
