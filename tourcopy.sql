-- --------------------------------------------------------
-- Hoszt:                        127.0.0.1
-- Szerver verzió:               10.4.24-MariaDB - mariadb.org binary distribution
-- Szerver OS:                   Win64
-- HeidiSQL Verzió:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Adatbázis struktúra mentése a turak.
CREATE DATABASE IF NOT EXISTS `turak` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `turak`;

-- Struktúra mentése tábla turak. admin
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_uid` tinytext DEFAULT NULL,
  `admin_pwd` longtext DEFAULT NULL,
  `admin_email` longtext DEFAULT NULL,
  PRIMARY KEY (`admin_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Tábla adatainak mentése turak.admin: ~1 rows (hozzávetőleg)
INSERT INTO `admin` (`admin_id`, `admin_uid`, `admin_pwd`, `admin_email`) VALUES
	(1, 'Admin', '$2y$10$dbH69yjxDWC4ZbEWCz4BCeu7W0eQpakeFxBx2922x/q4xBICBWiby', 'admin@admin.com');

-- Struktúra mentése tábla turak. cimke_has_leiras
CREATE TABLE IF NOT EXISTS `cimke_has_leiras` (
  `cimkek_id` int(11) NOT NULL,
  `tura_leirasok_id` int(11) NOT NULL,
  PRIMARY KEY (`cimkek_id`,`tura_leirasok_id`),
  KEY `fk_cimkek_has_tura_leirasok_tura_leirasok1_idx` (`tura_leirasok_id`),
  KEY `fk_cimkek_has_tura_leirasok_cimkek1_idx` (`cimkek_id`),
  CONSTRAINT `fk_cimkek_has_tura_leirasok_cimkek1` FOREIGN KEY (`cimkek_id`) REFERENCES `tura_cimkek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_cimkek_has_tura_leirasok_tura_leirasok1` FOREIGN KEY (`tura_leirasok_id`) REFERENCES `tura_leirasok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Tábla adatainak mentése turak.cimke_has_leiras: ~35 rows (hozzávetőleg)
INSERT INTO `cimke_has_leiras` (`cimkek_id`, `tura_leirasok_id`) VALUES
	(1, 57),
	(1, 58),
	(1, 63),
	(1, 65),
	(1, 66),
	(1, 68),
	(1, 69),
	(2, 66),
	(2, 69),
	(3, 58),
	(3, 63),
	(3, 64),
	(3, 65),
	(3, 68),
	(4, 62),
	(4, 64),
	(5, 58),
	(5, 62),
	(5, 63),
	(5, 64),
	(5, 65),
	(6, 57),
	(6, 64),
	(7, 57),
	(7, 65),
	(7, 66),
	(7, 68),
	(7, 69),
	(8, 63),
	(8, 66),
	(8, 68),
	(9, 68),
	(10, 68),
	(11, 58),
	(11, 68);

-- Struktúra mentése tábla turak. turak
CREATE TABLE IF NOT EXISTS `turak` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nev` varchar(255) NOT NULL,
  `teljesitesi_ido` int(11) NOT NULL,
  `tura_hossz` int(11) NOT NULL,
  `tura_helyszinek_id` int(11) NOT NULL,
  `tura_kepek_id` int(11) NOT NULL,
  `tura_szintek_id` int(11) NOT NULL,
  `tura_tipusok_id` int(11) NOT NULL,
  `tura_leirasok_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`tura_kepek_id`,`tura_szintek_id`,`tura_tipusok_id`),
  KEY `fk_turak_tura_helyszinek_idx` (`tura_helyszinek_id`),
  KEY `fk_turak_tura_kepek1_idx` (`tura_kepek_id`),
  KEY `fk_turak_tura_szintek1_idx` (`tura_szintek_id`),
  KEY `fk_turak_tura_tipusok1_idx` (`tura_tipusok_id`),
  KEY `fk_turak_tura_leirasok1_idx` (`tura_leirasok_id`),
  CONSTRAINT `FK_turak_tura.tura_kepek` FOREIGN KEY (`tura_kepek_id`) REFERENCES `tura_kepek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_turak_tura_helyszinek` FOREIGN KEY (`tura_helyszinek_id`) REFERENCES `tura_helyszinek` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turak_tura_leirasok1` FOREIGN KEY (`tura_leirasok_id`) REFERENCES `tura_leirasok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_turak_tura_szintek1` FOREIGN KEY (`tura_szintek_id`) REFERENCES `tura_szintek` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_turak_tura_tipusok1` FOREIGN KEY (`tura_tipusok_id`) REFERENCES `tura_tipusok` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

-- Tábla adatainak mentése turak.turak: ~9 rows (hozzávetőleg)
INSERT INTO `turak` (`id`, `nev`, `teljesitesi_ido`, `tura_hossz`, `tura_helyszinek_id`, `tura_kepek_id`, `tura_szintek_id`, `tura_tipusok_id`, `tura_leirasok_id`) VALUES
	(59, 'Vízitúra a Tihanyi-félsziget körül', 41, 11, 2, 50, 2, 1, 57),
	(60, 'A búbos vöcsök nyomában – kis-balatoni séta', 2, 2, 3, 51, 1, 2, 58),
	(63, 'Túra a Nagypartosi tanösvényen', 3, 5, 5, 54, 2, 2, 62),
	(64, 'Kalandozás a Badacsony tetején', 3, 8, 1, 55, 2, 2, 63),
	(65, 'Vízitúra a jégmadár nyomában, a Fekete-vízen', 4, 9, 4, 56, 1, 1, 64),
	(66, 'A Nivegy-völgy kincsei', 3, 8, 1, 57, 2, 2, 65),
	(67, 'Barangolások a Káli-medencében', 5, 41, 1, 58, 2, 3, 66),
	(69, 'Csúcshódító túra a Zengőre', 4, 11, 4, 60, 2, 2, 68),
	(70, 'Egy csipet bringás Toszkána a Balaton fölött', 6, 77, 2, 61, 3, 3, 69);

-- Struktúra mentése tábla turak. tura_cimkek
CREATE TABLE IF NOT EXISTS `tura_cimkek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cimke_nev` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Tábla adatainak mentése turak.tura_cimkek: ~11 rows (hozzávetőleg)
INSERT INTO `tura_cimkek` (`id`, `cimke_nev`) VALUES
	(1, 'Szép kilátás'),
	(2, 'Kerékpártúra'),
	(3, 'Család- és gyerekbarát'),
	(4, 'Különleges élővilág'),
	(5, 'Kirándulások 10 km alatt'),
	(6, 'Vízitúra'),
	(7, 'Kultúrális/történelmi értékek'),
	(8, 'Körtúra'),
	(9, 'Kilátó'),
	(10, 'Kirándulások 15 km alatt'),
	(11, 'Gyalogtúra');

-- Struktúra mentése tábla turak. tura_helyszinek
CREATE TABLE IF NOT EXISTS `tura_helyszinek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lokacio` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Tábla adatainak mentése turak.tura_helyszinek: ~5 rows (hozzávetőleg)
INSERT INTO `tura_helyszinek` (`id`, `lokacio`) VALUES
	(1, 'Balaton-felvidék'),
	(2, 'Balaton'),
	(3, 'Kis-Balaton'),
	(4, 'Mecsek-Villány-Zselic'),
	(5, 'Mezőföld és Dunamente');

-- Struktúra mentése tábla turak. tura_jelentkezes
CREATE TABLE IF NOT EXISTS `tura_jelentkezes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vezeteknev` varchar(45) NOT NULL,
  `keresztnev` varchar(45) NOT NULL,
  `email` longtext NOT NULL,
  `telefonszam` varchar(50) NOT NULL DEFAULT '0',
  `fo` int(11) NOT NULL,
  `tura_neve` longtext NOT NULL,
  `jelentkezes_datuma` datetime DEFAULT NULL,
  `jelentkezes` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- Tábla adatainak mentése turak.tura_jelentkezes: ~2 rows (hozzávetőleg)
INSERT INTO `tura_jelentkezes` (`id`, `vezeteknev`, `keresztnev`, `email`, `telefonszam`, `fo`, `tura_neve`, `jelentkezes_datuma`, `jelentkezes`) VALUES
	(75, 'Kiss', 'Admin', 'kiss3@ez.com', '06301234567', 3, '60', '2022-08-28 14:37:21', 'jelentkezés'),
	(79, 'Első', 'Péter', 'r@f.com', '06301234567', 3, '67', '2022-08-29 13:09:49', 'jelentkezés');

-- Struktúra mentése tábla turak. tura_kepek
CREATE TABLE IF NOT EXISTS `tura_kepek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kep_nev` varchar(255) NOT NULL,
  `kep_cim` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;

-- Tábla adatainak mentése turak.tura_kepek: ~9 rows (hozzávetőleg)
INSERT INTO `tura_kepek` (`id`, `kep_nev`, `kep_cim`) VALUES
	(50, 'tihany.webp', 'Tihanyi félsziget'),
	(51, 'kisbalaton.jpg', 'Kis-balaton'),
	(54, 'cserelni.jpg', 'le kell cserélni'),
	(55, 'badacsony.jpg', 'badacsony'),
	(56, 'feketeviz.jpg', 'vízitúra a Fekete-vízben'),
	(57, 'nivegyvolgy.jpg', 'nivegy.völgy'),
	(58, 'kalimedence.jpg', 'Káli medence'),
	(60, 'zengo.jpg', 'zengő hegy'),
	(61, 'balatonitoszkana.jpg', 'kerékpár túra');

-- Struktúra mentése tábla turak. tura_leirasok
CREATE TABLE IF NOT EXISTS `tura_leirasok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leiras` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- Tábla adatainak mentése turak.tura_leirasok: ~9 rows (hozzávetőleg)
INSERT INTO `tura_leirasok` (`id`, `leiras`) VALUES
	(57, 'Ezen a vízitúrán felfedezheted a Tihanyi-félsziget minden oldalát: kajakba szállva vagy éppen SUP-deszkára állva Magyarország egyik legszebb vidékét szemlélheted meg új perspektívából. A Tihanyi-félsziget keleti vállán, Gödrös településrészen bérelhetsz kajakot vagy SUP-ot, majd az apátság irányába indulhat az evezés. Tudtad, hogy a Balaton vizének színe nem mindenhol egyforma? Míg a nyugati részen, Keszthelynél inkább barnás árnyalatok jellemzik a vizet, Tihanynál sokszor vakítóan kék, türkizes színekben pompázik a magyar tenger. Ennek oka a vízben található szerves és szervetlen anyagok aránya, és ez a színváltás a vízről még lélegzetelállítóbb látványt nyújt, mint a partról. A tihanyi révnél fokozott figyelemmel kelj át a sűrűn közlekedő szántódi kompnak elsőbbséget adva, majd a túra legszebb része következik, hiszen Sajkod felé evezve nem nyaralók és lakóházak szegélyezik a partot, hanem a táj eredeti állapotát még megőrző erdő nyúlik a vízig. A gazdag madárvilággal rendelkező, egyedülálló hangulatot árasztó partszakasz mellett illő csendben evezz végig, mert itt tényleg részévé válsz a természetnek. A feletted emelkedő félsziget partja a kedves kis sajkodi strandhoz vezet, ahol érdemes megállnod egy fürdésre, ebédre, de a túra innen akár Örvényesig is meghosszabbítható. (A túrára ne felejts el mentőmellényt vinni magaddal!)'),
	(58, 'A szigeten található Búbos vöcsök tanösvény kis ablakot nyit a fokozottan védett Kis-Balatonra. Az egész évben látogatható szigetet minden évszakban érdemes megnézni. Fekete István regénybe vésett tája türelmes szemlélődéssel és kis szerencsével felfedi előttünk páratlan élővilágát. A könnyű séta két kilátót, számos tűzrakóhellyel és játszóteret is felfűz. Aki teheti, vigyen magával távcsövet! Szükséges némi költséggel a parkoló használatáért számolni. A nyári időszakban szúnyogok is társaink lesznek az úton.\r\n\r\nA leggyakoribb megfigyelhető fajok közül, kiemelendő a tanösvény névadója a búbos vöcsök, számos gémféle vagy a kárókatona. Érdemes szemlélődni, időzni a vízparton, mert bármikor felbukkanhat egyikük. Néha egy vidra dugja ki a fejét a vízből, vagy nagyot csobban egy hal. A part mentén gyakoriak a békák és a szitakötők. A változatos parkerdős környezet jól jön a nyári kánikulában. Az élővilággal való találkozást legnagyobb eséllyel a reggeli és a délutáni órák biztosíthatják.'),
	(62, 'A Nagypartosi tanösvénynek a Duna-Dráva Nemzeti Park Béda-Karapancsa tájegysége ad otthont, amely a Duna magyarországi alsó szakaszának kiemelkedő értéket képviselő élőhelyeit foglalja magába. Ez hazánk rétisasok és fekete gólyák által egyik legsűrűbben lakott területe. A háborítatlan ártéri erdők mélyén zavartalanul pihennek meg a vízimadarak, a ligeterdőkben szebbnél szebb virágok bontják szirmaikat. A réten szürkemarha gulya legelészik, a vizeken tündérrózsák pompáznak. Az itt kialakult sajátságos élővilágnak, mint életközösségnek – beleértve az erdőket, rovarokat, madarakat, halakat, még magát az embert is, egyszóval mindent – legfőbb mozgatórugója, lelke a Duna folyó, ezen alapszik az ártéri élet.\r\n\r\nA tanösvény útvonala a fokozottan védett Nagy-rét peremétől a Dunáig vezet. Az ismertető táblák és a szakvezetés segítségével megismerhetjük az ártér működését, ízelítőt kaphatunk az árvizek és az ártéri gazdálkodás összefüggéseiről, őseink életmódjáról. Az útvonal érinti a rekonstruált Belestye-fokot, valamint átvezet az Ásáson átívelő helyreállított kőhídon. Megismerhetjük a nedves réteket, kaszálókat, de az ismertető táblákon helyet kapott a fa lebomlási folyamatának bemutatása is. A túra egy irányba 2,5 kilométer, oda-vissza járható be.'),
	(63, 'A Balaton északi partjának legjellegzetesebb és egyben legmagasabb hegye a Badacsony, a maga 438 méteres magasságával. Nemcsak a csodálatos panoráma, hanem a szőlősorok, a mediterrán hangulat, a különleges vendéglátóhelyek és az izgalmas geológiai képződmények miatt is érdemes ellátogatnod ide.\r\n\r\nBadacsonytomajból indulva sétálj fel a hegyre a különleges Szent István-kápolnához, majd egy erdei ösvényen mássz fel a balatoni táj felett uralko­dó csodálatos tanúhegyünk, a Bada­csony erdővel koronázott fennsíkjára!\r\n\r\nA Kisfaludy-kilátóból csodáld meg a balatoni körpanorámát, vedd számba madártávlatból a környék látnivalóit, majd a Ranol­der-kereszt felé folytasd utad, ahol szintén érdemes röviden megpihenned, és élvezni a gyönyörű kilátást. Innen a Bujdosók 436 lépcsőjén ereszkedj le Bada­csonytördemicre, ahonnan az úgynevezett Római úton térhetsz vissza kiinduló­pontodra, Badacsonytomajba.\r\n\r\nAz utolsó szakasz borászatok és jobbnál-jobb éttermek mellett halad, érdemes tehát egy finom ebédet, vagy vacsorát tervezned erre a szakaszra.\r\n\r\nA túra végén pedig nyáron csobbanhatsz is egyet a hűs habokban, vagy hajókázhatsz egyet, ha van rá időd és kedved: sétahajóval vagy menetrendszerinti járattal.\r\n\r\nLátnivalók\r\nSzent István Kápolna\r\nA kápolna nem szokványos látvány, ahogyan a helyszín sem, ahol áll. Udvardy Erzsébet, Kossuth-díjas festőművész vágya volt, hogy a Badacsonyra kápolna épüljön. Az oltárképet ő maga festette. A kápolna 2014-ben lett felszentelve. Előzetes egyeztetéssel látogatható.'),
	(64, 'Ezt a nagyon könnyű túrát családoknak és kezdőknek is ajánljuk! A túra előtt a szaporcai Ős-Dráva Látogatóközpontnál van a találkozó, ahol a túravezető fogadja a résztvevőket, és kiosztja a felszereléseket. Innen rövid séta vezet a kiindulópontra, amely vízállástól függően vagy a szaporcai hídnál vagy a cúni duzzasztónál lesz. A vízre szállás előtt a túravezető egy rövid bevezetést tart az evezés technikájába, és elmondja a biztonsággal kapcsolatos információkat. Első esetben folyásiránnyal megegyezően indul a túra a Dráva torkolatáig (5km), ahol kikötés után fürdeni is lehet. Kevés víz esetén pedig folyásiránnyal szemben, a baranyahídvégi híd irányába. Itt kicsit nehezebb a kikötés, viszont talán még gazdagabb a madárvilág: jégmadár villan a víz felett, szürke gém, kócsag, néma rétisas kering a magasban. A Fekete-vízen sodrásra nem kell számítanod, a víz szinte áll, és nemcsak a madárvilág, hanem a vegetáció is rendkívül buja, a vízinövények között is nagy a változatosság. Vízitök, tündérrózsa, békatutaj, és rendkívül sokféle mocsári gyökerező hínártársulás kerül útközben a szemed elé. Baranyahídvég felé egyre szűkül a folyócska, időnként kifejezetten kalandosan, ügyeskedve sikerül átjutni a sűrű, buja növényzeten. A programra előzetes bejelentkezés szükséges!\r\n\r\nLátnivalók\r\nŐs-Dráva Látogatóközpont\r\nAz Ormánság természeti értékeit és hagyományait megismertető Ős-Dráva Látogatóközpont interaktív kiállítással, őshonos háziállat bemutatóval, tanösvényekkel, változatos aktív programokkal, környezeti nevelési foglalkozásokkal vár.'),
	(65, 'A Pécselyi- és a Káli-medence között, a Zánka és Nagyvázsony által határolt területen fekszik a Nivegy-völgy. Főbb települései Tagyon, Szentantalfa, Szentjakabfa, Óbudavár és Balatoncsicsó. A terület már az Árpád-korban lakott volt, mára azonban már csak a templomromok mutatják az egykori falvak helyét. A kellemes körtúra során a völgy egyik legszebb részét járhatod be. Balatoncsicsón sétálva többek között megcsodálhatod a környék gazdag néprajzi örökségét, több kilátóponton gyönyörködhetsz a Nivegy-völgy lankáiban, és településeinek templomtornyait is megszámolha­tod. A Balaton-felvidék legnagyobb összefüggő szőlőterületét itt találod, ami meghatározza a túra hangulatát. A kedves kis borospincék mellett megpihen­hetsz az árnyékban, a présházak közt sétálva pedig teljesen átéltheted a vidék nyugalmát. A Fenyves-tetőn heverő mesélő határ­kövek a múlt parázs birtokvitáit idézik. Séta közben felfedezheted a környék különleges növényvilágát is, akár harissal vagy épp cincérrel is találkozhatsz. A festői szépségű Hamuházi-forrás mel­lett pedig megelevenedik előtted a mészégetők virágkora, valamint az áthatolhatatlan bakonyi rengeteg képe.\r\n\r\n'),
	(66, 'A Káli-medence temérdek látnivalója kárpótol a túrával járó fáradságért. Az utat körülölelő, gyönyörű dombos táj, szénabálák, legelésző lovak mellett el­haladva átélheted a vidék varázslatos hangulatát. Múlt és jelen keveredik itt, a Balaton-felvidéki építészet jelleg­zetes házaival tűzdelt falvakban, ahol megállva hűsölhetsz egy limonádé, fröccs vagy egy kézműves fagyi mel­lett. Különösen Köveskál építészete figyelemre méltó, nem véletlenül mondják, hogy a Balaton-felvidék egyik gyöngyszeme. Körbetekerheted a Kornyi-tavat és az Emberi komédiák szo­borcsoportot, és ha úgy érkezel, nézhetsz naplementét a Kopasz-hegyről Mindszentkállán, ami felejthetetlen élmény, letekintve a Hegyestűről a Káli-me­dencére, megcsodálva a háttérben a tanúhegyeket. A környék állat- és növényvilága is különleges, ha szerencséd van, találkozhatsz őzekkel, szarvasokkal, fácánokkal is. Az útvonal erdőkön, köves utakon ve­zet keresztül, számíts arra, hogy bár a látvány gyönyörű, de a szokásosnál időnként nehezebb a terep. Viszont talán a Balaton-felvidék legszebb része ez a varázslatos medence, a vulkánok szabdalta völgyben suhanni örök élmény lesz!\r\n\r\n'),
	(68, 'Hosszúhetényt elhagyva indul a túra a kék háromszög jelzésen. Az út mellett, szinte a túra kiindulópontján találod a Kőmorzsoló Óriást, amely a baranyai mondavilág legismertebb, kb. 3-4 méter magas fából készült alakja. Innen szép bükkösökön át vezet az út egyre meredekebben felfelé a Mecsek legmagasabb hegycsúcsára, a 682 méter magas Zengőre. Itt, a Kelet-Mecsekben található a bánáti bazsarózsa világon fellelhető teljes állományának 90%-a. Április második felében nyílik ez a különleges, bíborpiros színű virág, érdemes ekkor idelátogatnod. A Zengő tetejére érve felmászhatsz a 2020-ban épített, 22 méter magas hétemeletes kilátóba, ahonnan tiszta időben a Badacsonyt, a Drávát kísérő ártéri erdőket és a horvátországi Papuk-hegységet is láthatod. Innen nagyon meredek út vezet a sárga jelzésen Püspökszentlászlóra, egy kb. 50 fős erdei faluba. A falucska békés, világtól elzárt mesebeli település, egy püspöki kastéllyal és kápolnával, ősi arborétummal, amit előzetes bejelentkezéssel meg is látogathatsz. A falu egyetlen utcáján vezet tovább a turistaút: kedves kis parasztházak és szép kilátás kísér. Püspökszentlászlóról az út visszavezet a kiindulópontra.'),
	(69, 'Toszkánai táj és életérzés a Balaton felvidéken. Ez a Keszthely és Aszófő közötti túraajánlat bővelkedik a változatos élményekben. A napraforgótáblák és a szőlődombok nyújtotta látvány biztosan rabul ejt, de a borospincék és a jó éttermek miatt a gasztronómiai élményekre is emlékezni fogsz. Állatbarátként, ha a geológia érdekel, vagy ha az építészetért rajongsz, szintén találsz érdekességeket ezen a látnivalókban gazdag útvonalon.\r\n\r\nKeszthelyről, a Festetics-kastély elől indul a túra, ami a település egyik legfontosabb műemléke, számos történelmi tárlat helyszíne, ráadásul borospincéket is rejt a felszín alatt. A kastély északi oldalától kerékpárúton indulj el Szigliget irányába. Egy gyors pihenőre már Gyenesdiáson megállhatsz, a Bringatanyában egy fagyi vagy egy finom limonádé igazán felfrissíthet a túra előtt. Ezután Balaton-kör  egy szakaszán halad az út, a  Szigligeti várig. Ide ugyan nem könnyű feltekerni, de az eléd táruló balatoni panoráma miatt egészen biztosan megéri. A vár után közúton folytatódik a túra, a Szent György-hegy felé, amelynek oldalában hatalmas bazaltorgonákat csodálhatsz meg.\r\n\r\nA hegyet megkerülve Kisapáti felé indulj tovább. Itt már szőlődombok ölelésében bringázhatsz, remek borospincék is találhatók a környéken. Nemesgulács után Káptalantótiban pedig egy egyedi hangulatú kézműves piacba csöppenhetsz vasárnaponként.\r\n\r\nHa megéheznél útközben, Mindszentkállán több remek étterem is van, melyek igen hangulatosak. A következő állomás pedig a Hegyestű lesz, a Balaton-felvidéki Nemzeti Park egyik leglátványosabb és legnépszerűbb célpontja.\r\n\r\nEzután Monoszló felé fordul az út, ami a környék egyik ékköve. Szép időben aranyba borítja a szőlődombokat a napfény, ilyenkor szemmel látható, hogy ez a különös mikroklíma miként teszi az ország egyik legelismertebb borvidékévé ezt a területet.\r\n\r\nAz idill Balatoncsicsóig tart, ahol az útvonal talán legnehezebb emelkedője következik Óbudaváron. Ezután Vöröstó és Barnag irányába haladunk tovább, ahol szintén vár még ránk egy kisebb kaptató. A túra déli irányban, Pécsely érintésével Aszófőn végződik, ahol még érdemes tenni egy rövid látogatást a vasútállomás mögötti Kövesdi templomromnál. Végül Örvényesen a szabadstrand vár, ahol felfrissülhetsz, megpihenhetsz.\r\n\r\nA túraleírás a Flowcycle közreműködésével készült.');

-- Struktúra mentése tábla turak. tura_szintek
CREATE TABLE IF NOT EXISTS `tura_szintek` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tura_szintek` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Tábla adatainak mentése turak.tura_szintek: ~3 rows (hozzávetőleg)
INSERT INTO `tura_szintek` (`id`, `tura_szintek`) VALUES
	(1, 'könnyű'),
	(2, 'közepes'),
	(3, 'nehéz');

-- Struktúra mentése tábla turak. tura_tipusok
CREATE TABLE IF NOT EXISTS `tura_tipusok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tura_tipus` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Tábla adatainak mentése turak.tura_tipusok: ~3 rows (hozzávetőleg)
INSERT INTO `tura_tipusok` (`id`, `tura_tipus`) VALUES
	(1, 'vízitúra'),
	(2, 'gyalogos'),
	(3, 'kerékpár');

-- Struktúra mentése tábla turak. users
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_uid` tinytext NOT NULL,
  `users_pwd` longtext NOT NULL,
  `users_email` longtext NOT NULL,
  `users_regist_date` datetime DEFAULT NULL,
  PRIMARY KEY (`users_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

-- Tábla adatainak mentése turak.users: ~2 rows (hozzávetőleg)
INSERT INTO `users` (`users_id`, `users_uid`, `users_pwd`, `users_email`, `users_regist_date`) VALUES
	(62, 'First', '$2y$10$3JggGfUAKt01g3U8K9zO0.sqgWbnN1iWnpTayxKGZjElOAfNdukGG', 'first@first.com', '2022-08-28 14:31:23'),
	(63, 'Péter24', '$2y$10$s/54oms34QeFeyIMtrOFsuW6mqFpit6dxXMEGUlEztF3jzbuB2PlW', 'peter@g.com', '2022-08-29 13:00:32');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
