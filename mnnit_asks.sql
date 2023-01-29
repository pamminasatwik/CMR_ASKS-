-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2018 at 09:47 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mnnit_asks`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `sno` bigint(20) NOT NULL,
  `qid` bigint(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `answer` text NOT NULL,
  `upvotes` bigint(20) NOT NULL DEFAULT '0',
  `downvotes` bigint(20) NOT NULL DEFAULT '0',
  `ip` bigint(20) NOT NULL,
  `timestamp` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`sno`, `qid`, `uid`, `answer`, `upvotes`, `downvotes`, `ip`, `timestamp`) VALUES
(2, 39, 3, '&lt;p&gt;Console.log is used to print the value of something on the console.\r\nFor example: &lt;br&gt;&lt;code&gt;console.log(&quot;Rajan&quot;);&lt;/code&gt;&lt;br&gt; will print &lt;strong&gt;Rajan&lt;/strong&gt; on the console.&lt;/p&gt;', 0, 0, 0, 1537978569),
(3, 39, 13, '<p>The use of <br><code>console.log</code><br> is to to print something on the console. It is analogical to <br><code>document.write</code><br> in <strong>JAVASCRIPT.</strong></p>', 0, 0, 0, 1537985047);

-- --------------------------------------------------------

--
-- Table structure for table `answer_downvotes`
--

CREATE TABLE IF NOT EXISTS `answer_downvotes` (
  `sno` bigint(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `aid` bigint(20) NOT NULL,
  `timestamp` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `answer_upvotes`
--

CREATE TABLE IF NOT EXISTS `answer_upvotes` (
  `sno` bigint(20) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `aid` bigint(20) NOT NULL,
  `timestamp` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `qid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `question` text NOT NULL,
  `quesdesc` text NOT NULL,
  `views` bigint(20) NOT NULL DEFAULT '0',
  `upvotes` bigint(20) NOT NULL DEFAULT '0',
  `downvotes` bigint(20) NOT NULL DEFAULT '0',
  `ques_timestamp` text NOT NULL,
  `ques_ip` varchar(13) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qid`, `uid`, `question`, `quesdesc`, `views`, `upvotes`, `downvotes`, `ques_timestamp`, `ques_ip`) VALUES
(1, 3, 'How to change the color of all the paragraphs in html DOM?', '<p>We can do this by using the <strong>p</strong> tag. \nFor example \n<br><code>\np\n{\ncolor: red ;\n}\n</code><br></p>', 0, 0, 0, '0000-00-00 00:00:00', '::1'),
(2, 3, 'How to change the color of all the paragraphs in html DOM?', '<p>We can do this by using the <strong>p</strong> tag. \nFor example \n<br><code>\np\n{\ncolor: red ;\n}\n</code><br></p>', 1, 0, 0, '0000-00-00 00:00:00', '::1'),
(3, 3, 'How to change the color of all the paragraphs in html DOM?', '<p>We can do this by using the <strong>p</strong> tag. \nFor example \n<br><code>\np\n{\ncolor: red ;\n}\n</code><br></p>', 0, 0, 0, '0000-00-00 00:00:00', '::1'),
(4, 3, 'How to change the color of all the paragraphs in html DOM?', '<p>We can do this by using the <strong>p</strong> tag. \nFor example \n<br><code>\np\n{\ncolor: red ;\n}\n</code><br></p>', 0, 0, 0, '0000-00-00 00:00:00', '::1'),
(5, 3, 'How to change the color of all the paragraph element in html DOM?', '<p>We can do this by using the <strong>p</strong> tag. \nFor example \n<br><code>\np\n{\ncolor: red ;\n}\n</code><br></p>', 0, 0, 0, '0000-00-00 00:00:00', '::1'),
(6, 3, 'How to change the color of all the paragraph element in html DOM?', '<p>We can do this by using the <strong>p</strong> tag. \nFor example \n<br><code>\np\n{\ncolor: red ;\n}\n</code><br></p>', 0, 0, 0, '0000-00-00 00:00:00', '::1'),
(8, 3, 'How to change the color of p?', '<p>By using the color element <strong>B</strong></p>', 0, 0, 0, '0000-00-00 00:00:00', '::1'),
(9, 3, 'How to change the color of p?', '<p>By using the color element <strong>B</strong></p>', 0, 0, 0, '0000-00-00 00:00:00', '::1'),
(10, 3, 'How to change the color of p tag?', '<p>By using the p tag <strong>P</strong></p>', 0, 0, 0, '0000-00-00 00:00:00', '::1'),
(11, 3, 'How to change the color of p tag?', '<p>By using the p tag <strong>P</strong></p>', 0, 0, 0, '1537765832', '::1'),
(12, 3, 'How do you send an email?', '<p>We can send an email to anybody using <em>gmail,yahoo etc.</em></p>', 0, 0, 0, '1537765949', '::1'),
(25, 3, 'What is the fastest way to do this?', '<p><strong>By doin g that</strong></p>', 0, 0, 0, '1537769939', '::1'),
(26, 3, 'What is the use of p tag?', '<p><strong>What is the exact use of p tag in html.</strong></p>', 0, 0, 0, '1537805276', '::1'),
(33, 3, 'What is the use of this query?', '<p>The use of this query is to do that.</p>', 0, 0, 0, '1537846814', '::1'),
(34, 3, '', '', 0, 0, 0, '1537846834', '::1'),
(35, 3, 'how are you doing?', '<p><strong>I am doing fine</strong></p>', 0, 0, 0, '1537847020', '::1'),
(36, 3, 'How to do that?', '<p>by doing this</p>', 0, 0, 0, '1537847947', '::1'),
(37, 3, 'What is the use of console.log in javascript?', '<p><strong>Console.log is used to print something in the console window using the javascript language.</strong>\r\n<br><code>\r\nvar x = "Rajan";\r\nconsole.log(x);\r\n</code><br> will give output <strong>Rajan</strong> in console window.</p>', 14, 0, 0, '1537850625', '::1'),
(38, 3, 'What is the console.log in javascript?', '<p>Console.log is used to print something in the console window using the javascript language. \r\nvar x = "Rajan"; console.log(x); \r\nwill give output Rajan in console window.\r\n<br><img src="https://developers.google.com/web/tools/chrome-devtools/console/images/console-write-format-string.png" alt="Console.log" title="console" /><br></p>', 5, 0, 1, '1537850967', '::1'),
(39, 3, 'What is the use of console.log in javascript?', '<p>it is use to print something on console.for example.\n<br><code>console.log("rajan")</code><br> <strong>will print rajan on the console.</strong>\n<br><img src="https://developers.google.com/web/tools/chrome-devtools/console/images/console-write-format-string.png" alt="console" title="console.log" /><br></p>', 238, 0, 0, '1537851168', '::1'),
(40, 3, 'What is the use of email in the world?', '<p><strong>The use of email is the send message to people all over the globe.</strong>\r\n<br><img src="https://servicedesk.dc-uoit.ca/PublishingImages/email.png" alt="Email" title="Email" /><br> </p>', 3, 0, 0, '1537876891', '::1'),
(41, 3, 'What is the fjkasflksj?', '<p><strong>I amfkasdjfalsk</strong> <em>vsafv</em>  <br><code>\r\nconsole.log("Rajan Jha");\r\n</code><br><a href="www.google.com">Google</a>  <a href="user.php?u=iamrajanjha">@iamrajanjha</a></p>', 10, 0, 0, '1537882440', '::1'),
(42, 3, 'How to boot linux?', '<p><strong>Please give me step by step process to dual boot linux.</strong></p>', 20, 2, 0, '1537949842', '::1'),
(43, 14, 'what is linked list?', '', 2, 1, 0, '1537972131', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `questions_followers`
--

CREATE TABLE IF NOT EXISTS `questions_followers` (
  `sno` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `timestamp` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions_followers`
