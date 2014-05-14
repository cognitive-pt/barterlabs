
Barterlabs

You can visit the live production site of barterlabs.com right now at http://www.barterlabs.com

Barterlabs is an open source web application dedicated to building a community around bartering services and goods.

To run a clone of barterlabs on your desktop, follow the isntructions below.

1) First you must setup a development environment. I recommend XAMPP because that's what I use, and it seems
to work just fine. XAMPP will install a development environment, PHP and MySQL, which are all necessary to
clone Barterlbs.

2) Now that XAMPP is installed, copy the barterlabs code to your htdocs directory. It should look something like this:
c:\xampp\htdocs\barterlabs\

3) You will need to setup a barterlabs database. Run PHPmyAdmin (from inside XAMPP or your browser) to access MySQL. Create a database called "barterlabs" (no quotes). Now import the barterlabs database schema located in /barterlabs/docs/barterlabs.sql
You should now have a full Barterlabs database schema. 

4) Open /barterlabs/app/config/database.php and enter your username/password/databse names into the proper fields. This will tell CakePHP how to access your localhost database.

5) Open your web browser and point towards localhost/barterlabs

That should be everything. Since Barterlabs is built on top of CakePHP, you may see some errors. Follow the directions that Cake gives you to finish customizing the code to your localhost.

Hack away, and thanks for being a part of the barterlabs community!

Barterlabs.com - CakePHP Source Code

