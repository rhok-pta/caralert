CREATE TABLE  IncidentTbl
(
    IncID integer Unsigned Auto_Increment primary key,
    UserId integer unsigned,
    CarRegNo  varchar(10),    
    CarColor varchar(30),
    CarMakeModel varchar(30),
    IncDesc varchar(100),
    IncDate dateTime,
    FOREIGN KEY (UserID) REFERENCES UserTbl (UserId) ON UPDATE CASCADE
)


CREATE TABLE  UserGroupTbl
(
    UserID  integer unsigned,    
    GroupID integer unsigned,
    FOREIGN KEY (UserId) REFERENCES UserTbl (UserId) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (GroupId) REFERENCES GroupTbl (GroupId) ON UPDATE CASCADE ON DELETE CASCADE
)

CREATE TABLE  UserTbl
(
    UserID  integer Unsigned Auto_Increment primary key,
    UserName Varchar(20),
    PassWord Varchar(10),
    FirstName Varchar(25),
    Surname Varchar(25),
    CellNumber Varchar(10),   
    Role varchar(20)
)

CREATE TABLE  GroupTbl
(
    UserID  integer primary key,    
    Area varchar(30),
    Description varchar(100)
)