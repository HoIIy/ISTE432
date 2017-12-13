# ISTE432
The future is now and we're figuring out where to put gas in it.

# Deployment

INSTRUCTIONS
-------------
The web application is easy to use by accessing the index page. 

Nearby markers appear by default, based on your automatically detected location.

Stations are retrieved in a list; content is displayed under the map.

HOSTING
------------
To host the application, clone the GIT from https://github.com/HoIIy/ISTE432.git using an appropriate tool, such as git bash, or download the zip of the files.

Move files from the "app" folder into the web directory in which they will be accessed.

To connect to your database, edit your database login information into the "db.class.php" file that will be in the "resources" folder. To create the requisite database tables, run the "db.sql" file that will be in the same folder.

SEARCH
-------
You may refine the stations that are retrieved using parameters in the search on the righthand panel.

FAVORITES
------
To view your favorite stations, log in as yourself and click on the "favorites" link that will be next to "login" when a user has logged in.

To add a station as a favorite, click the "+" button next to it where it appears as a search result.

ALSO INSTALL
------
Alternafuel requires a functional postgresql database; if there is not one, it can still retrieve stations, but user accounts will be nonfunctional.
