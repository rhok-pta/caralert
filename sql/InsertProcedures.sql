-- Drop the User Procedure if exist then create it;
DROP PROCEDURE IF EXISTS User_Insert_byPK;

CREATE PROCEDURE User_Insert_byPK(
                 IN uName varchar(20),
                 IN pWord varchar(10),
                 IN fName varchar(25),
                 IN sName varchar(25), 
                 IN cellNo varchar(10))

INSERT INTO UserTbl (UserName,PassWord,FirstName,Surname,CellNumber)
            VALUES (uName, pWord, fName, sName, cellNo);


CALL User_Insert_byPK("John",12999987,"Davis","John","084194143");


-- Drop the Group Procedure if exist then create it;
DROP PROCEDURE IF EXISTS Group_Insert_byPK;

CREATE PROCEDURE Group_Insert_byPK(
                 IN GrpArea Varchar(30),
                 IN GrpDesc Varchar(100))
                
INSERT INTO GroupTbl(Area, Description)
            VALUES(GrpArea,GrpDesc);
            
            
CALL Group_Insert_byPK("Pretoria","Mamelodi");    







-- Drop the Group Procedure if exist then create it;
DROP PROCEDURE IF EXISTS Incident_Insert_byPK;

CREATE PROCEDURE Incident_Insert_byPK(
                 IN I_UserID integer,
                 IN RegNum Varchar(10),
                 IN Color varchar(30),
                 IN MakeModel varchar(30),
                 IN IncDescription varchar(100),
                 IN IncDateTime datetime,
                 IN I_GroupID integer)
                        
                 
INSERT INTO IncidentTbl(UserId, CarRegNo, CarColor, CarMakeModel, IncDesc,IncDate,GroupID)
            VALUES(I_UserID, RegNum, Color, MakeModel, IncDescription,IncDateTime, I_GroupID);
                 
                 
CALL  Incident_Insert_byPK(5,"PL15GGL","Blue","Toyota Corolla","Hit and Run",now(),1);







            
            

