-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Počítač: localhost
-- Vytvořeno: Čtv 14. srp 2014, 15:04
-- Verze serveru: 5.6.16
-- Verze PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáze: `Narwhal`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_articles`
--

CREATE TABLE IF NOT EXISTS `prefix_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `content` text,
  `image` varchar(150) DEFAULT NULL,
  `link` varchar(150) NOT NULL,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `score` int(10) unsigned NOT NULL DEFAULT '0',
  `enableViews` smallint(5) unsigned NOT NULL DEFAULT '1',
  `enableScore` smallint(5) unsigned NOT NULL DEFAULT '1',
  `enableComments` smallint(5) unsigned NOT NULL DEFAULT '1',
  `visibility` smallint(5) unsigned NOT NULL DEFAULT '1',
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editDate` int(11) NOT NULL DEFAULT '0',
  `category` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `priority` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `link_UNIQUE` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Vypisuji data pro tabulku `prefix_articles`
--

INSERT INTO `prefix_articles` (`id`, `title`, `description`, `content`, `image`, `link`, `views`, `score`, `enableViews`, `enableScore`, `enableComments`, `visibility`, `createDate`, `editDate`, `category`, `author`, `priority`) VALUES
(9, 'Najnovší laserový merač rýchlosti TruCam', '', '<p>Je to laserový radar s integrovanou video kamerou a GPS prijímačom. Získané údaje je možné vložiť do geograficko-informačného systému, k tomuto záznamu sa automaticky prikladá aj informácia o polohe, kde bola daná rýchlosť nameraná.</p>\n\n<p>TrueCam je schopný podľa výrobcu preukázať rôzne prekročenia rýchlosti a to i motocyklov. Ďalej disponuje aj ochranou proti zmene údajov kryptovaným, ktorý zaručuje bezpečnosť evidencie priestupkov.</p>\n<p>Režimy merania TrueCam-u:</p>\n<p><strong>Rýchlostný režim</strong><br /> Pre vozidlá idúce rýchlosťou vyššou alebo sa rovnajúcou nastavenej hodnote, je automaticky zaznamenané video a obrázky s prislušnými údajmi</p>\n<p><strong>Automatický režim</strong><br /> Režim kombinujúci automatickú kontrolu dopravy s vytváraným videa na obrázku.<br /> Určené na mobilné použitie alebo pevne inštalovaný systém.</p>\n<p><strong>Motocyklový režim</strong><br /> Určený pre meranie rýchlosti motocyklov so záznamom od počiatku merania na príjazde, po okamih kedy je viditeľný a odfotené zadné evidenčné číslo.</p>\n<p><strong>Režim merania pri zhoršenej viditeľnosti</strong><br /> Použije brány pre zvýšenie bezpečnosti merania rýchlosti počas dažďa, sneženia alebo hmly.</p>\n<p><strong>Video režim</strong><br /> Okamžité zachytenie videa priestupku, pri prejazde na červenú, nezastavení na stopke, predbiehanie pri plnej čiare.</p>\n<p><strong>Dvojrýchlostný režim</strong><br /> Automatické rozpoznanie osobného a nákladného vozidla a priradenie príslušného rýchlostného limitu.</p>\n<p><strong>Vzdialenosť medzi vozidlami</strong><br /> Pri tesne za sebou idúcich vozidlách je zmeraná rýchlosť , čas prejdenia a vzdialenosť medzi dvoma vozidlami.</p><br />\n<p><strong>Technické parametre:</strong></p>\n<p><strong>Maximálna vzdialenosť merania: </strong>1000m</p>\n<p><strong>Minimálna vzdialenosť merania:</strong> Rýchlostný režim 16m , Zhoršená viditeľnosť 61m</p>\n<p><strong>Rozsah merania:</strong> 0km/h do 320 km/h</p>\n<p><strong>Pracovná teplota:</strong> -10°C do +60°C</p>\n<p><strong>Presnosť merania </strong>:+- 3 km/h</p><br />\n<p><strong>Presnosť merania vzdialenosti:</strong> +- 0,15 km/h</p>\n<p><strong>Napájanie:</strong> polymerová batéria nabíjateľná 7,4 V / výdrž až 15 hodín bez nabíjania/</p>\n<p><strong>Záznam na:</strong> SD kartu 2 GB a viac</p>\n<p><strong>Vlnová dĺžka laseru:</strong> 905nm</p>\n<p><strong>Kamera :</strong> 3,1 Mpixel / 2048x1536/</p>\n<p><strong>Objektív kamery:</strong> 75 mm,</p>\n<p><strong>Display: </strong>farebné dotykové 6,9 cm, 240x320 pixelov, 18 bitov na pixel</p>\n<p><strong>GPS:</strong> Sirf star III/ 20 kanálov/</p>\n<p><strong>Software:</strong> jadro os Linux TrueCam software</p>\n<p><strong>Kryptovanie údajov: </strong>AES-128 bitov</p>\n<p><strong>Vstupy/Výstupy: </strong>USB 2.0,RS 232, RS 485 pre nočný blesk, vstup pre dotykový display</p>', 'images/clanky/trucam.png', 'najnovsi-laserovy-merac-rychlosti-trucam', 0, 27, 0, 0, 0, 1, '2014-07-04 00:25:05', 0, 25, 3, 6),
(10, 'Technológia antiradarov - ako funguje antiradar', '', '<p>Radarové detektory, niekedy nie plne presne nazývané "antiradary" sú pasívne zariadenia - veľmi citlivé prijímače v mikrovlnnom pásme. Sú naladené na rovnakú frekvenciu, ktorú vysielajú cestné radary, a ich funkcia by sa dala prirovnať ku klasickému rádioprijímaču.</p>\n<p><strong>Radarové detektory nevysielajú ani nerušia, iba vodičov informujú o prítomnosti radaru.</strong></p>\n<p>Detektory sú riadené mikroprocesorom, ktorý vyhľadáva radary na všetkých svetovo používaných pásmach - X, K a rozdelenom Ka pásme používanom u nás v Slovenskej republike. V blízkosti radaru je vodič upozornený zvukovým a svetelným signálom. Systém inteligentnej signalizácie umožňuje odhadnúť vzdialenosť a polohu miesta, z ktorého je rýchlosť meraná. Detektor Vás tiež upozorní na laserové merače, ktoré sa v zahraničí používajú ku meraniu rýchlosti automobilu na veľkú vzdialenosť. Pokroková FMT technológia zaručuje vynikajúcu citlivosť vo všetkých pásmach s minimom falošných poplachov.</p>\n<p><span class="big"><b>Úspešnosť pri odhaľovaní radarov</span></b></p>\n<p>úspešnosť detekcie, tzn. odhalenie policajného radaru je pri detektoroch relatívne vysoká. Radarový detektor odhalí radar v 98% prípadov. Nie vždy ale stačí vodič včas zareagovať. Radarové detektory sú úspešnejšie pri odhaľovaní radarov v mestách, kde sa lúč radaru dobre odráža od terénnych prekážok, ako na diaľnici.</p>\n<p><strong> Staršie typy detektorov upozorňujú vodičov zhruba v 75-85% prípadoch,kedy by za iných okolností prehliadli radarovú kontrolu a určite zaplatili pokutu.</strong></p>\n<p><strong>Proti novým detektorom nemajú radary typu RAMER-7 veľmi veľkú šancu na úspech. Priemerná účinnosť je okolo 95%: v meste sa blíži ku 100%, na diaľnici približne 90%.</strong></p>\n<p>Vzdialenosť, na ktorú radarový detektor odhalí radar, závisí od konkrétnej situácie, spôsobe merania rýchlosti a hlavne na <strong>odrazoch radarového lúča v teréne</strong>. Pri meraní <strong>proti smeru jazdy</strong> detektor varuje vodičov často aj niekoľko sto metrov pred miestom, v ktorom je meraná rýchlosť. Minimálna vzdialenosť, na ktorú naše detektory odhalia radar je 150 metrov. Dosah radarov RAMER-7 je maximálne 60 metrov, obyčajne sa však meria na vzdialenosť 35 metrov. Preto má v týchto situáciách aj menej pozorný vodič dostatok času správne zareagovať.</p>\n<p>Ak meria polícia rýchlosť v smere jazdy a detektor zachytí odrazené vlny, je obvykle vzdialenosť odhalenia radaru 20-60 metrov pred meraným stanovišťom. Pretože je rýchlosť vozidla zmeraná zhruba 10 až 20 metrov potom ako prejdete okolo radaru, je pri rýchlej reakcii vodiča opať sľubná šanca na úspech.</p>\n<p>Je dôležité si uvedomiť, že pri meraní v smere jazdy je <strong>reakčná doba pre zmenu rýchlosti vozidla veľmi krátka</strong> - rádovo niekoľko sekúnd. Výhodou je, že aj pri meraní v smere jazdy sa lúč radaru dobre odráža najma v hustej zástavbe.</p>\n<p><span class="big"><b>Falošné poplachy</span></b></p>\n<p>Pri falošnom poplachu detektor zapípa rovnako, akoby zistil prítomnosť radaru. V Slovenskej republike je relatívne vysoká úroveň mikrovlnového šumu, ktorý spôsobuje falošné poplachy. Typické zdroje rušenia sú GSM mobilné telefóny používané vo vnútri vozidla, zabezpečovacie systémy bánk a obchodov a automatické otvárania dverí benzínových staníc.</p>\n<p>Všetky nami dodávané detektory sú špeciálne upravené pre použitie v európskych krajinách a na Slovensku. Ich jedinečné technické parametre spôsobujú vysokú odolnosť voči vyššie spomínaným zdrojom rušenia pri zachovaní vynikajúcej citlivosti. Veľmi málo reagujú na <strong>mobilné telefóny GSM, neregistrujú benzínové pumpy ani väčšinu ostatných zdrojov rušenia.</strong></p>', 'images/clanky/radarove_spektrum.jpg', 'ako-funguje-antiradary', 0, 19, 0, 0, 0, 1, '2014-07-04 00:26:16', 0, 25, 3, 1),
(11, 'Nie je antiradar ako antiradar alebo ako si vybrať', '', '<p><strong>Ako postupovať pri výbere antiradaru?</strong></p>\n<p>Treba sa rozhodnúť čo je pre Vás najvhodnejšie  prenosné alebo vstavaný (pevný) antiradar. (Vo vačšine pripádov sa rozhodnú ľudia hneď ako vidia cenu)</p>\n<p>Potrebujete poznať parametre alebo poradiť sa s odborníkmi, ktorí sú veľmi doležití pri výbere, nakoľko niektoré typy nemajú podporu určitých frekvenčných rozsahov a môže sa stať, že investícia nebude  efektívna</p>\n<p><strong>Je veľmi dôležité, aby antiradary, ktoré chceme používať na Slovensku a v Českej republike mali:</strong></p>\n<p>- kvalitnú a rýchlu detekciu Ka pásma od 33,8-34,4 GHz (označuje sa aj ako Ka narrow)</p>\n<p>- aby boli kvalitné a aby mali čo najmenej falošných poplachov</p>\n<p>- aby sa frekvenčné pásma, ktoré nepoužívame sa dali vypnúť</p>\n<p>- aby vstavaný (pevný) antiradar bol správne namontovaný</p>\n<p>- aby prenosný antiradar bol správne umiestnený</p>\n<br/>\n<p><b>Ktorý antiradar je najlepší?</b></p>\n<p><b>Rozdiel medzi prenosným a pevne zabudovateľným radarovým detektorom</b></p>\nPevne zabudovateľné antiradary sú z konštrukčne riešeného hľadiska oveľa citlivejšie ako prenosné zariadenia a reagujú na podstatne väčšiu vzdialenosť. Pevné antiradary sú zabudované do vozidla tzv. skrytou montážou, kt. zaručuje vodičovi maximálnu diskrétnosť. Prenosné zariadenia musia vodiči nosiť neustále so sebou a skrývať pred políciou. V prípade, že má auto pokované sklo, prenosný detektor fungovať nebude.<p> \n<p><b>Rozdiel medzi radarovým detektorom a laserovou rušičkou</b></p>\n<p>Radarové detektory fungujú ako pasívne zariadenia, ktoré sú naladené na rovnakú frekvenciu ako cestné radary. Hlasovou a svetelnou signalizáciou upozorňujú vodiča na prítomnosť merania. Väčšina radarových detektorov je vybavená GPS technológiou, ktorá vďaka integrovanej databáze dokáže upozorniť vodiča na úsekové meranie rýchlosti, prítomnosť stacionárnych radarov, kamier na červenú. Radarové detektory neochránia vodiča pre laserovým meraním z tohto dôvodu je potrebné kombinovať radarový detektor s laserovou rušičkou pre zaistenie 100% ochrany. Výhodou laserových rušiek je, že slúžia aj ako parkovacie asistenty.</p> \n', 'images/clanky/radar.jpg', 'nie-je-antiradar-ako-antiradar', 0, 25, 0, 0, 0, 1, '2014-07-04 00:26:46', 0, 25, 3, 3),
(12, 'Čo je to Dopplerov jav a ako sa dá použiť na meranie', '', '<p>Tento fyzikálny jav využívajú aj statické radary pri cestách a diaľniciach a radary typu RAMMER, ktoré v súčasnosti používajú dopravné polície vstavané vo svojich vozidlách na meranie rýchlosti. Dopplerov jav možno pozorovať napríklad aj pri závodoch formúl. Rýchlo sa pohybujúca formula blížiaca sa k pozorovateľovi vydáva z pohľadu pozorovateľa iný zvuk, ako vzďaľujúca sa formula.</p>\n<p>Dopplerov jav je zmena vlnovej dĺžky (a teda frekvencie) elektromagnetických alebo akustických vĺn, vyvolaný relatívnym pohybom zdroja a pozorovateľa. Názov získal podľa rakúskeho fyzika Christiana Johanna Dopplera, ktorý jav opísal v roku 1842. Pre priblíženie Dopplerovho javu nám môže slúžiť príklad plavca v mori. Ak plavec pláva v smere vĺn potom čas medzi prechodmi vrcholom vlny je dlhší ako keby stál na mieste. Analogicky ak by plával proti smeru vĺn tak by čas bol kratší (teda z jeho pohľadu by vlnová dĺžka bola kratšia ako skutočná dĺžka vlny).<p>\n<p>Ak pohyblivý zdroj vysiela vlnenie s frekvenciou f0, potom ho nehybne pozorovateľ pozoruje ako vlnenie s frekvenciou f: kde v je rýchlosť merania vĺn v danej látke a vs,r relatívna rýchlosť zdroja voči pozorovateľovi (kladné znamená približovanie, záporné vzďaľovanie).</p>\n<p><strong>Príklad:</strong><br />Smerom priamo k nehybnému pozorovateľovi sa pohybuje rýchlosťou 10 m/s zdroj akustického monotónneho signálu s frekvenciou 100 Hz. Ak rýchlosť merania zvuku vo vzduchu je 340 m/s, potom z uvedeného vzťahu vyplýva, že pozorovateľ vníma zvuk frekvencie 103,03 Hz.</p>', '', 'dopplarov-jav', 0, 11, 0, 0, 0, 1, '2014-07-04 00:27:16', 0, 25, 3, 4),
(15, 'Meranie rýchlosti laserom', '', '<p>Slovo "Laser" znamená "Light Amplification by Stimulated Emission of Radiation" do slovenčiny by sa to dalo preložiť ako "zosilňovanie svetla pomocou stimulovanej emisie žiarenia"</p>\n<p>Princíp laserového merania spočíva v meraní času odrazu laserových impulzov od cieľa a následný výpočet rýchlosti meraného objektu (vozidla).</p>\n\n<p><Strong>Meranie sa dá realizovať dvomi spôsobmi:</strong></p\n<p>V prvom prípade laserový merač drží policajt v ruke a musí si vybrať konkrétny objekt-vozidlo, ktorý chce merať a musí naň presne namieriť a "vystreliť" - aktivovať meranie.</p>\n<p>V druhom prípade meracie zariadenie je na trojnožke namierené na konkrétne miesto a všetko čo cez to konkrétne miesto prejde automaticky zmerá a v prípade ak prekročí rýchlosť viac ako si na zariadení nastaví tak vozidlo odfotí. Slovenská polícia v súčasnosti používa na meranie rýchlosti vozidiel zariadenia od výrobcu  Laser Technology, Inc.,z Colorada v USA. Tieto zariadenia majú typové označenie Ultralyte LTI      20-20.</p>\n\n<p>Výhody laserových meracích zariadení oproti klasický radarom sú veľmi presvedčivé:</p>\n<p>laserový lúč  je oveľa užší ako radarový lúč, ktorý umožňuje presnejšie merania kvôli úzkemu rozptylu meracieho lúča a tým zamerať konkrétne vozidlo, ďalej doba potrebná na vyhodnotenie rýchlosti  je menej ako 0,5 sekundy oproti 2 - 3 sekundám pre radary v Ka pásme.</p>\n<p><span class="big"><strong>Čo môže ovplyvňovať úspešnosť merania laserovým meračom?</span></strong></p>\n<p><b>Existuje päť hlavných faktorov:</b></p>\n<p>1. Väčšina štátov vyžaduje použitie prednej ŠPZ. Tieto ŠPZ sú namontované kolmo na povrch vozovky, čím pôsobia ako silný reflektor svetelnej energie. Navyše ŠPZ v súčasnosti sú retro-reflexné, ktoré v skutočnosti zväčšujú a zosilňujú množstvo odrazeného svetla. Zistilo sa, že aj na čierne autá, ktoré majú skryté svetlomety, keď majú prednú ŠPZ, efektivita zmeranie rýchlosti zvyšuje až štyrikrát!</p>\n<p>2. Hmlovky a svetlá sú tiež silné reflektory sú však spravidla od seba tak vzdialené, že sa od nich odrazí len časť Lidar lúča.</p>\n<p>3. Vozidlá, ktoré majú na čelnej ploche širšie chrómované časti sú jednoduchšie ciele pre laser ako vozidlá, ktoré nemajú žiadne alebo sú tenké chrómované časti s veľkými medzerami medzi nimi</p>\n<p>4. Čelný tvar vozidla, hrá veľkú rolu pri uskutočňovaní merania laserom. Veľa športových áut má strmé predné kapoty, ktoré majú malý povrch kolmo na cestu. Preto, vozidlá, ktoré sú aerodynamické sa dajú ťažšie zacieliť laserom, pretože tieto typy vozidiel na menšej ploche odrážajú laserové svetlo.</p>\n<p>5. Farba a typ farieb prispieva k charakteru vozidla odrážať alebo pohlcovať laserové lúče. Vozidlá tmavšej farby skôr pohlcujú ako napríklad vozidlá svetlých farieb nehovoriac o vozidlách, ktoré majú metalízu tie najviac odrážajú laserové lúče preto sa dajú najľahšie zamerať. Bohužiaľ, aj keby sa na základe horeuvedených faktorov vyrobilo ideálne vozidlo, napriek tomu by sa dalo zmerať najnovšími laserovými meračmi, ktoré v súčasnosti používajú policajti. Na zneviditeľnenie vozidla  /znemožnenie vyhodnotenia merania /  sa používajú laserové asistenty „rušičky“, ktoré pri správnej montáži a používaní vedia z hocijakého vozidla spraviť auto neviditeľné pre laserový merač.</p>\n', '', 'meranie-rychlosti-laserom', 0, 13, 0, 0, 0, 1, '2014-07-04 00:29:25', 0, 25, 3, 7),
(16, 'Je antiradar a laserová rušička spoľahlivé zariadenie?', '', '<p>Väčšina vodičov, ktorá má záujem o kúpu antiradaru alebo laserovej rušičky sa zaoberá otázkou účinnosti a spoľahlivosti týchto zariadení. Radarové detektory sú zariadenia, ktoré plnia informatívnu funkciu. Z praktického hľadiska to znamená, že nič nevysielajú ani nerušia, len upozorňujú vodiča na prítomnosť radaru. Informovanie vodiča o prítomnosti radaru závisí od odrazu mikrovĺn. Odhalenie radarov je niekoľkonásobne efektívnejšie v meste ako na voľnom priestranstve. V zastavaných oblastiach dokážu antiradary odhaliť prítomnosť radaru aj na 800 m. Radarové detektory upozorňujú vodiča na prítomnosť radaru zvukovým a svetelným signálom. Jedná sa o špičkové zariadenia, ktoré ochránia vodiča pred pokutou a ich spoľahlivosť je naozaj vysoká.</p>\n\n<p> Nevýhodou antiradarov je, že nedokážu ochrániť vodiča pred laserovými meračmi rýchlosti. Túto funkciu plnia laserové rušičky, ktoré bránia polícii počas nastaveného času zmerať rýchlosť vozidla. Na laserovú rušičku sa môže vodič 100% spoľahnúť. Dôležitým faktorom, ktorý má vplyv na spoľahlivosť zariadenia je montáž, správny počet senzorov a samozrejme aj ich umiestnenie v závislosti od veľkosti a modelu auta. Pri výbere laserovej rušičky by mal vodič siahať po kvalitných značkách a nie lacných napodobeninách, ktoré z hľadiska výkonnosti a schopnosti detekcie pre 100% ochranu vodiča nie sú postačujúce. Laserová rušička sa skladá z rozhrania a senzorov. Senzory sú inštalované do prednej masky vozidla ale pre zaistenie maximálnej ochrany vodiča pred laserovým meraním sa montujú aj do zadnej časti vozidla.</p>  \n', '', 'ja-antiradar-a-laserova-rusicka-spo-ahlive-zariadenia', 0, 0, 0, 0, 0, 0, '2014-08-04 12:13:04', 0, 25, 5, 2),
(17, 'Ako sa meria rýchlosť na Slovensku?', '', '<p><b>Meranie rýchlosti na Slovensku môžeme rozdeliť do týchto kategórií:</b><br/>\n1. Mikrovlnné Dopplerove merače rýchlosti (Ramer – výrobca RAMET Kunovice ČR, Multaradar CD – výrobca Jenoptik Nemecko)<br/>\n2. Laserové zameriavače (LTI TRUECAM – výrobca Laser Technologies USA)<br/>\n3. Mobilné úsekové meranie (POLCAM – výrobca POLCAM SYSTEMS Poľsko)<br/>\n4. Stacionárne úsekové meranie – rôzny výrobcovia</p>\n\n</p><b>Mikrovlnné Dopplerove merače rýchlosti</b><br/>\nV súčasnoti sa na Slovensku používajú merače od dvoch výrobcov, ktoré pracujú rozdielnym spôsobom a na rozdielnych frekvenciách. Merač typu <b>RAMER</b> vysiela vo frekvenčnom pásme <b>KA 33,9 – 34,3 GHz</b>. Tieto merače v pásme KA sú pomerne ľahko detekovateľné, pretože toto pásmo nie je v takej miere zarušené falošnými poplachmi. Spozornieť treba pri výbere antiradaru z neoficiálnych zdrojov, ktoré nie sú vyladené pre použitie na SR napr. z USA, DE, AT, NL. Antiradary pochádzajúce z neoficiálnych zdrojov nemajú zúžené KA pásmo. Pri detekciách vykazujú veľmi zlé výsledky z toho dôvodu, že prehľadávajú príliš široký frekvenčný rozsah. Tieto merače spoľahlivo detekujú naše produkty Escort Radar a Genevo.</p>  \n<p>Druhým mikrovlnným meračom používaným na Slovensku je merač typu <b>Multaradar CD</b>, ktorý vysiela vo frekvenčnom pásme <b>K 24,050 - 24,150 GHz</b>. Problémom pri detekovaní tohto merača nastáva v prípade, že sa pohybujete v blízkosti obchodných centier, alebo benzínových púmp, ktoré používajú mikrovlnné otvárače dverí na tej istej frekvencii. Niekoľkoročným výskumom sa firme Escort Radar USA podarilo vyselektovať signál z Multaradaru CD tak, aby Vás detektor od firmy Escort Radar upozorňoval iba na policajné merače a neobťažoval Vás rušivými falošnými poplachmi. Na tento typ zameriavača ponúkame naše produkty Escort Max a Escort 9500ci.</p>\n\n<p><b>Laserové merače</b><br/>\nSú veľmi jednoduché zariadenia, ktoré pomocou laserového lúča a jednoduchých fyzikálnych zákonov vedia rýchlo a spoľahlivo odmerať rýchlosť a vzdialenosť. Tieto merače sa dajú ľahko detekovať celou radou našich produktov. V prípade, že Vám detektor zahlási meranie laserom je viac ako isté, že ste boli zmeraný. Tieto pasívne detektory Vás informujú len o tom, že Vás polícia odmerala. Spoľahlivou ochranou proti zmeraniu sú laserové systémy, ktoré dokážu pomocou vlastnej riadiacej jednotky oslepiť laserový zameriavač na dostatočne dlhú dobu, aby ste si stihli upraviť Vašu rýchlosť. Z nášho sortimentu, Vám odporúčame laserový systém Blinder HP QUAD, ktorý Vás vie bezpečne a diskrétne ochrániť.</p> \n\n<p><b>Mobilné úsekové meranie</b><br/>\nMerače typu <b>POLCAM</b> sú pre všetkých majiteľov antiradarov hrozbou. Tieto systémy totiž nič nevysielajú, nedajú sa preto spoľahlivo detekovať. Zameriavače Polcam fungujú na systéme merania rýchlosti policajného vozidla, ktoré počas jazdy vytvára videozáznam o Vašom priestupku. Na tento typ merača je najlepšie ľudské oko. Týchto vozidiel je našťastie na Slovensku veľmi málo a sú to len dva typy: VW Passat a Škoda Super B. Vozidlá poznáte podľa zatmavených skiel, neštandardnej antény a vyššieho počtu výfukov (vozidlá majú 6-valcové benzínové motory). Ak idete rýchlo, je treba dávať si pozor na to, kto Vás prenasleduje. Na tento typ meraní neexistuje žiadny antiradar. </p>\n\n<p><b>Stacionárne úsekové meranie</b><br/>\nÚsekové meranie je v podstate veľmi jednoduchý systém dvoch fotokamier, ktoré sú rozmiestnené na presne vymedzenom úseku. Prvá fotokamera Vás odfotí pri vjazde do úseku, druhá pri výjazde z úseku. Podľa jednoduchých fyzikálnych zákonov Vám tento systém vypočíta rýchlosť na základe času, za aký ste tento úsek prešli. Tieto systémy sú momentálne u polície veľmi populárne a tešia sa širokému rozvoju. Na tieto systémy spoľahlivo reagujú všetky radarové detektory vybavené funkciou GPS (Passport Escort MAX, Escort 9500ci, Genevo One).</p>\n\n', 'images/clanky/radar-jpg', 'ako-sa-meria-rychlost-na-slovensku', 0, 0, 0, 0, 0, 1, '2014-08-11 08:38:26', 0, 25, 5, 5);

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_categories`
--

