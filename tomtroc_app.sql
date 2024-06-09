-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 09 juin 2024 à 21:08
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc_app`
--

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `author` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `availability` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `user_id`, `title`, `author`, `description`, `availability`) VALUES
(26, 28, 'Orgueil et préjugés', 'Jane Austen', 'Élisabeth Bennet a quatre sœurs et une mère qui ne songe qu&#039;à les marier. Quand parvient la nouvelle de l&#039;installation à Netherfield, le domaine voisin, de Mr Bingley, célibataire et beau parti, toutes les dames des alentours sont en émoi, d&#039;autant plus qu&#039;il est accompagné de son ami Mr Darcy, un jeune et riche aristocrate. Les préparatifs du prochain bal occupent tous les esprits...', 'disponible'),
(27, 28, 'Les Hauts de Hurle-Vent', 'Emily Brontë', 'Adopté par la famille Earnshaw, Heathcliff est élevé dans le domaine de Wuthering Heights. À la mort de son père, il est réduit au rôle de domestique. Seule la jeune Cathy Earnshaw lui permet de supporter les mauvais traitements et les insultes. Devenus inséparables, ils éprouvent bientôt l’un pour l’autre une passion dévorante. Mais leurs différences sociales condamnent leur relation. Malgré son amour, Cathy ne peut imaginer une union avec un homme sans rang ni éducation. Heathcliff en gardera à jamais une blessure profonde. De celles qui inspirent un sentiment de vengeance.', 'disponible'),
(28, 28, 'L&#039;Étranger', 'Albert Camus', 'Quand la sonnerie a encore retenti, que la porte du box s&#039;est ouverte, c&#039;est le silence de la salle qui est monté vers moi, le silence, et cette singulière sensation que j&#039;ai eue lorsque j&#039;ai constaté que le jeune journaliste avait détourné les yeux. Je n&#039;ai pas regardé du côté de Marie. Je n&#039;en ai pas eu le temps parce que le président m&#039;a dit dans une forme bizarre que j&#039;aurais la tête tranchée sur une place publique au nom du peuple français...', 'non dispo.'),
(29, 28, 'L&#039;Odyssée', 'Homère', 'Ulysse, héros grec de la guerre de Troie, celui dont la ruse a permis à mettre fin à un siège de 10 ans, voudrait regagner son île d&#039;Ithaque, où l&#039;attendent sa femme Pénélope et son fils Télémaque. Mais les dieux ne l&#039;entendent pas de cette ainsi. Sur le chemin du retour, il doit affronter le Cyclope, la magicienne Circé, les Sirènes au chant mortel, les monstres Charybde et Scylla, et bien d&#039;autres encore.  Aidé de la déesse Athéna, Ulysse parviendra-t-il à retrouver son palais et à se débarrasser des prétendants qui convoitent sa femme et ses biens?', 'non dispo.'),
(30, 29, 'Hamlet', 'William Shakespeare', 'Hamlet est le fils du Roi de Danemark, remplacé sur le trône et en tant qu’époux de la reine Gertrude par son frère aîné, Claudius. Le spectre du souverain défunt apparaît une nuit à Hamlet pour lui révéler qu’il a été empoisonné par Claudius, et le pousser à le venger.', 'disponible'),
(31, 29, 'Contes', 'Hans Christian Andersen', 'Sous la plume d’Andersen, les jouets s&#039;animent, les princes deviennent cygnes et la mer abrite des palais sublimes... De l&#039;émouvante histoire d&#039;amour de « La Petite Sirène » au récit troublant du « Vilain Petit Canard », des « Habits neufs de l&#039;Empereur » à « La Petite Fille aux allumettes », ces contes entraînent grands et petits au pays du rêve et de la poésie.', 'non dispo.'),
(32, 29, 'Le Rouge et le Noir', 'Stendhal', 'La jeunesse, l&#039;ambition, la volonté d&#039;être aimé au-dessus de ses moyens, ces vertus s&#039;incarnent dans Julien Sorel, dix-neuf ans aux premières pages du roman de Stendhal. Fils du charpentier, le jeune homme devient précepteur chez les Rênal. Le tendre loup est entré dans la bergerie : commence alors une des plus exaltantes histoires d&#039;amour qui soit.', 'disponible'),
(33, 29, 'L&#039;Iliade', 'Homère', 'La célèbre épopée d&#039;Homère raconte en vingt-quatre chants la terrible guerre qui vit les chefs grecs et les fils de Priam se déchirer, et la ville de Troie soumise au long siège des Achéens. Laissant leur pays, les Grecs ont traversé la mer et gagné la lointaine Ilion pour reconquérir Hélène aux bras blancs, la femme de Ménélas enlevée par le Troyen Pâris, fils du roi Priam. ', 'disponible'),
(36, 30, 'La Proie et l&#039;ombre', 'Edogawa Ranpo', 'Sous sa nuque, le col évasé de son kimono m&#039;offrait une vue plongeante jusque dans le creux de ses reins : les violentes zébrures qui balafraient sa peau blanche et moite, se perdaient au plus profond de l&#039;échancrure. Toute son élégance avait disparu et il émanait d&#039;elle une étrange impression d&#039;obscénité qui me subjuguait.\r\nDans ce roman très célèbre, subtil jeu de miroirs où le narrateur, Ranpo Edogawa lui-même, cherche à élucider un meurtre commis par un autre auteur de littérature policière, on retrouve - comme dans tous ses romans cette curieuse alchimie entre une intrigue rigoureuse et une narration envoûtante, dans des mises en scène fantastiques et obsessionnelles (fétichisme, voyeurisme, sadisme et perversions sexuelles).\r\n« Flânerie au bord du fleuve Edo », telle est la traduction littérale des idéogrammes utilisés pour composer ce nom de Edogawa Ranpo (anagramme de Edgar Allan Poe), reconnu au Japon comme le maître-fondateur de la littérature policière japonaise (1894-1965).', 'disponible'),
(37, 30, 'Sanctuaire', 'William Faulkner', 'C&#039;est Sanctuaire qui valut à Faulkner sa réputation d&#039;auteur ténébreux et scandaleux. L&#039;écrivain n&#039;a-t-il pas tenu à inventer, selon son expression, &quot;l&#039;histoire la plus effroyable qu&#039;on puisse imaginer&quot;? En réalité, il s&#039;est inspiré d&#039;un fait divers, survenu dans un night-club de la Nouvelle-Orléans : le viol d&#039;une jeune fille avec un &quot;objet bizarre&quot;, suivi d&#039;une étrange séquestration.\r\nDans un climat de violence, de bassesse et de corruption, remarquablement diffus et persistant, la jeune fille subit une sorte d&#039;initiation au mal, à travers laquelle Faulkner livre son interrogation sur l&#039;homme, avant de l&#039;élargir et de la faire porter sur la société tout entière.\r\nSanctuaire, septième roman de Faulkner, est aussi son récit le plus direct. Paru la même année que La Clé de verre et un an après Le Faucon maltais, les deux chefs-d&#039;oeuvre de Dashiell Hammett, ce roman noir est un des précurseurs du hard-boiled novel, auquel Hammett, Raymond Chandler ou James Cain donnèrent ses lettres de noblesse.', 'non dispo.'),
(38, 30, 'Par-delà le bien et le mal', 'Friedrich Nietzsche', 'C&#039;est d&#039;abord à une radicale remise en question de la vérité que procède Nietzsche (1844-1900) dans Par-delà le bien et le mal (1886). Ce texte d&#039;une écriture étincelante, férocement critique, met en effet au jour, comme un problème majeur jusque-là occulté, inaperçu, celui de la valeur. Il y destitue les positions philosophiques passées et présentes (autant de croyances), et stigmatise, en les analysant un à un, l&#039;ensemble des préjugés moraux qui sous-entendent notre civilisation. L&#039;entreprise, pourtant, n&#039;est pas uniquement négative : elle débouche sur l&#039;annonce dans le prolongement d&#039;Ainsi parlait Zarathoustra, de &quot; nouveaux philosophes &quot; - &quot; philosophes d&#039;un dangereux peut-être &quot; qui devront désormais assumer l&#039;inflexible hypothèse de la vie comme &quot; volonté de puissance &quot;.', 'non dispo.'),
(39, 30, 'Les raisins de la colère', 'John Steinbeck', 'Le soleil se leva derrière eux, et alors... Brusquement, ils découvrirent à leurs pieds l&#039;immense vallée. Al freina violemment et s&#039;arrêta en plein milieu de la route.\r\n— Nom de Dieu ! Regardez ! s&#039;écria-t-il.\r\nLes vignobles, les vergers, la grande vallée plate, verte et resplendissante, les longues files d&#039;arbres fruitiers et les fermes. Et Pa dit :\r\n— Dieu tout-puissant !... J&#039;aurais jamais cru que ça pouvait exister, un pays aussi beau.\r\nTraduit de l&#039;anglais par Marcel Duhamel et M.-E- Coindreau', 'disponible');

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `conversation_id` int(11) NOT NULL,
  `user1_id` int(11) NOT NULL,
  `user2_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`conversation_id`, `user1_id`, `user2_id`, `created_at`) VALUES
