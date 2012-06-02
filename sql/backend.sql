DROP DATABASE IF EXISTS caralert;
CREATE DATABASE caralert;
USE caralert;

CREATE TABLE  UserTbl
(
    UserID  integer Unsigned Auto_Increment primary key,
    UserName Varchar(20) NOT NULL,
    PassWord Varchar(10) NOT NULL,
    FirstName Varchar(25),
    Surname Varchar(25),
    CellNumber Varchar(10),
    Role SET('user','moderator','admin') NOT NULL DEFAULT 'user',
    UNIQUE (UserName),
    KEY idx_username (UserName)
);

CREATE TABLE  GroupTbl
(
    GroupID  integer unsigned AUTO_INCREMENT primary key,    
    Area varchar(30) NOT NULL,
    Description varchar(100)
);

CREATE TABLE  UserGroupTbl
(
    UserID  integer unsigned NOT NULL,
    GroupID integer unsigned NOT NULL,
    FOREIGN KEY (UserID) REFERENCES UserTbl (UserID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (GroupID) REFERENCES GroupTbl (GroupID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE  IncidentTbl
(
    IncID integer Unsigned Auto_Increment primary key,
    UserId integer unsigned NOT NULL,
    CarRegNo  varchar(10),
    CarColor varchar(30),
    CarMakeModel varchar(30),
    IncDesc varchar(100),
    IncDate dateTime NOT NULL,
    FOREIGN KEY (UserID) REFERENCES UserTbl (UserID) ON UPDATE CASCADE,
    KEY idx_CarRegNo (CarRegNo)
);
