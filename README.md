5E-Spell-Searcher
=================

A little PHP website app thing that can organzie/find spells of the Fifth Edition variety.  Does not include the spells, partially for legal reasons,
but mostly because they aren't all transcribed yet.
Runs in a WinAMP style setup, doubtlessly runs in vanilla LAMP servers too.  Has been tested primarily with PHP 5.6.3.

##Setup
You will need to make sure the connection details are correct in connect_database.php before you get your server all up.

Spell-Searcher requires Bootstrap to run.  Just Extract the file from http://getbootstrap.com/getting-started/ , (the one that is pre-compiled), and name the extracted folder bootstrap,
you will be good to go.

If you are reading this, Spell-Searcher requires AngularJS to run as well. It is already included.  Please go to https://angularjs.org/ for downloads, licensing, etc.  

You will need to manually create the Database and user on your database, if you don't want to change values you are free to use the setup script in the dev folder.
Once that is done, just direct a browser to create_database.php.
