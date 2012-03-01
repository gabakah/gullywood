CREATE TABLE `users` (
  `ID` int(11) NOT NULL auto_increment,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `date_registered` int(11) NOT NULL,
  `Temp_pass` varchar(55) default NULL,
  `Temp_pass_active` tinyint(1) NOT NULL default '0',
  `Email` varchar(255) NOT NULL,
  `Active` int(11) NOT NULL default '0',
  `Level_access` int(11) NOT NULL default '2',
  `Random_key` varchar(32) default NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=MyISAM;