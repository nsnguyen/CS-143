Nguyen SI Nguyen 004870721
Project 1C

Note: I worked on this project by myself.


----------------------------------------------------------------------------------------------
The project consists of 6 main pages.
	- Home
	- Add Actor/Director
	- Add Movie
	- Add Actor/Movie Relation
	- Add Director/Movie Relation
	- Search (search both movie and actor)


Home Page:
This page is the home page, starting point for test case selenium scripts.

Add Actor/Director:
This page combines insertion of a new Actor and Director. The PersonID is incremented for each insertion.
The page allows inserting First Name, Last name, Gender, Date of Birth, and Date of Death (if available)
The page will make an AJAX request using XmlHttpRequest and it will insert into Actor or Director table depending on the selection.
Also, it will increment the MaxPersonId by 1.
The AJAX response once insertion is complete will be a text display that the insertion has completed successfully.


Add Movie:
This page allows user to add a new movie with Title, Year, Company, MPAA Rating, and Genre (multiple genres are allowed).
Again, this page will make an AJAX request, and get an AJAX text response once it's done.


Add Actor/Movie Relation:
THis page will first display top 50 list of recent actors and movies (order by aid and mid in descending order).
However, if the user wants a specific actor and movie, they can search that in the search input for actor and movie.
The search button will make an AJAX request using mid and aid (because these are keys) which then add to MovieActor table.
User then can add role to the actor associate to the movie by clicking submit button. They are allowed to add multiple actors to a movie.


Add Director/Movie Relation:
This page is similar to Actor/Movie Relation page. It will initially display top 50 directors and top 50 movies (order by did and mid in descending order).
The user can search for specfic director and movie by inputting into the search boxes. 
Then, the user can submit which will add the relation of director to the specific movie in MovieDirector table.

Search:
The search page includes both search Actor handler, and search Movie handler. the search Actor handler will search both first and last name for all permutations.
Also, the search handler will exclude comma, hyphen, single quotation, and period in the name. The reason is that most people search do not add in those characters in the search string.
However, the user is still allowed to use those listed characters.
The search Movie handler will search basing on the title. The search title is implemented will also disregard those characters as listed above.
The implementation of the search title is by rotating the title. For example, if the title is "I love Candy", it will combine all the characters and multiply it by two.
So the search string will be "IloveCandyIloveCandy". This way, the search criteria will not be as rigid and be more flexible.

Conclusion:
All frontend is calling AJAX against an event handler. the event handler than calls a a specific function in DataRequest.php class. The function then does it provided task and return a value.