(192, 28, 29, '2024-06-09 20:35:12');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `conversation_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`message_id`, `conversation_id`, `sender_id`, `receiver_id`, `message`, `sent_at`, `read_at`) VALUES
(525, 192, 28, 29, 'Bonjour Thomas, je suis très intéressé par ton livre &quot;Le rouge et le Noir&quot;. Est-il toujours disponible ?', '2024-06-09 20:35:12', '2024-06-09 22:49:55'),
(526, 192, 29, 28, 'Bonjour Julien ! Oui, il est disponible.', '2024-06-09 20:38:54', '2024-06-09 23:01:13'),
(527, 192, 29, 28, 'Donne moi ton adresse. Je te l&#039;enverrai dans les prochains jours !', '2024-06-09 20:40:46', '2024-06-09 23:01:13'),
(528, 192, 28, 29, 'Super ! J&#039;habite à Paris, au &quot;...&quot;. Merci beaucoup. N&#039;hésite pas à me dire si tu es intéressé par des livres que je partage :)', '2024-06-09 20:43:02', '2024-06-09 22:49:55'),
(529, 192, 29, 28, 'Ça marche, je regarderai ça. En te souhaitant une bonne soirée. À bientôt', '2024-06-09 20:46:07', '2024-06-09 23:01:13'),
(530, 192, 28, 29, 'Merci, à toi aussi !', '2024-06-09 20:49:38', '2024-06-09 22:49:55');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `pseudo`, `email`, `password`, `created_at`) VALUES
(28, 'julien', 'julien.test@hotmail.fr', '$2y$10$x7FG2xH4EJXmdafLYMeMXOKJWRPhgY9TMYe4UKV9gCKtqZD7D91M6', '2024-06-09 10:22:38'),
(29, 'thomas', 'thomas.test@hotmail.fr', '$2y$10$G2dOq4ZyXp9z4K3/Ez2IKennyJFMCi7fFv8mNAcTdr2Cmefp.ZFX2', '2024-06-09 10:22:38'),
(30, 'justine', 'justine.test@hotmail.fr', '$2y$10$QAnnN3cXJLDAAM1P40u8uOK6WVR4zQaNmOAxFrguQ5z3LKP08iS9m', '2024-06-09 10:22:38');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `link_book_user` (`user_id`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`),
  ADD KEY `user1_id` (`user1_id`),
  ADD KEY `user2_id` (`user2_id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=531;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `link_book_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user1_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `conversations_ibfk_2` FOREIGN KEY (`user2_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`conversation_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
