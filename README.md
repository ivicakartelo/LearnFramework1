# LearnFramework1
# Summary
###### PHP procedural, Responsive Web design, MySQL

# Architecture

Every human product has a story in front of it. That story is the architecture of that product.

# The Story in front of Framework1

The procedural coding is linear storytelling. The web application is built upon two tables in a MySQL database, the menu, and comments.
The physical, private part of the app is in the admin folder, the public part is in the root folder. There is Home Page index.php in every folder. Almost all code is in that Home Pages.

# The public folder's Home Page

At first the page display all posts and menu. If we choose a menu, page display belonging post, the form for comment behind the post, and approved comments.

# Admin folder

At index.php is CRUD code for table menu. In comments.php is CRUD code for table comments.

# Features in the root folder

###### Connection to database,
###### All posts visible,
###### Post can be HTML document, picture, iFrame
###### All menu visible
###### The most popular posts
###### Rang list of posts by number of views
###### Only one post visible
###### The Form for comment
###### Approved comments visible
###### SQL of database

# Features in the admin folder

###### CRUD for table admin
###### CRUD for table comments

# The solution on the Home Page in the root folder

The navigation is by two kinds of links. One is index.php and the other is index.php?menuid=1. 
All code is under one main IF .... ELSE structure. IF there is no variable in URL, ?menuid=1, page display all posts. Else, the page display one post, the Form for comment, approved comments.
At right column of the page is always menu, the most popular and rang list by the number of views.
Inside main IF ... ELSE structure there is IF ... ELSE for some details, I have explained in the code's comment.

# The solution in the admin folder

All CRUD for table menu is on index.php. All CRUD for table comments is on comments.php except the Form that is on the index.php in root folder behind a post.
CRUD stay for Create, Read, Update and Delete. SQL equivalents are: INSERT, SELECT, UPDATE, DELETE. 

# The Front End 
of the application is Responsive Web Design, Mobile First.

# The Back End
of the application are PHP SQL
