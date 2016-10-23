USE CS143;

/*Constraint: set Movie id to primary key (no duplicate allowed) */
INSERT INTO Movie Values(2,'Test',2013,'R','Cool');
#ERROR 1062(23000): Duplicate entry '2' for key 'PRIMARY'
#Note: Because Primary Key can only be unique, it cannot have a second key with the same number. Therefore, since '2' has already
#existed it will reject a second entry '2'

INSERT INTO Movie Values(-123,'TestMovie',2016,'R','CoolCompany');
#MySQL does not support CHECK but this insert would reject since id is less than 0.

INSERT INTO Movie Values(99999,'TestMovie',2016,'R','CoolCompany');
#MySQL does not support CHECK but this insert would reject since id is greater than MaxMovieId which is 4750

INSERT INTO Actor Values(1,'test_first','test_last','male', null,null);
#ERROR 1048(23000): Column 'dob' cannot be null
#Note: dob attribute is set to not be null. Therefore, null dob insertion cannot be executed.

INSERT INTO Actor Values(1,'test_first','test_last','male', '1997-01-01',null);
#ERROR 1062(23000): Duplicate entry '2' for key 'PRIMARY'
#Note: Primary key can only have and only one. Inserting duplicate entry will not be executed.

INSERT INTO Actor Values(-123,'test_first','test_last','female','1995-01-01', null);
#MySQL does not support CHECK but this insert would reject because id is less than 0.

INSERT INTO Actor Values(99999,'test_first','test_last','female','1995-01-01', null);
#MySQL does not support CHECK but this insert would reject because id is greater than 69000

INSERT INTO Director Values(1,'test_first','test_last', '1997-01-01',null);
#ERROR 1062(23000): Duplicate entry '2' for key 'PRIMARY'
#Note: Primary key can only have and only one. Inserting duplicate entry will not be executed.

INSERT INTO Director Values(1,'test_first','test_last', '1997-01-01',null);
#ERROR 1048(23000): Column 'dob' cannot be null
#Note: dob attribute is set to not be null. Therefore, null dob insertion cannot be executed.

INSERT INTO Director Values(-123,'test_first','test_last','female','1995-01-01', null);
#MySQL does not support CHECK but this insert would reject because id is less than 0.

INSERT INTO Director Values(99999,'test_first','test_last','female','1995-01-01', null);
#MySQL does not support CHECK but this insert would reject because id is greater than 69000

INSERT INTO MovieGenre Values(5123,'Funny');
#ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails
#Note: Since this relation is referencing from another relation, it cannot execute insertion. However, it can insert to base relation.

DELETE FROM MovieGenre WHERE mid = 4;
# NO ERROR

INSERT INTO MovieDirector Values(123,123);
#ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails
#Note: Since this relation is referencing from another relation, it cannot execute insertion. However, it can insert to base relation.

DELETE FROM MovieDirector WHERE mid = 3;
# NO ERROR

INSERT INTO MovieActor Values(123,123,'funny role');
#ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails
#Note: Since this relation is referencing from another relation, it cannot execute insertion. However, it can insert to base relation.

DELETE FROM MovieActor WHERE mid = 100;
#NO ERROR

INSERT INTO Review Values('some_name','2016-01-01',123,5,'test comment');
#ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails
#Note: Since this relation is referencing from another relation, it cannot execute insertion. However, it can insert to base relation.