CREATE TABLE IF NOT EXISTS `prefix_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `visibility` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `priority` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `link` varchar(150) NOT NULL,
  `subcategory` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `link_UNIQUE` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Vypisuji data pro tabulku `prefix_categories`
--

INSERT INTO `prefix_categories` (`id`, `name`, `description`, `visibility`, `createDate`, `priority`, `link`, `subcategory`) VALUES
(25, 'Prenosné antiradary', '<p>Ponúkame Vám najlepšie prenosné antiradary, ktoré môžete dnes nájsť na trhu. </p>\n<p>Pasívne radarové detektory sú spoľahlivou ochranou pred meračmi rýchlosti typu RAMER-7 a AD9.</p>', 1, '2014-07-03 20:23:06', 0, 'prenosne-antiradary', 0),
(26, 'Pevné antiradary', '<p> </p>\n<p>Dokonalejšou formou antiradaru sú určite zabudované resp. pevné antiradary. Ponúkame osvedčené modely zabudovateľných antiradarov. Ideálne riešenie pre vozidlá s pokovenými sklami.</p>', 1, '2014-07-03 20:23:21', 1, 'pevne-antiradary', 0),
(27, 'Laserové rušičky', '<p> </p>\n<p>Najúčinnejšia  ochrana pred laserovými meračmi na cestách. Široký výber najpoužívnejších laserových rušičiek na trhu - značky ako BLINDER a LASER INTERCEPTOR vás spoľahlivo ochránia pred pokutami. </p>', 1, '2014-07-03 20:23:37', 2, 'laserove-rusicky', 0),
(28, 'Príslušenstvo', '', 1, '2014-07-03 20:24:15', 3, 'prislusenstvo', 0),
(29, 'Kompletné sady', '', 1, '2014-08-01 12:01:34', 4, 'kompletne-sady', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_comments`
--

