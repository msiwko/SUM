-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 05 Mar 2021, 09:08
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `forum`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `comment_ID` int(11) NOT NULL,
  `comment_author_ID` int(11) NOT NULL,
  `post_ID` int(11) NOT NULL,
  `comment_content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`comment_ID`, `comment_author_ID`, `post_ID`, `comment_content`) VALUES
(1, 2, 1, 'komentarz test 1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `post_ID` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `author_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`post_ID`, `content`, `author_ID`) VALUES
(1, 'Wczoraj wróciłem z weekendowego wypadu wędkarskiego i jedyne co wiem to, że sum jest większy niż twój. 21,37 kg i 89 cm długości :) Pochwalcie się swoimi sumami', 2),
(2, 'Złowiłem wczoraj płotkę o wadze 0,22 kg, to dopiero bydle. Co myślicie?', 2),
(3, 'Zarybianie stawów sumami jest destruktywne dla żyjącej tam fauny i flory, a tego typu zbiorniki są zazwyczaj zbyt małe by pomieścić tak wielkie ryby, zarybiajcie z głową!', 2),
(4, 'Wczoraj miałem na haku tak ogromną rybę że wyrwała mi z rąk wędkę i wciągnęła ją do wody, rzuciłem się za nią i próbowałem dogonić tę rybę ale niestety mi się nie udało :(', 2),
(5, 'Ukleje jak ja ich nienawidzę, te huncwoty nie potrafią nawet tak ugryść robaka, że się na hak łapią tylko biorą gryzy mniejsze niż dziecko mające jeść brokuły. Dlatego właśnie rozpoczynam krucjatę żeby pozbyć się tych parszywców z Polskich wód. Czas na os', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ranks`
--

CREATE TABLE `ranks` (
  `rank_ID` int(11) NOT NULL,
  `rank_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `ranks`
--

INSERT INTO `ranks` (`rank_ID`, `rank_name`) VALUES
(1, 'Ukleja'),
(2, 'Płotka'),
(3, 'Okoń'),
(4, 'Karp'),
(5, 'Szczupak'),
(6, 'Sum'),
(99, 'Admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `rank_ID` int(11) NOT NULL,
  `register_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`ID`, `login`, `password`, `question`, `rank_ID`, `register_date`) VALUES
(2, 'Neon, Igliczunia, Gębacz, Gupik, Arapaima', 'c380f833034d60bf035a134094eb538d600dc6f9', 'imie', 99, '2021-02-26'),
(25, 'RybakPL', 'ab2467706ba38309fafcc9d86d79291eacbaaed1', 'imie', 99, '2021-02-26'),
(31, 'Maciek', 'c380f833034d60bf035a134094eb538d600dc6f9', 'imie', 1, '2021-02-27'),
(32, 'rybson', '2254139645ffdd350372a68e0cc4271731019751', 'imie', 1, '2021-03-01');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_ID`);

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_ID`);

--
-- Indeksy dla tabeli `ranks`
--
ALTER TABLE `ranks`
  ADD PRIMARY KEY (`rank_ID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `post_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT dla tabeli `ranks`
--
ALTER TABLE `ranks`
  MODIFY `rank_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