--

INSERT INTO `questions_followers` (`sno`, `qid`, `uid`, `timestamp`) VALUES
(0, 3, 39, 1537866542),
(0, 3, 39, 1537866754),
(0, 3, 39, 1537867041),
(0, 42, 3, 1537977356),
(0, 39, 3, 1537986669),
(0, 1, 3, 1537986671),
(0, 2, 3, 1537986676),
(0, 3, 3, 1537986679),
(0, 4, 3, 1537986683),
(0, 6, 3, 1537986913);

-- --------------------------------------------------------

--
-- Table structure for table `question_downvotes`
--

CREATE TABLE IF NOT EXISTS `question_downvotes` (
  `sno` int(11) NOT NULL,
  `uid` bigint(20) NOT NULL,
  `qid` bigint(20) NOT NULL,
  `timestamp` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_downvotes`
--

INSERT INTO `question_downvotes` (`sno`, `uid`, `qid`, `timestamp`) VALUES
(18, 3, 38, 1537875206);

-- --------------------------------------------------------

--
-- Table structure for table `question_tags`
--

CREATE TABLE IF NOT EXISTS `question_tags` (
  `sno` bigint(20) NOT NULL,
  `qid` bigint(20) NOT NULL,
  `tagid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_tags`
--

INSERT INTO `question_tags` (`sno`, `qid`, `tagid`) VALUES
(0, 42, 15),
(0, 42, 32),
(0, 43, 0);

-- --------------------------------------------------------

--
-- Table structure for table `question_upvotes`
--

CREATE TABLE IF NOT EXISTS `question_upvotes` (
  `sno` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_upvotes`
--

INSERT INTO `question_upvotes` (`sno`, `uid`, `qid`, `timestamp`) VALUES
(0, 3, 42, 1537965779),
(0, 13, 42, 1537966325),
(0, 14, 43, 1537972148);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tagid` bigint(20) NOT NULL,
  `tag` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tagid`, `tag`) VALUES
