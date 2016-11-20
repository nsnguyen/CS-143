-- Set foreign key checks off to drop all existing tables since some tables have foreign keys.
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS Movie;
/*This table describes information regarding movies in the database.*/
CREATE TABLE Movie(id INT NOT NULL -- Movie Id
                  ,title VARCHAR(100) NOT NULL-- Movie title
                  ,year INT -- release year
                  ,rating VARCHAR(10) -- MPAA rating
                  ,company varchar(50) -- Production company
                  ,PRIMARY KEY(id)
                  ,CHECK(id > 0 OR Movie.year > 0 OR id <=MaxMovieID.id)) ENGINE = INNODB;
#id has to be greater than 0 but under MaxMovie Id as defined below. Year has to be positive.

DROP TABLE IF EXISTS Actor;
/*This table describes information regarding actors and actresses of movies.*/
CREATE TABLE Actor(id INT NOT NULL -- Actor ID
                    ,last VARCHAR(20) -- last name
                    ,first VARCHAR(20) -- first name
                    ,sex VARCHAR(6) -- sex of the actor
                    ,dob DATE  NOT NULL -- date of birth
                    ,dod DATE DEFAULT  NULL-- date of death
                    ,PRIMARY KEY(id)
                    ,CHECK(id > 0 OR id <= MaxPersonID.id)) ENGINE = INNODB;
#id has to be greater than 0 but less than max allowable person ID. date of brith must not be null, but date of death can (not dead yet).

DROP TABLE IF EXISTS Director;
/*This table describes information regarding directors of movies.*/
CREATE TABLE Director(id INT NOT NULL-- Director Id
                      ,last VARCHAR(20) -- last name
                      ,first VARCHAR(20) -- first name
                      ,dob DATE NOT NULL -- date of birth
                      ,dod DATE DEFAULT  NULL-- date of death
                      ,PRIMARY KEY(id)
                      ,CHECK(id > 0 OR id <= MaxPersonID.id)) ENGINE = INNODB;
#id has to be greater than 0 but less than max allowable Id. dob must not be null but dod can be null.

DROP TABLE IF EXISTS MovieGenre;
/*This table describes information regarding the genre of movies.*/
CREATE TABLE MovieGenre(mid INT -- Movie Id
                        ,genre VARCHAR(20) -- Movie Genre
                        ,FOREIGN KEY(mid) REFERENCES Movie(id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE) ENGINE = INNODB;
#Movie Genre reference Movie Table.

DROP TABLE IF EXISTS MovieDirector;
/*This table describes the information regarding the movie and the director of that movie.*/
CREATE TABLE MovieDirector(mid INT -- movie Id
                            ,did INT -- director Id
                            ,FOREIGN KEY(mid) REFERENCES Movie(id)
                            ,FOREIGN KEY(did) REFERENCES Director(id)
                            ON DELETE CASCADE
                            ON UPDATE CASCADE) ENGINE = INNODB;
#Movie Director table references Movie and Director tables.

DROP TABLE IF EXISTS MovieActor;
/*This table describes information regarding the movie and the actor/atress of that movie.*/
CREATE TABLE MovieActor(mid INT -- movie Id
                        ,aid INT -- Director
                        ,role varchar(50) -- actor role in movie
                        ,FOREIGN KEY(mid) REFERENCES Movie(id)
                        ,FOREIGN KEY(aid) REFERENCES Actor(id)
                        ON DELETE CASCADE
                        ON UPDATE CASCADE) ENGINE = INNODB;
#Movie Actor table references Movie and Actor table.

DROP TABLE IF EXISTS Review;
/*Reviews of a movie.*/
CREATE TABLE Review(name varchar(20) NOT NULL-- Reviewer name
                    ,time TIMESTAMP NOT NULL-- Review time
                    ,mid INT -- movie Id
                    ,rating INT NOT NULL-- review rating
                    ,comment varchar(500) -- reviewer comment
                    ,FOREIGN KEY(mid) REFERENCES Movie(id)
                    ON DELETE CASCADE
                    ON UPDATE CASCADE
                    ,CHECK(rating >= 0 OR rating <=5)) ENGINE = INNODB;
#rating must be 0 to 5.

DROP TABLE IF EXISTS MaxPersonID;
/*max person Id which will be used to assign new person Id.*/
CREATE TABLE MaxPersonID(id INT -- max Id assigned to all persons
                          ) ENGINE = INNODB;

DROP TABLE IF EXISTS MaxMovieID;
/*max movide id which will be used to assign new movie id.*/
CREATE TABLE MaxMovieID(id INT -- max Id assigned to all movies
                          ) ENGINE = INNODB;

SET FOREIGN_KEY_CHECKS = 1;