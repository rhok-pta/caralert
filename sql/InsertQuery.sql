USE caralert;

-- Insert Values Into Table UserTbl
INSERT into UserTbl (UserName,PassWord,FirstName,Surname,CellNumber,Role)
            Values("Mandla","123456","Mandla","Marole","0823456789","User"),
                  ("Boitu","123654","Boitumelo","Matsabe","0843459519","User"),
                  ("Skumbzo","175416","Sikhumbuzo","Mpila","0712456789","User"),
                  ("BAkinpelu","745856","Biyi","Akinpelu","0795556789","User"),
                  ("Trevr","987462","Trevor","Khambani","0218846789","User");    
            
-- Insert Values Into Table GroupTbl
INSERT into GroupTbl (Area,Description)
            Values("Pretoria","Sunnyside"),
                  ("Johannesburg","HillBrow"),
                  ("Polokwane","Savanna"),
                  ("Cape Town","Bellville"),
                  ("Pretoria","Acardia");
                  
-- Insert Values Into Table UserGroupTbl
insert into UserGroupTbl (UserID,GroupID)
            values(1,1),
                  (1,2),
                  (2,1),
                  (2,2),
                  (3,1);

-- Insert Values Into Table Incident
insert into IncidentTbl (UserID,CarRegNo,CarColor,CarMakeModel,IncDesc,IncDate,GroupID)
            values(1,"BBD715GP","Silver Gray","BMW 1 Series","Hit And Run",now(),1),
                  (1,"BF71KKGP","Red","VW Golf 6","Speeding",now(),2),
                  (2,"YPY015GP","Black","VW Scirroco","Hit And Run",now(),4),
                  (5,"XXY777EC","Orange","Ford Focus ST","Past Red Robot ",now(),5),
                  (4,"PG25KLWC","Blue","Benz AMG 365","Speeding",now(),3);
