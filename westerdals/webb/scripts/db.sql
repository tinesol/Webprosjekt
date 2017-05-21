--
-- This script creates a database and populates the tables
-- with data.

-- --------------------------------------------------------
-- Create database
-- --------------------------------------------------------

--
-- Create database 'leanh16_gruppeprosjekt_v17'
--

-- CREATE DATABASE `webb` 
--    DEFAULT CHARACTER SET utf8
--    DEFAULT COLLATE utf8_danish_ci;

-- --------------------------------------------------------
-- Create tables
-- --------------------------------------------------------

--
-- Create table `location`
--

CREATE TABLE `location` (
    `id` int AUTO_INCREMENT NOT NULL,
    `address` varchar(50) NOT NULL,
    `zipcode` varchar(4) NOT NULL,
    `city` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
);

--
-- Create table `organizer`
--

CREATE TABLE `organizer` (
    `id` int AUTO_INCREMENT NOT NULL,
    `name` varchar(50) NOT NULL,
    `email` varchar(100) NOT NULL,
    `phone` varchar(20) NOT NULL,
    PRIMARY KEY (`id`)
);

--
-- Create table `event`
--

CREATE TABLE `event` (
    `id` int AUTO_INCREMENT NOT NULL,
    `name` varchar(255) NOT NULL,
    `date` date NOT NULL,
    `time` time NOT NULL,
    `location` int NOT NULL,
    `age_limit` tinyint(4) DEFAULT NULL,
    `price` double(4,2) NOT NULL,
    `description` longtext,
    `organizer` int NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`location`) 
            REFERENCES `location`(id)
            ON DELETE CASCADE,
    FOREIGN KEY (`organizer`) 
            REFERENCES `organizer`(id)
            ON DELETE CASCADE
);

--
-- Create table `tag`
--

CREATE TABLE `tag` (
    `name` varchar(255) NOT NULL,
    `description` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`name`)
);

--
-- Create table `event_tag`
--

CREATE TABLE `event_tag` (
    `event` int NOT NULL,
    `tag` varchar(255) NOT NULL,
    PRIMARY KEY (`event`, `tag`),
    FOREIGN KEY (`event`) 
            REFERENCES `event`(`id`)
            ON DELETE CASCADE,
    FOREIGN KEY (`tag`) 
            REFERENCES `tag`(`name`)
            ON DELETE CASCADE
);

--
-- Create table `user`
--