CREATE TABLE IF NOT EXISTS `prefix_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` int(11) NOT NULL,
  `article` int(10) unsigned DEFAULT NULL,
  `page` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_links`
--

CREATE TABLE IF NOT EXISTS `prefix_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `presenter` varchar(50) DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- Vypisuji data pro tabulku `prefix_links`
--

INSERT INTO `prefix_links` (`id`, `path`, `presenter`, `action`) VALUES
(7, 'prenosne-antiradary', 'Category', 'Show'),
(8, 'pevne-antiradary', 'Category', 'Show'),
(9, 'laserove-rusicky', 'Category', 'Show'),
(10, 'prislusenstvo', 'Category', 'Show'),
(12, 'faq-caste-otazky', 'Page', 'Show'),
(13, 'obchodne-podmienky', 'Page', 'Show'),
(14, 'montaz', 'Page', 'Show'),
(15, 'kontakt', 'Page', 'Show'),
(16, 'homepage', 'Homepage', 'default'),
(17, 'clanky', 'Article', 'Default'),
(20, 'escort-x50i-international-sk', 'Product', 'Show'),
(21, 'genevo-one', 'Product', 'Show'),
(22, 'escort-9500ci-international-sk', 'Product', 'Show'),
(23, 'escort-qi45-international-sk', 'Product', 'Show'),
(24, 'stinger-card', 'Product', 'Show'),
(25, 'beltronics-sti-r-mp-m-edition', 'Product', 'Show'),
(26, 'stinger-vip', 'Product', 'Show'),
(27, 'blinder-hp-quad', 'Product', 'Show'),
(28, 'laser-interceptor', 'Product', 'Show'),
(29, 'laser-interceptor-triple', 'Product', 'Show'),
(30, 'laser-interceptor-quad', 'Product', 'Show'),
(31, 'najnovsi-laserovy-merac-rychlosti-trucam', 'Article', 'Show'),
(32, 'ako-funguje-antiradary', 'Article', 'Show'),
(33, 'nie-je-antiradar-ako-antiradar', 'Article', 'Show'),
(34, 'dopplarov-jav', 'Article', 'Show'),
(37, 'meranie-rychlosti-laserom', 'Article', 'Show'),
(52, 'napajaci-kabel-smartcord', 'Product', 'Show'),
(59, 'kabel-na-pevnu-montaz-s-displejom', 'Product', 'Show'),
(60, 'horizontalny-drziak', 'Product', 'Show'),
(61, 'pripinacia-spona', 'Product', 'Show'),
(62, 'vertikalny-drziak', 'Product', 'Show'),
(63, 'napajaci-kabel-na-pevnu-montaz', 'Product', 'Show'),
(64, 'escort-max-international-sk', 'Product', 'Show'),
(65, 'genevo-ff', 'Product', 'Show'),
(67, 'kompletne-sady', 'Category', 'Show'),
(68, 'escort-max-genevo-ff2', 'Product', 'Show'),
(69, 'escort-9500ci-blinder-quad', 'Product', 'Show'),
(71, 'ja-antiradar-a-laserova-rusicka-spo-ahlive-zariadenia', 'Article', 'Show'),
(73, 'forum', 'Forum', 'Posts'),
(74, 'kabel-do-zapa-ovaca', 'Product', 'Show'),
(75, 'prisavka', 'Product', 'Show'),
(76, 'ako-sa-meria-rychlost-na-slovensku', 'Article', 'Show'),
(77, 'escort-9500ix-euro', 'Product', 'Show'),
(78, 'bli-hp905-quad', 'Product', 'Show'),
(79, 'escort-laser-shifter', 'Product', 'Show');

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_menus`
--

CREATE TABLE IF NOT EXISTS `prefix_menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `link` varchar(150) NOT NULL,
  `description` text,
  `image` varchar(150) DEFAULT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '0',
  `priority` int(10) unsigned NOT NULL DEFAULT '0',
  `submenu` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `link_UNIQUE` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Vypisuji data pro tabulku `prefix_menus`