(1, 'html'),
(2, 'css'),
(3, 'javascript'),
(4, 'java'),
(5, 'c++'),
(6, 'c'),
(7, 'machinelearning'),
(8, 'bigdata'),
(9, 'python'),
(10, 'sql'),
(11, 'DBMS'),
(12, 'jquery'),
(13, 'PHP'),
(14, 'c#'),
(15, 'linux'),
(16, 'windows'),
(17, 'algorithm'),
(18, 'stack'),
(19, 'queue'),
(20, 'tree'),
(21, 'graph'),
(22, 'linkedlist'),
(23, 'array'),
(24, 'binarysearch'),
(25, 'sorting'),
(26, 'searching'),
(27, 'dynamicprogramming'),
(28, 'numbertheory'),
(29, 'DFS'),
(30, 'BFS'),
(31, 'hashing'),
(32, 'shell');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `year` int(11) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `contact` int(11) NOT NULL,
  `last_ipaddress` varchar(13) NOT NULL,
  `last_login` text NOT NULL,
  `date_of_creation` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

-- INSERT INTO `users` (`uid`, `name`, `username`, `email`, `password`, `year`, `branch`, `contact`, `hostel`, `last_ipaddress`, `last_login`, `date_of_creation`) VALUES
-- (1, 'Rajan Jha', 'iamrajanjha', 'jharajan20@gmail.com', 'rajanjha', 2, 'CSE', 2147483647, 'Tagore', '172.31.102.29', '0000-00-00 00:00:00', '0000-00-00'),
-- (2, 'Rahul', 'iamrahuljha', 'jharahul@gmail.com', '4d42c17a023126492eee9144b319eaab', 2, 'CHEM', 2147483647, 'Tagore', '::1', '0000-00-00 00:00:00', '2018-09-18'),
-- (3, 'Rituparnu Biswas', 'roopbiswas', 'rituparnu@gmail.com', '2cb5ede4f623e0fadcaa9c1a989d3b03', 2, 'CSE', 2147483647, 'Tilak', '::1', '0000-00-00 00:00:00', '2018-09-19'),
-- (4, 'Amrit Joshi', 'roopbiswas', 'amrit5joshi@gmail.com', 'afae8afefe06c93511867f99abfeda22', 2, 'CSE', 2147483647, 'Tagore', '::1', '0000-00-00 00:00:00', '2018-09-19'),
-- (5, 'Amrit Joshi', 'roopbiswas1', 'amrit5joshi@gmail.com', 'afae8afefe06c93511867f99abfeda22', 2, 'CSE', 2147483647, 'Tagore', '::1', '0000-00-00 00:00:00', '2018-09-19'),
-- (6, 'Ravi Sable', 'ravisable', 'ravisable@gmail.com', 'afae8afefe06c93511867f99abfeda22', 2, 'CSE', 2147483647, 'Tilak', '::1', '0000-00-00 00:00:00', '2018-09-19'),
-- (7, 'Ravi Sable', 'ravisable', 'ravisable@gmail.com', 'afae8afefe06c93511867f99abfeda22', 2, 'CSE', 2147483647, 'Tilak', '::1', '1537306829', '2018-09-19'),
-- (8, 'Rajan Jha', 'iamrajanjha', 'jharajan20@gmail.com', '40ee92b7bfc638b643954c2c13e021f8', 2, 'CSE', 2147483647, 'Tagore', '::1', '1537306918', '2018-09-19'),
-- (9, 'Anil Kumar', 'anilkumar', 'anilkumar@gmail.com', '57b58322d9f80471e158b73a3cbec337', 2, 'EE', 2147483647, 'Tagore', '::1', '1537309370', '2018-09-19'),
-- (10, 'Rajan Jha', 'thejanakpurwala', 'rajanjha@gmail.com', '40ee92b7bfc638b643954c2c13e021f8', 2, 'CSE', 2147483647, 'Tagore', '::1', '1537527228', '2018-09-21'),
-- (11, 'Rajan Jha', 'thejanakpurwala', 'rajanjha@gmail.com', '40ee92b7bfc638b643954c2c13e021f8', 2, 'CSE', 2147483647, 'Tagore', '::1', '1537527237', '2018-09-21'),
-- (12, 'Aakash Gupta', 'aakashgupta', 'aakashgupta@gmail.com', '17e2af7c71ebbaf8993d4381c8f8ebb8', 1, 'CSE', 2147483647, 'Tagore', '::1', '1537527336', '2018-09-21'),
-- (13, 'Rajan Jha', 'rajanjha22', 'iamrajanjha@gmail.com', '40ee92b7bfc638b643954c2c13e021f8', 2, 'CSE', 2147483647, 'Tagore', '::1', '1537965720', '2018-09-26'),
-- (14, 'ayush srivastava', 'ayush205', 'ayushsrivastava5835@gmail.com', 'f92a2ac26bd5ff8f5e12d97fda84495d', 2, 'EE', 2147483647, 'Tagore', '::1', '1537971945', '2018-09-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `answer_downvotes`
--
ALTER TABLE `answer_downvotes`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `answer_upvotes`
--
ALTER TABLE `answer_upvotes`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`qid`);

--
-- Indexes for table `question_downvotes`
--
ALTER TABLE `question_downvotes`
  ADD PRIMARY KEY (`sno`);

--
-- Indexes for table `question_tags`
--
ALTER TABLE `question_tags`
  ADD KEY `tagid` (`tagid`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tagid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `sno` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `answer_downvotes`
--
ALTER TABLE `answer_downvotes`
  MODIFY `sno` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `answer_upvotes`
--
ALTER TABLE `answer_upvotes`
  MODIFY `sno` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `question_downvotes`
--
ALTER TABLE `question_downvotes`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tagid` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