CREATE TABLE `user` (
    `username` varchar(20) NOT NULL,
    `name` varchar(255) NOT NULL,
    `email` varchar(50) NOT NULL,
    `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
    `group` varchar(20) NOT NULL,
    PRIMARY KEY (`username`)
);

--
-- Create table `event_registration`
--

CREATE TABLE `event_registration` (
    `event` int NOT NULL,
    `user` varchar(20) NOT NULL,
      PRIMARY KEY (`event`, `user`),
      FOREIGN KEY (`event`) 
              REFERENCES `event`(`id`)
              ON DELETE CASCADE,
      FOREIGN KEY (`user`) 
              REFERENCES `user`(`username`)
              ON DELETE CASCADE
);

-- --------------------------------------------------------
-- Populates tables
-- --------------------------------------------------------

--
-- Loading data into table `location`
--

INSERT INTO `location` (`id`, `address`, `zipcode`, `city`) VALUES
(1, 'Kirsten Flagstads pl. 1', '0150', 'Oslo'),
(2, 'Sonja Henies Plass 2', '0185', 'Oslo'),
(3, 'Hele Oslo', '0000', 'Oslo'),
(4, 'Landgangen 1', '0252', 'Oslo'),
(5, 'Vulkan 12', '0178', 'Oslo'),
(6, 'Maridalsveien 13', '0178', 'Oslo'),
(7, 'Karl Johans gate 17 ', '0159', 'Oslo'),
(8, 'Holmens Gate 1', '0250', 'Oslo');

--
-- Loading data into table `organizer`
--

INSERT INTO `organizer` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Operaen', 'post@operaen.no', '21422100'),
(2, 'Oslo Spektrum', 'robert@oslospektrum.no', '22002900'),
(3, 'Radiohead', 'robert@oslospektrum.no', '22052900'),
(4, 'Msuikkfest i Oslo', 'info@musikkfest.no', '22121017'),
(5, 'THIEF - Music Unplugged', 'music@thethief.com', '24004000'),
(6, 'Quiz på Døgnvill', 'post@dognvillburger.no', '21385010'),
(7, 'Quiz på Pokalen', 'post@pokalenpub.no', '40147129'),
(8, 'Quiz på The Scotsman', 'firmapost@scotsman.no', '22474477'),
(9, 'Sommer Stand Up - Latter', 'mail@latter.no', '23118800'),
(10, 'Ross Noble', 'mail@latter.no', '23118800');

--
-- Loading data into table `event`
--

INSERT INTO `event` (`id`, `name`, `date`, `time`, `location`, `age_limit`, `price`, `description`, `organizer`) VALUES
(1, 'Guided tours of the Opera House in Bjørvika', '2017-06-12', '13:00:00', 1, 0, 99.99, 'The Opera House in Bjørvika is designed by the Norwegian architecture firm Snøhetta. \r\nThe Opera House is the first in the first in the world that lets you walk on the roof.\r\n\r\nThe tours give you a chance to learn more about the architecture and catch a glimpse of life backstage', 1),
(2, 'Ekstrakonsert med 90-tallets store britiske rockehelter i Radiohead.', '2017-06-16', '19:30:00', 2, 18, 99.99, 'På nittitallet satte Radiohead standarden for britisk rock, og albumene Pablo Honey (1992), The Bends (1995) og ikke minst OK Computer (1997) førte bandet til topps på både salgslister og \"årets beste album\"-kåringer.  \r\n\r\nMed oppfølgerne Kid A (2000), Amnesiac (2001), Hail to the Thief (2003), In Rainbows (2007), The King of Limbs (2011) og A Moon Shaped Pool (2016) har Radiohead befestet sin legendestatus og samtidig utfordret både seg selv og sine fans med nye uttrykk.\r\nTil sommeren skal de spille for 150 000 tilskuere som headlinere på Glastonbury, men først: to konserter i Oslo!', 3),
(3, 'Musikkfestival', '2017-06-07', '12:00:00', 3, 0, 0.00, 'Gratis musikkfestival den første lørdagen i juni, når sommeren spilles inn med nærmere 40 utendørsscener, hundrevis av artister og et yrende liv i gatene. \r\n\r\nMusikkfest Oslo er en årlig feiring av musikken, og dagen har etter hvert utviklet seg til en av landets største festivaler. Artistene spiller i gater og parker, på plasser og torg, lett synlig i og rundt sentrum. \r\n\r\nMusikk innen de fleste sjangre;  rock, country og pop via elektronisk musikk og jazz til world music, korsang og norsk folkemusikk.', 4),
(4, 'Bohem konsert', '2017-06-08', '18:00:00', 4, 18, 0.00, 'Bohem er en rocketrio fra Stavanger som leverer gode melodier, fengende hooks og minneverdige refreng.\r\n\r\nArtister for øvrige datoer annonseres senere.  \r\n \r\nKonsertene har gratis inngang men begrenset med plasser - førstemann til mølla-prinsippet gjelder.\r\nFor oppdateringer og mer informasjon, følg THIEF Music Unpluggeds Facebook-side.', 5),
(5, 'Allmenn- og musikkquiz', '2017-06-06', '21:00:00', 5, 0, 50.00, 'Allmenn- og musikkquiz på Døgnvill Vulkan hver tirsdag!', 6),
(6, 'Populærkulturquiz', '2017-06-07', '18:30:00', 6, 0, 50.00, 'Populærkulturquiz på Pokalen ved Vulkan, hver torsdag klokken 18:30.\r\n50kr pr deltager.', 7),
(7, 'Allmennquiz', '2017-06-08', '18:00:00', 7, 18, 50.00, 'Allmennquiz på The Scotsman hver torsdag.\r\nAldersgrense: 18 år.\r\nPris pr deltager: 50kr.', 8),
(8, 'Standup', '2017-06-01', '19:00:00', 8, 18, 99.99, 'Tors 1. juni kl. 19:00\r\nChristoffer Schjelderup\r\nHenrik Farley\r\nVidar Hodnekvam \r\nDex Carrington\r\nKonf: Ørjan Burøe\r\n\r\nI bakgården på Latter kan dere nyte både mat, drikke og underholdning hele sommeren!\r\nFra mai til august åpner vi dørene og inviterer til Stand Up i bakgården, tirsdag til lørdag hver uke.\r\nDet blir nye, morsomme komikere hver uke som vil holde temperaturen oppe uansett vær. Hjertelig velkommen!', 9),
(9, 'Standup', '2017-06-02', '19:00:00', 8, 18, 99.99, 'Fre 2. juni kl. 19:00\r\nChristoffer Schjelderup\r\nHenrik Farley\r\nVidar Hodnekvam \r\nDex Carrington\r\nKonf: Ørjan Burøe', 9),
(10, 'Standup', '2017-06-03', '19:00:00', 8, 18, 99.99, 'Lør 3. juni kl. 19:00\r\nChristoffer Schjelderup\r\nHenrik Farley\r\nVidar Hodnekvam \r\nDex Carrington\r\nKonf: Ørjan Burøe', 9),
(11, 'Standup', '2017-06-06', '19:00:00', 8, 18, 99.00, 'Tirs 6. juni kl. 19:00\r\nTBA\r\nMartin Lepperød\r\nMaria Stavang\r\nMartin Beyer-Olsen\r\nKonf: Thomas Leikvoll', 9),
(12, 'Standup', '2017-06-02', '21:00:00', 8, 20, 50.00, 'Mick Perrin Worldwide proudly present\r\n\r\nDEBUT EUROPEAN TOUR OF \'BRAIN DUMP\'\r\nCOMEDY LEGEND ROSS NOBLES 15TH CRITICALLY ACCLAIMED\r\nSTAND-UP SHOW\r\n\r\nAfter sell-out runs in both the UK and Australia, award-winning comedy legend Ross Noble will be bringing his hit show Brain Dump to locations across Europe. Famed for being the comic master of surreal tangents, the British household name will be touring mainland Europe and Scandinavia this Spring with his 15th critically-acclaimed stand-up show, Brain Dump. Ross will be visiting Denmark, The etherlands, Belgium, Sweden, Switzerland and Norway across nine dates in May and June this year.', 10);

--
-- Loading data into table `tag`
--

INSERT INTO `tag` (`name`, `description`) VALUES
('Festival', NULL),
('Komiker', NULL),
('Konsert', NULL),
('Quiz', NULL),
('Sightseeing', NULL);

--
-- Loading data into table `event_tag`
--

INSERT INTO `event_tag` (`event`, `tag`) VALUES
(3, 'Festival'),
(9, 'Komiker'),
(10, 'Komiker'),
(11, 'Komiker'),
(12, 'Komiker'),
(2, 'Konsert'),
(4, 'Konsert'),
(5, 'Quiz'),
(6, 'Quiz'),
(7, 'Quiz'),
(1, 'Sightseeing');

--
-- Loading data into table `user`
--

INSERT INTO `user` (`username`, `name`, `email`, `password`, `group`) VALUES
('anhqle', 'Anh Quoc Le', 'anhqle@student.westerdals.no', '$2y$10$w/bKbJDc984zHE09.lP7gORUcuRsLhlZWw6A8EZY.l5NPi4y3tBDm', 'student'),
('ngaletl', 'Nga Le Thi Le', 'ngaletl@student.westerdals.no', '$2y$10$iWhoGcoMf2ohxCxiVRBny.68.wYLn/XdztvmNe3MHPtuMGK/SiaqC', 'student'),
('uddtru16', 'Truls Nilsen', 'uddtru16@student.westerdals.no', '$2y$10$qmCIqifLrGPy6cA7q67mHeAxHEagWSqUfAPhC9WBdyF0erX3okXia', 'admin');

--
-- Loading data into table `event_registration`
--

INSERT INTO `event_registration` (`event`, `user`) VALUES
(5, 'anhqle'),
(1, 'ngaletl'),
(8, 'ngaletl');