--

INSERT INTO `prefix_menus` (`id`, `name`, `link`, `description`, `image`, `visibility`, `priority`, `submenu`) VALUES
(13, 'Hlavná stránka', 'homepage', 'dassa', '', 0, 1, 0),
(14, 'Poradňa', 'poradna', 'asdasda', '', 1, 2, 0),
(15, 'Články a zaujímavosti', 'informacie-o-antiradaroch', 'dassda', '', 1, 3, 0),
(16, 'Obchodné podmienky', 'obchodne-podmienky', 'adsas', '', 1, 4, 0),
(17, 'Montáž', 'montaz', 'dasa', '', 1, 5, 0),
(18, 'Kontakt', 'kontakt', 'asd', '', 1, 6, 0),
(19, 'Forum', 'forum', '', '', 1, 8, 1),
(21, 'FAQ - časté dotazy', 'faq-caste-otazky', '', '', 1, 7, 1),
(27, 'Produkty', 'produkty', '', '', 1, 0, 0),
(28, 'Prenosné antiradary', 'prenosne-antiradary', '', '', 1, 1, 1),
(29, 'Pevné antiradary', 'pevne-antiradary', '', '', 1, 2, 1),
(30, 'Laserové rušičky', 'laserove-rusicky', '', '', 1, 3, 1),
(31, 'Príslušenstvo', 'prislusenstvo', '', '', 1, 5, 1),
(32, 'Kompletné sady', 'kompletne-sady', '', '', 0, 4, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_pages`
--

CREATE TABLE IF NOT EXISTS `prefix_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text,
  `content` longtext,
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  `link` varchar(150) NOT NULL,
  `score` int(10) unsigned NOT NULL DEFAULT '0',
  `visibility` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enableViews` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enableScore` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enableComments` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `editDate` int(11) NOT NULL DEFAULT '0',
  `author` int(11) NOT NULL,
  `category` int(11) NOT NULL DEFAULT '21',
  PRIMARY KEY (`id`,`category`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `link_UNIQUE` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Vypisuji data pro tabulku `prefix_pages`
--

INSERT INTO `prefix_pages` (`id`, `title`, `description`, `content`, `views`, `link`, `score`, `visibility`, `enableViews`, `enableScore`, `enableComments`, `createDate`, `editDate`, `author`, `category`) VALUES
(9, 'FAQ - časté otázky', '', '<div class="widget">\n                	<h3>FAQ - Otázky na ktoré sa najčastejšie pýtate</h3>\n					<div class="about_tabbed">     \n						<div class="panel-group" id="accordion2">\n							<div class="panel panel-default">\n								<div class="panel-heading active">\n									<h4 class="panel-title">\n                                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Ktorý prenosný antiradar je najlepší?</a>\n									</h4>\n								</div><!-- end panel-heading -->\n								<div id="collapseOne" class="panel-collapse collapse in hda">\n									<div class="panel-body">\n                                        <p>Prenosné antiradary v našej ponuke sú všetky na rovnakej kvalitatívnej úrovni a dosahujú porovnateľné výsledky v detekovaní meračov rýchlosti typu RAMER.<br />\nMy odporučame <a href="/prenosne-antiradary/genevo-one/">antiradar Genevo One</a> a <a href="/prenosne-antiradary/escort-X50i/">Escort X50i </a> dostupné za prijateľné ceny.</p>\n									</div><!-- end panel-body -->\n								</div><!-- end collapseOne -->\n							</div><!-- end panel -->\n							<div class="panel panel-default">\n								<div class="panel-heading">\n									<h4 class="panel-title">\n                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Je používanie antiradarov a laserových rušičiek na Slovensku zakázané alebo legálne?</a>\n									</h4>\n								</div><!-- end panel-heading -->\n								<div id="collapseTwo" class="panel-collapse collapse">\n									<div class="panel-body">\n                                        <p>Nová právna úprava výslovne stanovuje, že <strong>používanie</strong> antiradarov (a im podobných zariadení) alebo ich <strong>umiestnenie</strong> vo vozidle spôsobom, ktorý umožňuje ich použitie, je zakázané. Preto by vodiči nemali mať vo svojom vozidle takéto zariadenie ani umiestnené, inak musia rátať s pokutou.\nPoužívanie antiradarov a laserových rušičiek je teda na Slovensku zakázané!  Ak antiradar policajti pri kontrole odhalia, možu vodičovi vyrubiť niekoľkotisícovú pokutu alebo mu dokonca vziať technický preukaz. "Používať technické prostriedky a zariadenia, ktoré umožňujú odhaliť alebo ovplyvniť policajné radary merajúce rýchlosť na cestách, nový zákon jednoznačne zakazuje". Antiradary komplikujú polícii prácu pri dohľade nad bezpečnosťou cestnej premávky. Pre mužov v uniformách sú nebezpečnejšie tzv. rušičky, ničia signál policajného merača, na rozdiel od pasívnych antiradarov, ktoré iba policajný radar zamerajú.\nAk polícia odhalí pri kontrole v aute antiradar, či už pasívny detektor alebo rušičku, môže na mieste dať vodičovi blokovú pokutu vo výške 250e. Ak by mal niekto pevne namontovaný antiradar, tak takému vodičovi môže polícia zadržať osvedčenie o evidencii vozidla.</p>\n									</div><!-- end panel-body -->\n								</div><!-- end collapseOne -->\n							</div><!-- end panel -->\n							<div class="panel panel-default">\n								<div class="panel-heading">\n									<h4 class="panel-title">\n                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Čo potrebujem na Slovensku? Antiradar alebo laserovú rušičku?</a>\n									</h4>\n								</div><!-- end panel-heading -->\n								<div id="collapseThree" class="panel-collapse collapse">\n									<div class="panel-body">\n                                        <p>Ideálna je kombinácia oboch zariadení. Antiradar síce dokáže detekovať meranie laserovým meračom rýchlosti, ale obvykle je už neskoro a Vaša rýchlosť je zameraná. Je to hlavne preto, že antiradar nemá až taký dosah, aby dokázal spoľahlivo a včas reagovať na meranie. Laserová rušička dokáže rušiť meranie iba laserovým meračom rýchlosti. Na meranie rýchlosti radarom typu Ramer nemá žiadnu činnosť, ani vodiča o tomto meraní neinformuje.\nPreto ideálne riešenie je kombinácia týchto dvoch zariadení - antiradar a laserová rušička.</p>\n									</div><!-- end panel-body -->\n								</div><!-- end collapseOne -->\n							</div><!-- end panel -->\n							<div class="panel panel-default">\n								<div class="panel-heading">\n									<h4 class="panel-title">\n                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">Ktoré frekvencie je potrebné ponechať zapnuté pre používanie antiradarov na Slovensku a v ČR?</a>\n									</h4>\n								</div><!-- end panel-heading -->\n								<div id="collapseFour" class="panel-collapse collapse">\n									<div class="panel-body">\n                                        <p>Ktoré frekvencie je potrebné ponechať zapnuté pre používanie antiradarov na Slovensku a v ČR?</p>\n<p>Radary typu RAMER 7 a AD9 (používané v SK a CZ) pracujú vo frekvenčnom rozsahu 34,00GHz +/- 100MHz. Niekedy tieto radary spadajú pod spodnú alebo vrchnú časť frekvenčného rozsahu. Tento efekt vzniká pri vyšších teplotách, kedy sa mierne zmenia rozmery rezonančnej dutinky v policajnom radare alebo k zmene rozmeru došlo pri náraze na radarovú hlavicu. Následne klesne jeho pracovná frekvencia. Preto je potrebné mať na Slovensku zapnuté operačné pásmo v tomto rozsahu\n<br />( pásmo Ka, Ka Narrow - podľa typu použitého antiradaru)\n</p>\n									</div><!-- end panel-body -->\n								</div><!-- end collapseOne -->\n							</div><!-- end panel -->\n							<div class="panel panel-default">\n								<div class="panel-heading">\n									<h4 class="panel-title">\n                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">Aké sú pokuty za prekročenie rýchlosti na Slovensku?</a>\n									</h4>\n								</div><!-- end panel-heading -->\n								<div id="collapseFive" class="panel-collapse collapse">\n									<div class="panel-body">\n                                        <p>Prekročenie najvyššej dovolenej rýchlosti ustanovenej pravidlami cestnej premávky alebo prekročenie rýchlosti obmedzenej dopravnou značkou</p>\n<pre>\n1. o viac ako 10 km/h                           50 Eur / 1.506,30 Sk\n2. o viac ako 20 km/h                           100 Eur / 3.012,60 Sk\n3. o viac ako 30 km/h                           200 Eur / 6.025,20 Sk\n4. o viac ako 40 km/h                           300 Eur / 9.037,80 Sk\n5. o viac ako 50 km/h                           400 Eur / 12.050,40 Sk\n6. o viac ako 60 km/h                           500 Eur / 15.063,00 Sk\n7. o viac ako 70 km/h                           650 Eur / 19.581,90 Sk\n</pre>\n<p>\n<strong>POZOR!</strong> Pri 3 pokutách za rýchlosť nad 60 € počas roka Vám hrozí dočasné <strong>odobratie VP</strong> a následné preskúšanie spojené s príslušnými poplatkami.\n</p>\n									</div><!-- end panel-body -->\n								</div><!-- end collapseOne -->\n							</div><!-- end panel -->\n							\n<div class="panel panel-default">\n								<div class="panel-heading">\n									<h4 class="panel-title">\n                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseSix">Koľko snímačov laserovej rušičky postačuje pre 100% ochranu pred laserovými meračmi rýchlosti?</a>\n									</h4>\n								</div><!-- end panel-heading -->\n								<div id="collapseSix" class="panel-collapse collapse">\n									<div class="panel-body">\n                                        <p>Počet snímačov sa môže líšiť od použitej laserovej rušičky a od vozidla, v ktorom je systém namontovaný. V menších vozidlách pri použití Antilaser G9 RX postačí na ochranu proti zameraniu spredu jeden snímač. Pokiaľ chcete byť chránený aj proti zameraniu zozadu, je potrebný ešte jeden snímač namontovaný v zadnej časti vozidla. Pokiaľ je vozidlo väčšie a chcete mať 100% ochranu je potrebné použiť viac snímačov.</p>\n									</div><!-- end panel-body -->\n								</div><!-- end collapseOne -->\n							</div><!-- end panel -->\n							<div class="panel panel-default">\n								<div class="panel-heading">\n									<h4 class="panel-title">\n                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseSeven">Prečo u nás tzv. americké verzie antiradarov Escort a Beltronics nefungujú spoľahlivo?</a>\n									</h4>\n								</div><!-- end panel-heading -->\n								<div id="collapseSeven" class="panel-collapse collapse">\n									<div class="panel-body">\n                                        <p>Vzhľadom na to, že radarové merače typu Ramer 7 a AD9 pracujú vo frekvenčnom pásme 34,00 GHz +/- 100 MHz používanom len na SK a ČR, americké verzie nedokážu spoľahlivo detekovať toto frekvenčné pásmo a pracujú s veľkou chybovosťou.</p>\n									</div><!-- end panel-body -->\n								</div><!-- end collapseOne -->\n							</div><!-- end panel -->\n<div class="panel panel-default">\n								<div class="panel-heading">\n									<h4 class="panel-title">\n                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseEight">Čo najčastejšie spôsobuje falošné poplachy u antiradarov?</a>\n									</h4>\n								</div><!-- end panel-heading -->\n								<div id="collapseEight" class="panel-collapse collapse">\n									<div class="panel-body">\n                                        <p>Dôležité je, aby bol antiradar správne nastavený na operačné pásmo krajiny, v ktorej je požívaný. Zapnutie iných pásiem môže spôsobovať detekciu tzv. rádio smogu, ktorý vzniká pri bežnom priemyselnom používaní nevyfiltrovaných lokálnych vysielačov a iných vysokofrekvenčných zdrojov (radarové detektory pri automaticky otváraných dverách atd.).</p>\n									</div><!-- end panel-body -->\n								</div><!-- end collapseOne -->\n							</div><!-- end panel -->\n<div class="panel panel-default">\n								<div class="panel-heading">\n									<h4 class="panel-title">\n                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseNine">Čo môže najčastejšie zapríčiniť zlyhanie laserovej rušičky pri meraní?</a>\n									</h4>\n								</div><!-- end panel-heading -->\n								<div id="collapseNine" class="panel-collapse collapse">\n									<div class="panel-body">\n                                        <p>Medzi najčastejšie príčiny nesprávnej funkcie laserovej rušičky patria nesprávna montáž senzorov (postupujte podľa montážnych návodov) a nečistoty na prednej strane senzorov. Pokiaľ sú senzory správne namontované laserová rušička pracuje 100% a Vaše vozidlo nebude zamerané.</p>\n									</div><!-- end panel-body -->\n								</div><!-- end collapseOne -->\n							</div><!-- end panel -->\n<div class="panel panel-default">\n								<div class="panel-heading">\n									<h4 class="panel-title">\n                                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapseTen">Aké sú slabiny policajných radarov?</a>\n									</h4>\n								</div><!-- end panel-heading -->\n								<div id="collapseTen" class="panel-collapse collapse">\n									<div class="panel-body">\n                                        <p>- radar RAMER vždy zviera s osou vozovky 22-stupňový uhol<br />\n- osové zakrivenie cesty nesmie byť vyššie ako 10 cm na 25 m vozovky v horizontálnom smere<br />\n- rýchlosť sa teda nedá merať z mosta, prípadne v oblukov cesty, dochádzalo by k skresľovaniu výsledkov<br />\n- chyba pri meraní nesmie byť vyššia ako plus/mínus 3 km/h. Pri extrémne prudkom spomalení teda vyhodnotí meranie ako chybné<br />\n- pri meraní za jazdy sa počas jedného merania (cca 2 s) nesmie rýchlosť zmeniť o viac ako 2 km/h, inak sa meranie anuluje</p>\n									</div><!-- end panel-body -->\n								</div><!-- end collapseOne -->\n							</div><!-- end panel -->\n						</div><!-- end panel-group -->\n					</div><!-- end about tabbed -->\n\n                </div>', 0, 'faq-caste-otazky', 398, 0, 0, 0, 0, '2014-07-03 20:55:34', 0, 9, 25),
(10, 'Obchodné podmienky', '', '<h1>Obchodné podmienky</h1><div class="space"></div>\n<h2>Objednávky</h2>\n<div class="art">Objednávať tovar je možné cez e-shop, telefonicky, faxom, e-mailom alebo osobne.<br /> Objednávky prijaté do 14.00 hod budú expedované ešte v ten pracovný deň, ak je tovar aktuálne na sklade. V prípade, že tovar nebude na sklade v požadovanom množstve, bude o tom zákazník informovaný.<br /> Objednávky prijaté po 14.00 hod budú expedované nasledujúci pracovný deň.</div>\n<h2>Platba za tovar</h2>\n<div class="art">Platba predom prevodom na účet alebo dobierkou cez kuriársku službu UPS.</div>\n<h2>Doprava tovaru</h2>\n<div class="art">Prepravu tovaru zabezpečuje kuriárska služba UPS Expres, pri objednávke nad 200 EUR hradí prepravné náklady predávajíci.</div>\n<h2>Reklamácie</h2>\n<div class="art">Dĺžka záručnej doby je štandardne 24 mesiacov. Reklamovaný tovar musí byť kompletný a nesmie byť mechanicky poškodený (odlomené časti, prelepované čtôtky sériových čísel), ani elektricky poškodený (napr. prepálovanie, ohorené konektory). K tovaru musí byť priložený riadne vyplnený záručný list.</div>', 0, 'obchodne-podmienky', 219, 1, 0, 0, 0, '2014-07-03 21:00:39', 0, 9, 25),
(11, 'Montáž', '', '<h1>Montáž antiradarov a laserových rušičiek</h1><div class="space"></div>\n<p> </p>\n<p> </p>\n<p>Montáž zabudovateľných antiradarov a laserových rušičiek  zabezpečujeme v našej prevádzke:</p>\n<p><br /> <strong>KELKOS, s.r.o. - Antiradary.sk, Domkárska 17, 821 05 Bratislava</strong></p>\n<p>Zariadenia vieme namontovať aj priamo u zákazníka, kdekoľvek na Slovensku, alebo v širokej sieti našich obchodných partnerov.<p> \n<p><br/>Objednanie montáže a bližšie informácie poskytujeme na tel. č.: 0910 800 011</p>\n', 0, 'montaz', 346, 0, 0, 0, 0, '2014-07-03 21:02:02', 0, 9, 25),
(12, 'Kontakt', '', '<div id="white-wrapper">\n     <div class="container padd-20">\n             <table>\n                                <tr>\n                                    <td><img src="../images/frontend/provozovna.jpg" class="wd-300" alt="provozovna"/></td>\n                                    <td class="valign-top wd-340">\n                                        <span  class="panel-title-20">\n                                            <strong>&nbsp;&nbsp;&nbsp;KELKOS, s. r. o. - Antiradary.sk</strong>\n                                        </span><br/>\n\n                                        <strong>&nbsp;&nbsp;&nbsp;&nbsp;Naša prevádzka v Bratislave</strong><br/>\n                                        &nbsp;&nbsp;&nbsp;&nbsp;Domkárska 17<br/>\n                                        &nbsp;&nbsp;&nbsp;&nbsp;821 05 Bratislava<br/>\n                                        &nbsp;&nbsp;&nbsp;&nbsp;Slovenská republika\n                                    </td>\n                                    <td class="wd-450">\n                                        <table>\n                                            <tr>\n                                                <td>&nbsp;</td>\n                                                <td class="right-align">&nbsp;</td>\n                                            </tr>\n                                            <tr>\n                                                <td>&nbsp;</td>\n                                                <td class="right-align">&nbsp;</td>\n                                            </tr>\n                                            <tr>\n                                                <td>IČO:</td>\n                                                <td class="right-align">47626623</td>\n                                            </tr>\n                                            <tr>\n                                                <td>IČ DPH:</td>\n                                                <td class="right-align">SK2024009625</td>\n                                            </tr>\n                                            <tr>\n                                                <td>Bankovné spojenie:</td>\n                                                <td class="right-align">&nbsp;&nbsp;<strong>FIO, banka, a.s. 2700544542/8330</strong></td>\n                                            </tr>\n                                        </table>\n                                    </td>\n                                </tr>\n                            </table>\n                        </div>\n                    </div>\n<div class="row padding-top margin-top">\n                                        <div class="contact_details">\n                                            <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">\n                                                <div class="text-center">\n                                                    <div class="wow swing animated">\n							<div class="contact-icon">\n                                                            <a href="#" class=""> <i class="fa"><img src=''../images/frontend/icons/point.png'' alt="point"/></i> </a>\n							</div><!-- end dm-icon-effect-1 -->\n                                                        <p>\n                                                            KELKOS, s.r.o. Štefánikova 1398/36<br/>\n                                                            071 01 Michalovce, Slovenská republika<br/>\n                                                        </p>\n                                                    </div><!-- end service-icon -->\n                                                </div><!-- end miniboxes -->\n                                            </div><!-- end col-lg-4 -->\n                \n                                            <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">\n                                                <div class="text-center">\n                                                    <div class="wow swing animated">\n							<div class="contact-icon">\n                                                            <a href="#" class=""> <i class="fa"><img src=''../images/frontend/icons/telephone.png'' alt="telephone"/></i> </a>\n							</div><!-- end dm-icon-effect-1 -->\n                                                        <p>\n                                                            Objednávky: 0910 800 011<br/>\n                                                            Informácie, technické otázky: 0910 800 011\n                                                        </p>\n                                                    </div><!-- end service-icon -->\n                                                </div><!-- end miniboxes -->\n                                            </div><!-- end col-lg-4 -->  \n\n                                            <div class="col-lg-4 col-sm-4 col-md-6 col-xs-12">\n                                                <div class="text-center">\n                                                    <div class="wow swing animated">\n							<div class="contact-icon">\n                                                            <a href="#" class=""> <i class="fa"><img src=''../images/frontend/icons/email.png'' alt="email"/></i> </a>\n							</div><!-- end dm-icon-effect-1 -->\n                                                        <p>\n                                                            Objednávky: objednavky@antiradary.sk<br/>\n                                                            Informácie: info@antiradary.sk\n                                                        </p>\n                                                    </div><!-- end service-icon -->\n                                                </div><!-- end miniboxes -->\n                                            </div><!-- end col-lg-4 -->                  \n                                        </div><!-- end contact_details -->\n                                    </div><!-- end margin-top --><br><br>\n    <section class="white-wrapper nopadding">\n    	<div class="container wd-100p">\n            <div id="map" class="contact-map">\n               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1331.153794430871!2d17.176731251522828!3d48.142874964589794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDjCsDA4JzMzLjYiTiAxN8KwMTAnMzUuNyJF!5e0!3m2!1scs!2s!4v1405370790473" class="wd-100p bnull" height="450"></iframe>\n        </div>', 0, 'kontakt', 563, 0, 0, 0, 0, '2014-07-03 21:02:51', 0, 9, 25);

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_panels`
--

CREATE TABLE IF NOT EXISTS `prefix_panels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `icon` varchar(150) DEFAULT NULL,
  `content` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `position` varchar(1) NOT NULL DEFAULT 'R',
  `priority` int(10) unsigned NOT NULL DEFAULT '0',
  `visibility` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Vypisuji data pro tabulku `prefix_panels`
--

INSERT INTO `prefix_panels` (`id`, `name`, `icon`, `content`, `date`, `position`, `priority`, `visibility`) VALUES
(2, 'footer', '', '<footer id="footer-style-1">\n    	<div class="container">\n              <div class="left-align footer-1">Výhradný distributor Escort Radar, Genevo, Blinder pre Slovensko\n<div class="right-align footer-2"><img src="/images/frontend/provozovna.jpg" width="300" alt="provozovna"/><br/><br/>\n                        <span class="footer-3">Naša prevádzka v Bratislave</span><br/>\n                        <span class="footer-4">Domkárska 17, 821 05 Bratislava</span></div><br/><br/><img src="/images/frontend/logo/logo_genevo.png" class="footer-logo-left-top" alt="genevo logo"/><img src="/images/frontend/logo/logo_escort.png" class="footer-logo-right-top" alt="escort logo"/><br/><img src="/images/frontend/logo/logo_blinder.png" class="footer-logo-left-bottom" alt="logo blinder"/><img src="/images/frontend/logo/logo_beltronics.png" class="footer-logo-right-bottom" alt="beltronics logo"/></div>\n        </div><!-- end columns -->\n    </footer><!-- end #footer-style-1 -->\n', '2014-07-03 22:14:08', 'B', 0, 1),
(3, 'Copyright', '', '<div id="copyrights">\n    	<div class="container">\n            <div class="col-lg-5 copyright-1">\n                <div class="copyright-text">\n                    <p>Copyright © 2014 - Antiradary.sk</p>\n                </div><!-- end copyright-text -->\n            </div><!-- end widget -->\n            <div class="col-lg-7 clearfix copyright-2">\n		<div class="footer-menu">  \n                    <ul class="menu right-align">\n\n\n<script>\n  (function(i,s,o,g,r,a,m){i[''GoogleAnalyticsObject'']=r;i[r]=i[r]||function(){\n  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\n  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\n  })(window,document,''script'',''//www.google-analytics.com/analytics.js'',''ga'');\n\n  ga(''create'', ''UA-53443536-1'', ''auto'');\n  ga(''send'', ''pageview'');\n\n</script>', '2014-07-16 10:28:47', 'B', 0, 1);

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_security_admin_keys`
--

CREATE TABLE IF NOT EXISTS `prefix_security_admin_keys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=885 ;

--
-- Vypisuji data pro tabulku `prefix_security_admin_keys`
--

INSERT INTO `prefix_security_admin_keys` (`id`, `created`) VALUES
(881, 1408020477),
(883, 1408020492),
(884, 1408020509);

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_settings`
--

CREATE TABLE IF NOT EXISTS `prefix_settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `prefix_settings`
--

INSERT INTO `prefix_settings` (`id`, `name`, `value`) VALUES
(1, 'siteurl', 'Narwhal CMS'),
(2, 'sitename', 'Narwhal CMS powered by Blacklist'),
(3, 'sitedescription', 'dasd asd asd asd asdas dasd asd asd asdnjaksd ka'),
(4, 'user_can_register', '0'),
(5, 'site_email', 'tomas.petr@bk.ru'),
(6, 'use_smiles', '0'),
(7, 'require_registration_email', '0'),
(8, 'copyright', ''),
(9, 'social', ''),
(10, 'footer', ''),
(11, 'pagination', '4'),
(12, 'comment_only_user', '1'),
(13, 'username', ''),
(14, 'surname', ''),
(15, 'web_phone', '123456789'),
(16, 'web_title', 'Narwhal-cms.com'),
(17, 'keywords', 'prvni, druhy, treti, ctvrty, paty, sesty, sedmej'),
(18, 'log_number', '50');

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_subcategories`
--

CREATE TABLE IF NOT EXISTS `prefix_subcategories` (
  `parent` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`parent`,`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_submenus`
--

CREATE TABLE IF NOT EXISTS `prefix_submenus` (
  `menu` int(10) unsigned NOT NULL,
  `submenu` int(10) unsigned NOT NULL,
  PRIMARY KEY (`menu`,`submenu`),
  KEY `fk_prefix_menus_has_prefix_menus_prefix_menus2_idx` (`submenu`),
  KEY `fk_prefix_menus_has_prefix_menus_prefix_menus1_idx` (`menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `prefix_submenus`
--

INSERT INTO `prefix_submenus` (`menu`, `submenu`) VALUES
(14, 19),
(14, 21),
(27, 28),
(27, 29),
(27, 30),
(27, 31),
(27, 32);

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_tags`
--

CREATE TABLE IF NOT EXISTS `prefix_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `article` int(10) unsigned DEFAULT NULL,
  `page` int(10) unsigned DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=325 ;

--
-- Vypisuji data pro tabulku `prefix_tags`
--

INSERT INTO `prefix_tags` (`id`, `article`, `page`, `tag`) VALUES
(60, NULL, NULL, 'sda'),
(61, NULL, NULL, 'dsad'),
(62, NULL, NULL, 'as'),
(68, NULL, NULL, 'faq'),
(69, NULL, NULL, 'caste'),
(70, NULL, NULL, 'otazky'),
(71, NULL, NULL, 'antiradary'),
(73, NULL, NULL, 'obchodne'),
(74, NULL, NULL, 'podmienky'),
(75, NULL, NULL, 'antiradary'),
(76, NULL, NULL, 'montaz'),
(77, NULL, NULL, 'antiradary'),
(78, NULL, NULL, 'kontakt'),
(98, NULL, NULL, ''),
(99, NULL, NULL, ''),
(100, NULL, NULL, ''),
(101, NULL, NULL, ''),
(102, NULL, NULL, ''),
(103, NULL, 16, ''),
(104, NULL, 17, ''),
(107, NULL, NULL, ''),
(108, NULL, NULL, ''),
(109, NULL, NULL, ''),
(112, NULL, 14, ''),
(150, NULL, 20, ''),
(151, NULL, NULL, ''),
(209, NULL, NULL, 'sdd'),
(210, NULL, NULL, ''),
(211, NULL, 22, ''),
(214, NULL, NULL, ''),
(215, NULL, NULL, ''),
(216, NULL, 24, ''),
(273, 16, NULL, ''),
(281, NULL, 11, ''),
(310, NULL, 12, ''),
(311, NULL, 9, ''),
(312, 17, NULL, ''),
(314, 9, NULL, ''),
(318, 10, NULL, ''),
(319, 11, NULL, ''),
(322, 12, NULL, ''),
(324, 15, NULL, '');

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_tasks`
--

CREATE TABLE IF NOT EXISTS `prefix_tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `createDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin,
  `comment` text CHARACTER SET utf8 COLLATE utf8_bin,
  `author` int(11) DEFAULT NULL,
  `phone` varchar(1) NOT NULL DEFAULT 'n',
  `email` varchar(1) NOT NULL DEFAULT 'n',
  `image` varchar(255) NOT NULL,
  `done` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_userinfos`
--

CREATE TABLE IF NOT EXISTS `prefix_userinfos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `birthday` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `facebook` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user`),
  KEY `fk_prefix_userinfos_prefix_users1_idx` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Vypisuji data pro tabulku `prefix_userinfos`
--

INSERT INTO `prefix_userinfos` (`id`, `username`, `surname`, `birthday`, `facebook`, `skype`, `user`) VALUES
(8, 'Admin', 'Admin', '0000-00-00 00:00:00', '', '', 9);

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_users`
--

CREATE TABLE IF NOT EXISTS `prefix_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastLogin` int(11) NOT NULL DEFAULT '0',
  `adminLevel` varchar(10) NOT NULL DEFAULT 'guest',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Vypisuji data pro tabulku `prefix_users`
--

INSERT INTO `prefix_users` (`id`, `account`, `password`, `email`, `registrationDate`, `lastLogin`, `adminLevel`) VALUES
(9, 'admin', '7fcf4ba391c48784edde599889d6e3f1e47a27db36ecc050cc92f259bfac38afad2c68a1ae804d77075e8fb722503f3eca2b2c1006ee6f6c7b7628cb45fffd1d', 'admin@admin.ru', '2014-08-14 00:49:35', 0, 'admin');

-- --------------------------------------------------------

--
-- Struktura tabulky `prefix_widgets`
--

CREATE TABLE IF NOT EXISTS `prefix_widgets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_bin,
  `priority` int(11) DEFAULT NULL,
  `visibility` int(1) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Vypisuji data pro tabulku `prefix_widgets`
--

INSERT INTO `prefix_widgets` (`id`, `class`, `name`, `content`, `priority`, `visibility`, `user`, `type`) VALUES
(1, 'white-wrapper', 'Nadpis', '<div class="container">\n                <div class="messagebox">\n                    <h2>\n                        Neviete si rady s výberom správneho antiradaru?<br>\n                        Kontaktujte našich odborníkov na telefóne <span class="header-co"><strong>0910 80 00 11</strong></span><br>\n                        alebo nás navštívte na prevádzke v Bratislave.\n</h2>\n                    </div>\n                <!-- end messagebox -->\n            </div>', 1, 1, 9, 'html'),
(2, 'grey-wrapper jt-shadow padding-top', 'kategorie', '<div class="container">\n            <h2 class="panel-title-40 center-align">Ponúkame iba tie najlepšie antiradary pre Váš automobil</h2>\n    <div class="col-lg-4 first">\n        <div class="service-with-image">\n            <div class="entry">\n                 <a href="/produkty/prenosne-antiradary"><img src="http://www.antiradary.sk/images/produkty/prenosne-antiradary.jpg" class="img-responsive wd-365" alt="přenosné antiradary"></a>\n                <span class="service-title">\n                    <a href="/produkty/prenosne-antiradary"><span class="fa"></span>PRENOSNÉ ANTIRADARY</a>\n                </span>\n            </div><!-- end entry -->\n            <div class="service-desc wd-365">\n                <p>Ponúkame Vám najlepšie prenosné antiradary, ktoré môžete dnes nájsť na trhu. Pasívne radarové detektory sú spoľahlivou ochranou pred meračmi rýchlosti typu RAMER a MULTARADAR CD.</p>\n                <a href="/produkty/prenosne-antiradary" class="readmore">Čítajte Viac...</a>\n            </div><!-- end service-desc -->\n        </div><!-- end service-with-image -->\n    </div><!-- end col-lg-4 -->\n    <div class="col-lg-4">\n        <div class="service-with-image">\n            <div class="entry">\n                <a href="/produkty/pevne-antiradary"><img src="http://www.antiradary.sk/images/produkty/pevne-antiradary.jpg" class="img-responsive wd-365" alt="pevné antiradary"></a>\n                    <span class="service-title">\n                        <a href="/produkty/pevne-antiradary"><span class="fa"></span>PEVNÉ ANTIRADARY</a>\n                    </span>\n            </div><!-- end entry -->\n            <div class="service-desc wd-365">\n                <p>Dokonalejšou formou antiradarov sú určite zabudované resp. pevné antiradary. Ponúkame osvedčené modely zabudovateľných antiradarov. Ideálne riešenie pre vozidlá s pokovenými sklami.</p>\n                <a href="/produkty/pevne-antiradary" class="readmore">Čítajte Viac...</a>\n            </div><!-- end service-desc -->\n        </div><!-- end service-with-image -->\n    </div><!-- end col-lg-4 -->\n    \n    <div class="col-lg-4">\n        <div class="service-with-image">\n            <div class="entry">\n                <a href="/produkty/laserove-rusicky"><img src="http://www.antiradary.sk/images/produkty/laserove-rusicky.jpg" class="img-responsive wd-365" alt="laserové rušičky"></a>\n                <span class="service-title">\n                    <a href="/produkty/laserove-rusicky"><span class="fa"></span>LASEROVÉ RUŠIČKY</a>\n                </span>\n            </div><!-- end entry -->\n            <div class="service-desc wd-365">\n                <p>Najúčinnejšia ochrana pred laserovými meračmi na cestách. Široký výber najpoužívnejších laserových rušičiek - značky ako BLINDER a LASER INTERCEPTOR Vás spoľahlivo ochránia pred pokutami. </p>\n                <a href="/produkty/laserove-rusicky" class="readmore">Čítajte Viac...</a>\n            </div><!-- end service-desc -->\n        </div><!-- end service-with-image -->\n    </div><!-- end col-lg-4 -->\n\n</div><!-- end service-desc -->', 2, 1, 9, 'latte'),
(3, 'white-wrapper', 'spodní', '<div class="container padd-bot">\n<div class="messagebox">\n<h2>\nSme najväčším predajcom antiradarov na Slovensku...<br/>\n</h2>\n<p class="left-align">Sme výhradným distribútorom antiradarov značky ESCORT, BLINDER a GENEVO pre Slovenskú republiku. Veríme, že naša úzka spolupráca s týmito výrobcami, ktorí sú špičkou vo svojom odbore, prinesie našim zákazníkom viac nových produktov a viac spokojnosti.</p>\n\n<p class="left-align">Ak patríte k ľuďom, ktorí majú radi rýchlosť a nechcete platiť pokuty, ste na správnej adrese. V našom internetovom obchode nájdete široký výber radarových detektorov - antiradarov a laserových rušičiek, ktoré Vás spoľahlivo ochránia pred policajnými meračmi rýchlosti. V našom sortimente nájdete len overené a kvalitné značky a to za najlepšie ceny na trhu. Naviac u nás neplatíte prepravné náklady a objednaný tovar vám dovezieme do 24 hodín.</p>\n\n<p class="left-align">Stačí si len vybrať ten správny antiradar...</p></div><!-- end messagebox -->\n</div><!-- end container -->', 3, 1, 9, 'html'),
(6, 'grey-wrapper jt-shadow padding-top', 'zaujímavé informacie', '<div class="container padd-bot">\n    <h2 class="panel-title-40 center-align">Zaujímavé informácie o antiradaroch</h2>\n        <div class="services_vertical">\n        {foreach $articles as $artc}\n           {if $artc->image != ''''}\n              <div class="col-lg-4">\n                 <table>\n                    <tr class="fl-left">\n                       <td class="padd-top-24"><img src="{$basePath}/{$artc->image}" width="100" alt="{$artc->title}"/></td>\n                       <td class="padd-left-10 valign-top"><a href="/informacie-o-antiradaroch/{$artc->link}"><h3>{$artc->title|truncate:50}</h3></a>{$artc->description|truncate:80}</td></tr></table></div>\n           {else}\n                <div class="col-lg-4">\n                  <table>\n                    <tr>\n                      <td class="padd-10"><a href="/informacie-o-antiradaroch/{$artc->link}"><h3>{$artc->title}</h3></a>{$artc->description|truncate:80}</td></tr></table></div>\n           {/if}\n{/foreach}\n<div class="clearfix"></div>\n</div><!-- end container -->\n</div>', 4, 1, 9, 'latte');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
