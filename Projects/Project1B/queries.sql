USE CS143;

/*the names of all the actors in the movie 'Die Another Day'.*/
SELECT CONCAT(a.first, ' ', a.last) Actors
FROM Actor a
JOIN MovieActor ma ON a.id = ma.aid
JOIN Movie m ON ma.mid = m.id
WHERE m.title = 'Die Another Day';

/*the count of all the actors who acted in multiple movies. which is more than one.*/
SELECT COUNT(*)
FROM (
	SELECT a.id
	FROM Actor a
	JOIN MovieActor ma ON a.id = ma.aid
	GROUP BY a.id
	HAVING COUNT(ma.aid) > 1
) a;

/*Find the full name of the actor who died in the same year as the movie was made in 2000,
as well as the corresponding name and year of the movie in descending movie year order. */
SELECT CONCAT(A.first, ' ', A.last) Actors, A.dod, M.title, M.year
FROM Actor A
  JOIN MovieActor MA
    ON A.id = MA.aid
  JOIN Movie M
    ON MA.mid = M.id
WHERE A.dod IS NOT NULL AND year(A.dod) = M.year AND year=2000
ORDER BY M.year DESC;