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
  `id` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `location_path` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(4) NOT NULL,
  `city` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


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
    `image_path` text NOT NULL,
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

INSERT INTO `location` (`id`, `address`, `location_path`, `zipcode`, `city`) VALUES
(1, 'Akershus Festning', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2000.4796902651954!2d10.734895316249968!3d59.90758598186492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e866d647ed3%3A0xaa290cda332eedba!2sAkershus+Fortress!5e0!3m2!1sen!2sno!4v1495920993729\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0150', 'Oslo'),
(2, 'Vulkan 20', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1999.6198749805346!2d10.749457716250479!3d59.921855781870114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e65bc6baa6f%3A0x62ac8d78c0e6cdc9!2sVulkan+20%2C+0175+Oslo!5e0!3m2!1sen!2sno!4v1495921113700\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0178', 'Oslo'),
(3, 'Karl Johans gate 31', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2000.083281291472!2d10.737689016250208!3d59.914165181867276!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e7d6eedb8b9%3A0xdd03aa63c95c9891!2sKarl+Johans+gate+31%2C+0159+Oslo!5e0!3m2!1sen!2sno!4v1495921059919\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0101', 'Oslo'),
(4, 'Middelthuns gate 28', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1999.2451213698325!2d10.705904116250718!3d59.92807468187232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416dc569a07975%3A0xcf0bf7f0dae15689!2sMiddelthuns+gate+28%2C+0368+Oslo!5e0!3m2!1sen!2sno!4v1495921141588\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0368', 'Oslo'),
(5, 'Oslo Rådhus', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2000.2047819507175!2d10.731536516250124!3d59.9121486818666!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e87392ca3a5%3A0x52f65653724888bc!2zUsOlZGh1c2V0!5e0!3m2!1sen!2sno!4v1495921168912\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0037', 'Oslo'),
(6, 'Kjelsåsveien 143', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1996.9353255600447!2d10.780527616252073!3d59.9663962818863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x464171e7ed1e997b%3A0xdea4421d7d285a7b!2sKjels%C3%A5sveien+143%2C+0491+Oslo!5e0!3m2!1sen!2sno!4v1495921189543\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0491', 'Oslo'),
(7, 'Vulkan 5', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1999.5981396856337!2d10.74985701625054!3d59.922216481870215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e65a294248f%3A0xf993f57b39780819!2sVulkan+5%2C+0182+Oslo!5e0!3m2!1sen!2sno!4v1495921220233\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0182', 'Oslo'),
(8, 'Hans Nilsen Hauges gate 44 ', '<<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1998.5766722553115!2d10.776572816251122!3d59.93916638187636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e3c23e45179%3A0x9a1ebfc4259c151!2sHans+Nielsen+Hauges+gate+44%2C+0481+Oslo!5e0!3m2!1sen!2sno!4v1495921247107\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0481', 'Oslo'),
(9, 'Christian Krohgs gate 32', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1999.9714370368206!2d10.757347216250277!3d59.916021381867935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e60c73e80af%3A0x7ce7048cd01f58c1!2sChr.+Krohgs+gate+32%2C+0186+Oslo!5e0!3m2!1sen!2sno!4v1495921268068\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0186', 'Oslo'),
(10, 'Maridalsveien 17', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1999.57838080567!2d10.750078516250507!3d59.922544381870345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e657e339ff9%3A0x32375917ea3f0b9c!2sMaridalsveien+17%2C+0175+Oslo!5e0!3m2!1sen!2sno!4v1495921300275\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0175', 'Oslo'),
(11, 'Arne Garborgs plass 4', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1999.9391764302281!2d10.744182716250293!3d59.91655678186815!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e63136220e7%3A0x824454b79bca0ea9!2sArne+Garborgs+plass+4%2C+0179+Oslo!5e0!3m2!1sen!2sno!4v1495921333892\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0179', 'Oslo'),
(12, 'Tollbugata 13', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2000.321942030203!2d10.743268516250094!3d59.91020418186593!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e89b2a413d9%3A0x9f357c68b491ca83!2sTollbugata+13%2C+0152+Oslo!5e0!3m2!1sen!2sno!4v1495921355245\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0152', 'Oslo'),
(13, 'Kirsten Flagstads pl. 1', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2000.4792504413062!2d10.750406116249955!3d59.90759328186489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416e8b0a8fc2e5%3A0x45a5b10a7115ed9f!2sKirsten+Flagstads+Plass+1%2C+0150+Oslo!5e0!3m2!1sen!2sno!4v1495921376488\" width=\"100%\" height=\"200\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', '0150', 'Oslo');



--
-- Loading data into table `organizer`
--

INSERT INTO `organizer` (`id`, `name`, `email`, `phone`) VALUES
(1, 'Oslo Middeladerfestival', 'post@oslomiddelalderfestival.org', '926 12 692'),
(2, 'Musikkfest Oslo', 'info@musikkfest.no', '99887766'),
(3, 'Grand Hotel', 'booking@grand.no', '23 21 22 00'),
(4, 'Norwegian Wood', 'festivalsjef@norwegianwood.no', '99667788'),
(5, 'Frelsesarmeen', 'post@frelsesarmeen.no', '22 99 85 00'),
(6, 'Teknisk museum, Oslo', 'kontakt@tekniskmuseum.no', '22 79 60 18'),
(7, 'Kulinarisk Akademi', 'tvp@kulinariskakademi.no\r\n', '21 39 55 72'),
(8, 'Oslo Kameraklubb', 'info@oslokameraklubb.no', '924 33 500'),
(9, 'Sjenkestua Studentbar', 'post@westerdals.no', '22 05 75 50'),
(10, 'Westerdals Oslo ACT', 'post@westerdals.no', '22 05 75 50'),
(11, 'Mathallen Oslo', 'post@mathallen.no', '40 00 12 09'),
(12, 'Stand up Grunerløkka', 'post@smelteverketoslo.no', '21 39 80 59'),
(13, 'Deichmanske Bibliotek', 'postmottak@deichmanske.zendesk.com', '21 80 21 80'),
(14, 'I love dancing', 'post@ilovedancing.no', '932 19 199'),
(15, 'Operahuset Oslo', 'post@operaen.no', '21422121');

--
-- Loading data into table `event`
--

INSERT INTO `event` (`id`, `name`, `date`, `time`, `location`, `age_limit`, `price`, `description`, `organizer`, 'image_path') VALUES
(1, 'Oslo Middelalderfestival', '2017-06-08', '13:00:00', 1, 0, 50.00, 'Tradisjonsrik festival på Akershus festning som tar dere tilbake i tid, til perioden da Oslo ble Norges hovedstad.\r\n\r\nOslo Middelalderfestival er underholdende folkefest for hele familien. Her kan dere oppdage historien og la dere underholde av spennende forestillinger, konserter, levende historie og en rekke aktiviteter for store og små.\r\n\r\nStort middelaldermarked med tilreisende håndverkere og selgere fra hele Europa.', 1, 'https://www.colourbox.com/preview/20085237-medieval-knight-prepared-to-the-battle.jpg'),
(2, 'Oslo Musikkfestival', '2017-06-03', '16:00:00', 2, NULL, 0.00, 'Gratis musikkfestival den første lørdagen i juni, når sommeren spilles inn med nærmere 40 utendørsscener, hundrevis av artister og et yrende liv i gatene. \r\n\r\nMusikkfest Oslo er en årlig feiring av musikken, og dagen har etter hvert utviklet seg til en av landets største festivaler. Artistene spiller i gater og parker, på plasser og torg, lett synlig i og rundt sentrum. \r\n\r\nMusikk innen de fleste sjangre;  rock, country og pop via elektronisk musikk og jazz til world music, korsang og norsk folkemusikk.', 2, 'https://www.colourbox.com/download/preview/id/15691392/ts/1495822921/auth/7a8ad5047246578985d411f2ac513285cdf19faf399e2cb0676c4be7912b380e'),
(3, 'Griegfestivalen', '2017-06-10', '18:00:00', 3, 18, 99.99, 'Opplev konsert med en av verdens fremste fiolinister, Arve Tellefsen, som akkompagneres på piano av Einar Steen-Nøkleberg i Rococosalen på Grand Hotel lørdag 10 Juni. Etter konserten serveres Griegs meny i Palmen Restaurant.\r\n \r\nPrisen er 1495,- per person.\r\nPrisen inkluderer, Konsert, aperitiff, vinpakke og treretters-middag.\r\n \r\nDette arrangementet er en del av Oslo Griegfestival, og er et samarbeid mellom festivalen og Grand Hotel.', 3, 'https://www.colourbox.com/download/preview/id/10455402/ts/1495822961/auth/08587036001539f3bc92481802c95cfa696fb0a1f4519a4f9022751b078ef02d'),
(4, 'Norwegian Wood', '2017-06-16', '18:00:00', 4, 18, 99.99, 'Årlig musikkfestival med store norske og internasjonale artister på programmet. Siden starten i 1992 har kjente navn som Bob Dylan, Neil Young, Foo Fighters, David Bowie, Roger Waters, Eric Clapton, Eagles og Lou Reed spilt på Norwegian Wood. ', 4, 'https://www.colourbox.com/download/preview/id/15514640/ts/1495823222/auth/f973c0cae6d98884cac9df38a3fa9673adf50830cb68353a4c0296404bac2898'),
(5, 'Fotoutstilling til inntekt for Frelsesarmeen – Rådhusgalleriet', '2017-06-02', '15:00:00', 5, 0, 50.00, 'Tema: Levd liv – portretter som viser livserfaring.\r\nÅpning: 19. mai kl 19:00 med premiere på 13 av 25 bilder.\r\nInntektene går til Frelsesarmeen.\r\nMer info og budrunde på: http://fotorune.com/\r\n\r\nRådhusgalleriet\r\nRådhusplassen 1, 0037 Oslo\r\nInngang fra sjøsiden.\r\nÅpent: man-søn kl 9-16', 5, 'https://www.colourbox.com/download/preview/id/22440845/ts/1495823613/auth/fe58c42bf18a5c6f69893d28b44d80398b8145d9c6cafccc850ec7a7032f668a'),
(6, 'Helgeprogram på Teknisk Museum', '2017-06-10', '10:00:00', 6, NULL, 99.00, 'I helgen kan du være med og lage en tegnerobot, se det forrykende vitenshowet og få en omvisning i utstillingen Grossraum.\r\nTeknisk museum byr på spennende og lærerike opplevelser spesielt for tilrettelagt for barn. Vitensenteret er nettopp utvidet og er nå på hele 2130 kvm. Her kan barn boltre seg med lekende læring innenfor en lang rekke områder. Hver helg er det spesielle og varierte programmer for både små og store.\r\nLag en tegnerobot, se det forrykende vitenshowet, og få en omvisning i den nye utstillingen Grossraum – om tvangsarbeidet i Norge under andre verdenskrig.', 6, 'https://www.colourbox.com/download/preview/id/23988857/ts/1495824936/auth/ffa091a43e9ff0dd66f9397e67eb187b4c68b6578104e81c72a0495938f77d82'),
(7, 'Kurs i Street Food', '2017-06-15', '17:00:00', 7, NULL, 99.99, 'Kurset er et deltagende kokkekurs der du får veiledning gjennom alle rettene og de teoretiske prinsipper om den voksende street food-trenden. Dere får innblikk gjennom kveldens meny som er steam buns med char Sui-ribbe,¨Pibil¨ taco, satay, bulgogi, ceviche «lechede Tigre», ramen og sist men ikke minst churros til dessert. Menyen kan variere noe. Maten smakes på underveis i kurset og alle spiser det de selv har laget.', 7, 'https://www.colourbox.com/download/preview/id/24174761/ts/1495825256/auth/ecab8f22c806bffef22113c800fb1c462a9badb50c2ed39c2d31bf24a223728d'),
(8, 'Kurs i Makrofotografering', '2017-06-04', '17:30:00', 8, NULL, 99.99, 'Dette er et rent praktisk fotokurs i makrofotografering over to kvelder med Terje Skåre. Når man går tett på motivet dukker en helt ny og spennende verden opp, et univers med et nesten uendelig antall muligheter for forskjellige bilder. Blomster, insekter, rustflekker eller hva som helst – konkret eller abstrakt – dokumenterende eller kunstnerisk – valget er ditt. Slipper man kreativiteten løs og jobber kunstnerisk med makrofotografering glemmer man rett og slett tid og sted!', 8, 'https://www.colourbox.com/download/preview/id/2486555/ts/1495825549/auth/eefea8c3b343d4e5810aef8a4dbc969966eb20b6c6d491fde5d60e52d12da9ec'),
(9, 'Westerdals Sommerfest', '2017-06-15', '21:00:00', 9, 18, 0.00, 'HÆLLÆ!! Torsdag 15. JUNI blir det sommerfest for alle på Westerdals Oslo ACT! På dagen blir det avgangssermoni på Sentrum Scene og på kvelden blir det FEST på FJERDINGEN!!\r\n\r\n\r\nMer info kommer!', 9, 'https://www.westerdals.no/content/uploads/2014/12/Logo.jpg'),
(10, 'Bachelorutstilling kommunikasjon', '2017-06-10', '13:00:00', 9, NULL, 0.00, 'Bachelorkandidater fra Art Direction, Experience and Event Design, Grafisk Design og Retail Design inviterer til avgangsutstilling 10.-13. juni på Campus Fjerdingen.\r\n\r\nVelkommen til åpning av utstillingen lørdag 10. juni kl. 13:00 hos Westerdals Oslo ACT, Campus Fjerdingen.\r\n\r\nUtstillingen er åpen for alle.\r\n\r\nVelkommen!', 10, 'https://www.westerdals.no/content/uploads/2017/05/bachelorutstilling-e1494941224471-960x540.jpg'),
(11, 'BIFF OG BAYER', '2017-06-05', '17:00:00', 7, 18, 99.99, 'Det blir en demonstrasjon der vi forklarer forskjellen på ulike stykningsdeler av storfe og tilberedningsmetoder. Du får kunnskap om fire ulike stykningsdeler som kan kjøpes i butikken, entrecôte,indrefilet, mørbrad og høyrygg, altså tre filetstykker og en til langtidssteking.\r\n\r\nEtter demonstrasjonen steker du selv kjøtt og lager ulike sauser som passer perfekt til. Dette smakes på underveis, med passende garnityr som kokkene har forberedt. Vi avslutter med å lage, så spise den ultimate biffretten med øl som passer til.', 11, 'https://www.colourbox.com/download/preview/id/11018114/ts/1495826454/auth/6702eaf12410c66b02b24b587b66995a8acacc149f82ee2227c30915e996a316'),
(12, 'Burger Battle', '2017-06-01', '14:00:00', 7, NULL, 80.00, 'I anledning den internasjonale burgerdagen inviterer Hellmann’s til Hank’s Burger Battle!\r\n\r\nTre kjente norske matbloggere og en heldig deltaker fra publikum skal kjempe om å lage den beste burgeren. Eneste kriteriet: Hellmann’s majones må være en del av oppskriften.', 11, 'https://www.colourbox.com/download/preview/id/11631557/ts/1495826732/auth/724d08f59fd843a08ef1251c28fc4be95f3bbc3c913bc6a4ba0ab4a431fc1426'),
(13, 'Stand-up Grunerløkka: Seriøst?', '2017-06-01', '20:00:00', 10, 18, 0.00, 'SERIØST? er et komediekonsept som tar for seg ekte mennesker, som forteller ekte historier. Hver komiker/personlighet går på scenen og forteller en historie hver! \r\n\r\nLine-up:\r\nBjørn Daniel Tørum\r\nLaurits Lundgaard\r\nAleksander Bastiansen\r\nSondre Stømer\r\n\r\nHosts: \r\nAnders Lohne Fosse\r\n\r\nCC: Gratis', 12, 'https://www.colourbox.com/download/preview/id/20468273/ts/1495827234/auth/ffd00710a8d2e916fbf30a76621383ddd751c2a1c31351193782d6a5607aaeab'),
(14, 'FUTURE LIBRARY: SAMTALE MED SJN', '2017-06-02', '16:00:00', 11, NULL, 0.00, 'Samtale med forfatter Sjn, ledet av Rob Young, på Deichmanske hovedbibliotek.\r\n\r\nDen prisbelønte forfatteren Sjn (Island) er den tredje forfatteren som leverer et manuskript til kunstverket Framtidsbiblioteket. Tidligere bidragsytere er David Mitchell og Margaret Atwood.\r\n\r\nSjn (Sigurjn Birgir Sigursson) er en forfatter som beveger seg på tvers av medier og sjangre.\r\nI 2005 vant han Nordisk Råds Litteraturpris for romanen Skugga-Baldur. Han skriver poesi, librettoer, filmmanus og sangtekster. Han har blant annet samarbeidet med Lars Von Trier og Björk.', 13, 'https://www.colourbox.com/download/preview/id/5871092/ts/1495827533/auth/f496091ecc4e1e403c427423a87cd41d7b4f53f82ce69d7138f948785d39b5f6'),
(15, 'Fiksefest for elektronikk', '2017-06-06', '15:00:00', 9, NULL, 0.00, 'Sammen med Restarters Oslo arrangerer Westerdals Makerspace fiksefest for elektronikk.\r\n\r\nEn Fiksefest er et sosialt arrangement der du kan fikse din ødelagte små-elektronikk sammen med flinke Fiksere (frivillige med tekniske ferdigheter).\r\n\r\nTa med deg noe du ønsker å reparere, alt fra smarttelefoner, laptoper, radioer og andre elektroniske dingser som har gått i stykker er velkomne.', 10, 'https://www.colourbox.com/download/preview/id/23411400/ts/1495827703/auth/bf9f47249558c8b9f878c74035d0070064634d3ca2bd5cc42c6ebe1f475112b1'),
(16, 'Dansekurs i Oslo sentrum!', '2017-06-05', '17:30:00', 12, NULL, 79.99, 'We are Reyza and Karina. We are owners and directors of I Love Dancing! We are delighted to run Norway’s first and longest existing dance school for urban dances.\r\n\r\nI Love Dancing is also the most complete Latin dance school in the Norwegian capital. We are also the longest existing Latin entertainment company in the country.', 14, 'https://www.colourbox.com/download/preview/id/3934301/ts/1495828026/auth/b19ac716f74bf6f37aa510d2f574a4bf3b6b70aa9e9d378ab41713f6ae6d3e38'),
(17, 'Omvisning i Operaen', '2017-06-01', '12:00:00', 13, NULL, 0.00, 'Omvisning i Den Norske Opera & Ballett i Bjørvika, Norges største musikk- og scenekunstinstitusjon. Operahuset er tegnet av det norske arkitektfirmaet Snøhetta, og er det første operahuset i verden hvor du kan gå på taket. \r\n\r\nPå en omvisning i Operaen får man et innblikk i det som skjer bak scenen før teppet går opp. Dyktige omvisere forteller om arkitektur og sceneteknikk, opera og ballett. Varighet: ca. 50 minutter.', 15, 'https://www.colourbox.com/download/preview/id/18205275/ts/1495828242/auth/f2bc1cdbc2dc7efe0af8d80cea339073490906ea9052785eacbbb3758f7dec71'),
(18, 'Årets kokk 2017', '2017-06-12', '12:00:00', 7, NULL, 0.00, 'Det er duket for finalen i Årets kokk 2017 og vi gleder oss til å ta imot de fem finalekandidatene og alle kokker, fans og matentusiaster som vil få med seg dette. Vinneren av konkurransen får anledning til å representere Norge i Bocuse d’Or Europe i Torino i 2018, og i Bocuse d’Or i Lyon i januar 2019.\r\n\r\nI Årets kokk-finalen for to år siden var det Christopher William Davidsen som endte øverst på pallen, og gleden var stor da han også endte opp med sølv i Lyon i 2017.\r\n\r\nDe fem kandidatene til Årets Kokk 2017 er Geir Magnus Svae, Rasmus Johnsen Skoglund, Øyvind Bøe Dalelv, Filip August Bendi og Christian André Pettersen.', 7, 'https://www.colourbox.com/download/preview/id/11881416/ts/1495828468/auth/952750b20e46c66ac47b5d18ed6f7875728416ddb08820fafdc45a440eab90a3');


--
-- Loading data into table `tag`
--

INSERT INTO `tag` (`name`, `description`) VALUES
('Fritid', 'Diverse fritidsarragementer.'),
('Kultur', 'Utforsk kulturen i Oslo!'),
('Lærerikt', 'Lærerike arrangementer.'),
('Mat', 'Få med deg det siste innen mat.'),
('På skolen', 'Få med deg hva som skjer med på skolen!'),
('Uteliv', 'Oppdag utelivet i Oslo!');

--
-- Loading data into table `event_tag`
--

INSERT INTO `event_tag` (`event`, `tag`) VALUES
(1, 'Fritid'),
(6, 'Fritid'),
(17, 'Fritid'),
(3, 'Kultur'),
(5, 'Kultur'),
(14, 'Kultur'),
(7, 'Lærerikt'),
(8, 'Lærerikt'),
(16, 'Lærerikt'),
(11, 'Mat'),
(12, 'Mat'),
(18, 'Mat'),
(9, 'På skolen'),
(10, 'På skolen'),
(15, 'På skolen'),
(2, 'Uteliv'),
(4, 'Uteliv'),
(13, 'Uteliv');


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