Name: Nguyen Si Nguyen
ID: 004870721
Email: nsnguyen@g.ucla.edu

I am not working with anyone at the moment. This php Query is built using JetBrains in mac OSX.


Project 1B
----------------------------------------
Primary Key constraints: 
	Movie Id 
	Actor Id 
	Director Id

Referential integrity constraints: 
	MovieGenre mid has foreign key referencing Movie id
	MovieDirector mid has foreign key referencing Movie id, and did has foreign key referencing Director id
	MovieActor mid has foreign key referencing Movie id, and aid has foreign key referencing Actor id
	Review mid has foreign key referencing Movie id

Check constraints:
	Movie id cannot be negative and less or equal to max allowable movie id.
	Actor id cannot be negative and less or equal to max allowable actor Id.
	Director id cannot be negative and less or equal to max allowable director Id.	
	Review rating must be within 0 and 5.


Actual constrain checks:
	mysql> source violate.sql
	ERROR 1062(23000): Duplicate entry '2' for key 'PRIMARY'
	ERROR 1048(23000): Column 'dob' cannot be null
	ERROR 1062(23000): Duplicate entry '2' for key 'PRIMARY'
	ERROR 1062(23000): Duplicate entry '2' for key 'PRIMARY'
	ERROR 1048(23000): Column 'dob' cannot be null
	ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails
	ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails
	ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails
	ERROR 1452 (23000): Cannot add or update a child row: a foreign key constraint fails