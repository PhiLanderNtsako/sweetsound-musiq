SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+02:00";

--
-- Database: `sweet_sound_musiq_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
    `admin_id` int(12) NOT NULL,
    `admin_username` varchar(100) NOT NULL,
    `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'Philander', 'Philander');

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
    `artist_id` int(12) NOT NULL,
    `artist_name` varchar(100) NOT NULL,
    `artist_name_slug` varchar(100) NOT NULL,
    `artist_image` varchar(200) NOT NULL,
    `artist_page_views` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `artist_name`, `artist_name_slug`, `artist_image`, `artist_page_views`) VALUES
(1, 'Aureiiy Beeze', 'AureiiyBeeze', 'aureiiy-beeze.png', 97),
(2, 'Buven Thepoet', 'Buven', 'buven-thepoet.png', 78),
(3, 'Deeniey Daniels', 'DeenieyDaniels', 'deeniey-daniels.png', 39),
(4, 'J-Lex', 'J-Lex', 'j-lex.png', 47),
(5, 'Kaity Lander', 'KaityLander', 'kaity-lander.png', 45),
(6, 'Karabo', 'Karabo', 'karabo.png', 41),
(7, 'King Thyra', 'KingThyra', 'king-thyra.png', 44),
(8, 'Lula Creez', 'LulaCreez', 'lula-creez.png', 45),
(9, 'PhiCol', 'Phicol', 'phicol.png', 46),
(10, 'PhiLander', 'Philander', 'philander.png', 71),
(11, 'Pine', 'Pine', 'pine.png', 45),
(12, 'Scholtz GodMc', 'ScholtzGodMc', 'scholtz-godmc.png', 51),
(13, 'Starrcy Envy', 'StarrcyEnvy', 'starrcy-envy.png', 44),
(14, 'Starvi', 'Starvi', 'starvi.png', 52),
(15, 'Sweet Sound Musiq', 'SSM', 'ssm.png', 104),
(16, 'Young Stars Fam', 'YSF', 'ysf.png', 54),
(17, 'Keo Matsi', 'KeoMatsi', 'keomatsi.jpg', 66),
(18, 'J Munich', 'J-Munich', 'j-munich.jpg', 65),
(19, 'Short Vocals', 'ShortVocals', 'shortvocals.jpg', 39),
(20, 'Dj Black Novel', 'DjBlackNovel', 'djblacknovel.jpg', 20),
(21, 'Legendary', 'Legendary', 'legendary.jpg', 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
    `user_id` int(12) NOT NULL,
    `user_email` varchar(100) NOT NULL,
    `user_passoword` varchar(100) NOT NULL,
    `user_username` varchar(100) NOT NULL,
    `user_gender` varchar(200) NOT NULL,
    `user_towncity` varchar(200) NOT NULL,
    `user_province` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `social_media_links`
--

CREATE TABLE `social_media_links` (
    `sml_id` int(12) NOT NULL,
    `artist_id` int(12) NOT NULL,
    `sml_whatsapp` varchar(200) NOT NULL,
    `sml_facebook` varchar(200) NOT NULL,
    `sml_twitter` varchar(200) NOT NULL,
    `sml_instagram` varchar(200) NOT NULL,
    `sml_youtube` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------------------------------------

--
-- Table structure for table `musiq`
--

CREATE TABLE `musiq` (
    `musiq_id` int(12) NOT NULL,
    `artist_id` int(12) NOT NULL,
    `active_yn` smallint(1) DEFAULT '0' NOT NULL,
    `musiq_type` varchar(200) NOT NULL,
    `musiq_title` varchar(200) NOT NULL,
    `musiq_title_slug` varchar(200) NOT NULL,
    `musiq_genre` varchar(100) NOT NULL,
    `musiq_coverart` varchar(200) NOT NULL,
    `musiq_file` varchar(200) NOT NULL,
    `musiq_release_date` date NOT NULL,
    `musiq_downloads` bigint(20) DEFAULT '0' NOT NULL,
    `musiq_plays` bigint(20) DEFAULT '0' NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `musiq_count`
--

CREATE TABLE `musiq_count` (
    `musiq_count_id` int(12) NOT NULL,
    `musiq_id` int(12) NOT NULL,
    `user_id` int(12) NOT NULL,
    `downloads` bigint(20) DEFAULT '0' NOT NULL,
    `plays` bigint(20) DEFAULT '0' NOT NULL,
    `likes` bigint(20) DEFAULT '0' NOT NULL,
    `views` bigint(20) DEFAULT '0' NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `musiq_links`
--

CREATE TABLE `musiq_links` (
    `link_id` int(12) NOT NULL,
    `musiq_id` int(12) NOT NULL,
    `link_sweetsoundmusiq` varchar(200) NOT NULL,
    `link_genius_lyrics` varchar(200) NOT NULL,
    `link_spotify` varchar(200) NOT NULL,
    `link_youtube` varchar(200) NOT NULL,
    `link_audiomack` varchar(200) NOT NULL,
    `link_applemusic` varchar(200) NOT NULL,
    `link_deezer` varchar(200) NOT NULL,
    `link_itunes` varchar(200) NOT NULL,
    `link_youtubemusic` varchar(200) NOT NULL,
    `link_amazonmusic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------------------------------------------------------------------------------------------

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
    ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
    ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `social_media_links`
--
ALTER TABLE `social_media_links`
    ADD PRIMARY KEY (`sml_id`),
    ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `musiq`
--
ALTER TABLE `musiq`
    ADD PRIMARY KEY (`musiq_id`),
    ADD KEY `artist_id` (`artist_id`);

--
-- Indexes for table `musiq_links`
--
ALTER TABLE `musiq_links`
    ADD PRIMARY KEY (`link_id`),
    ADD KEY `musiq_id` (`musiq_id`);

--
-- Indexes for table `musiq_count`
--
ALTER TABLE `musiq_count`
    ADD PRIMARY KEY (`musiq_count_id`),
    ADD KEY `musiq_id` (`musiq_id`),
    ADD KEY `user_id` (`user_id`);   

-- ----------------------------------------------------------------------------------------------------------------

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
    MODIFY `admin_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
    MODIFY `artist_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;    

--
-- AUTO_INCREMENT for table `musiq`
--
ALTER TABLE `musiq`
    MODIFY `musiq_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `social_media_links`
--
ALTER TABLE `social_media_links`
    MODIFY `sml_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `musiq_links`
--
ALTER TABLE `musiq_links`
    MODIFY `link_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `musiq_count`
--
ALTER TABLE `musiq_count`
    MODIFY `musiq_count_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

-- ----------------------------------------------------------------------------------------------------------------

--
-- Constraints for table `social_media_links`
--
ALTER TABLE `social_media_links`
    ADD CONSTRAINT `sml_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE;

--
-- Constraints for table `musiq`
--
ALTER TABLE `musiq`
    ADD CONSTRAINT `musiq_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`) ON DELETE CASCADE;

--
-- Constraints for table `musiq_links`
--
ALTER TABLE `musiq_links`
    ADD CONSTRAINT `link_ibfk_1` FOREIGN KEY (`musiq_id`) REFERENCES `musiq` (`musiq_id`) ON DELETE CASCADE;

--
-- Constraints for table `musiq_count`
--
ALTER TABLE `musiq_count`
    ADD CONSTRAINT `musiq_count_ibfk_1` FOREIGN KEY (`musiq_id`) REFERENCES `musiq` (`musiq_id`) ON DELETE CASCADE,
    ADD CONSTRAINT `musiq_count_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
