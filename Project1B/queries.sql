/*Count number of movies per actor has played in descending order.*/
SELECT A.First, A.Last, Count(B.mid) CountMovie
FROM Actor A JOIN MovieActor B
    ON A.id = B.aid
GROUP BY A.id
ORDER BY Count(B.mid) DESC;

/*Find the full name of the actor who is also a director in the movie they play in,
as well as the corresponding name and year of the movie in descending movie year order. */
SELECT A.First, A.Last, A.sex, M.title, M.year
FROM Actor A
  JOIN MovieActor MA
    ON A.id = MA.aid
  JOIN MovieDirector MD
    ON MA.mid = MD.mid
  JOIN Movie M
    on M.id = MA.mid
WHERE MA.aid = MD.did
ORDER BY M.year DESC;

/*Find the full name of the actor who died in the same year as the movie was made,
 as well as the corresponding name and year of the movie in descending movie year order. */
SELECT A.first, A.last, A.dod, M.title, M.year
FROM Actor A
  JOIN MovieActor MA
    ON A.id = MA.aid
  JOIN Movie M
    ON MA.mid = M.id
WHERE A.dod IS NOT NULL AND year(A.dod) = M.year
ORDER BY M.year DESC;