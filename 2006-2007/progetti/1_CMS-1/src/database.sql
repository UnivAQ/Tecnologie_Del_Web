-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Host: 62.149.150.35
-- Generato il: 14 Ott, 2006 at 01:26 PM
-- Versione MySQL: 4.0.27
-- Versione PHP: 4.3.11
-- 
-- Database: `Sql68385_1`
-- 

-- --------------------------------------------------------

-- 
-- Struttura della tabella `commento`
-- 

CREATE TABLE `commento` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `nome` varchar(50) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `testo` text NOT NULL,
  `data_commento` date NOT NULL default '0000-00-00',
  `id_contenuto` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `contenuto`
-- 

CREATE TABLE `contenuto` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `username` varchar(25) NOT NULL default '',
  `titolo` varchar(125) NOT NULL default '',
  `testo` text NOT NULL,
  `ora_creazione` time NOT NULL default '00:00:00',
  `data_creazione` date NOT NULL default '0000-00-00',
  `ora_modifica` time NOT NULL default '00:00:00',
  `data_modifica` date NOT NULL default '0000-00-00',
  `pubblicato` char(1) NOT NULL default '',
  `editortype` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `contenuto_file`
-- 

CREATE TABLE `contenuto_file` (
  `id_contenuto` int(11) NOT NULL default '0',
  `filename` varchar(255) NOT NULL default ''
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `contenuto_sottosezione`
-- 

CREATE TABLE `contenuto_sottosezione` (
  `id_contenuto` int(10) unsigned NOT NULL default '0',
  `id_sottosezione` int(10) unsigned NOT NULL default '0'
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `features`
-- 

CREATE TABLE `features` (
  `id` int(10) unsigned NOT NULL default '0',
  `nomeservizio` varchar(50) NOT NULL default '',
  `descrizione` text NOT NULL,
  `responsabile` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `file`
-- 

CREATE TABLE `file` (
  `username` varchar(25) NOT NULL default '',
  `nome` varchar(255) NOT NULL default '',
  `path` varchar(255) NOT NULL default '',
  `mimetype` varchar(30) NOT NULL default '',
  `size` int(11) NOT NULL default '0',
  `descrizione` text NOT NULL,
  `ora_upload` time NOT NULL default '00:00:00',
  `data_upload` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`nome`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `gruppo`
-- 

CREATE TABLE `gruppo` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nome` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `gruppo_servizio`
-- 

CREATE TABLE `gruppo_servizio` (
  `id_gruppo` int(11) default NULL,
  `id_servizio` int(11) default NULL
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `link`
-- 

CREATE TABLE `link` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(25) NOT NULL default '',
  `url` text NOT NULL,
  `nome` varchar(255) NOT NULL default '',
  `descrizione` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `pm_posts`
-- 

CREATE TABLE `pm_posts` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `content` text NOT NULL,
  `publish_time` time NOT NULL default '00:00:00',
  `publish_date` date NOT NULL default '0000-00-00',
  `category` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `riepilogo`
-- 

CREATE TABLE `riepilogo` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(20) NOT NULL default '',
  `query_string` text NOT NULL,
  `view_script` varchar(100) NOT NULL default '',
  `edit_script` varchar(100) NOT NULL default '',
  `delete_script` varchar(100) NOT NULL default '',
  `keyName` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `servizio`
-- 

CREATE TABLE `servizio` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nome` varchar(30) NOT NULL default '',
  `script` varchar(30) NOT NULL default '',
  `descrizione` text NOT NULL,
  `tableName` varchar(50) NOT NULL default '',
  `keyName` varchar(50) NOT NULL default '',
  `paramName` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `sezione`
-- 

CREATE TABLE `sezione` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nome` varchar(50) NOT NULL default '',
  `descrizione` text NOT NULL,
  `posizione` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `sezione_esterna`
-- 

CREATE TABLE `sezione_esterna` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nome` varchar(255) NOT NULL default '',
  `descrizione` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `sottosezione`
-- 

CREATE TABLE `sottosezione` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `nome` varchar(50) NOT NULL default '',
  `descrizione` text NOT NULL,
  `id_sezione` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `utente`
-- 

CREATE TABLE `utente` (
  `username` varchar(25) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `nome` varchar(50) NOT NULL default '',
  `cognome` varchar(100) NOT NULL default '',
  `data_di_nascita` date NOT NULL default '0000-00-00',
  `via` varchar(255) NOT NULL default '',
  `citta` varchar(100) NOT NULL default '',
  `cap` varchar(5) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `telefono_fisso` varchar(30) NOT NULL default '',
  `telefono_mobile` varchar(30) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`username`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Struttura della tabella `utente_gruppo`
-- 

CREATE TABLE `utente_gruppo` (
  `id_utente` varchar(25) NOT NULL default '0',
  `id_gruppo` int(10) unsigned NOT NULL default '0'
) TYPE=MyISAM;
