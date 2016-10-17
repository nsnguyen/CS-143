/*Constraint: set Movie id to primary key (no duplicate allowed) */
#INSERT INTO Movie Values(2,'Test',2013,'R','Cool');
#ERROR 1062(23000): Duplicate entry '2' for key 'PRIMARY'

#INSERT INTO Actor Values(1,'test_first','test_last','male', null,null);
#ERROR 1048(23000): Column 'dob' cannot be null

#INSERT INTO Actor Values(1,'test_first','test_last','male', '1997-01-01',null);
#ERROR 1062(23000): Duplicate entry '2' for key 'PRIMARY'

#INSERT INTO Director Values(1,'test_first','test_last', '1997-01-01',null);
#ERROR 1062(23000): Duplicate entry '2' for key 'PRIMARY'

#INSERT INTO Director Values(1,'test_first','test_last', '1997-01-01',null);
#ERROR 1048(23000): Column 'dob' cannot be null

#INSERT INTO MovieGenre Values(5123,'Funny');
#ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails

#DELETE FROM MovieGenre WHERE mid = 4;
# NO ERROR

#INSERT INTO MovieDirector Values(123,123);
#ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails

#DELETE FROM MovieDirector WHERE mid = 3;
# NO ERROR

#INSERT INTO MovieActor Values(123,123,'funny role');
#ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails

#DELETE FROM MovieActor WHERE mid = 100;
#NO ERROR

#INSERT INTO Review Values('some_name','2016-01-01',123,5,'test comment');
#ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails
