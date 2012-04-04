# Web Programming Assignment B1
**Student Number:** 10008548

## Availability
The working application is available at a total of two URLs:
- http://www.cems.uwe.ac.uk/~b2-argo/wp/assignment/
- http://projects.benargo.com/organica/

There is a full reposity of all the code including all the code history on Github. This is available at the following URL:
- https://github.com/benargo/Organica/

A copy of this report is available at:
- http://www.cems.uwe.ac.uk/~b2-argo/wp/assignment/documentation/report.html

A copy of my ER model is available at:
http://www.cems.uwe.ac.uk/~b2-argo/wp/assignment/documentation/er_model.png

A copy of references used is available at:
http://www.cems.uwe.ac.uk/~b2-argo/wp/assignment/documentation/REFERENCES

All URLs are **case sensitive**, this being a UNIX system after all.

## Directory Structure
I took much of my directory structure from the original framework, however I remodified it to give more semantic names.

### Documentation
**URI:** /documentation/
This became the base directory for holding all of work that does not form the working components of the project. Elements such as SQL dumps, references and a copy of my final report were placed in here.

### Images
**URI:** /images/
This held all of the images used by the CSS to form the styles, and the product images. It contained a subfolder called **thumbs** which contained optimised thumbnail images of each product to display on a smaller scale. Should this project be extended, and a back-end management system be introduced, new product images would be uploaded and placed in this directory.

### Includes
**URI:** /includes/
The includes directory contains a total of four files, all of which have the .inc extension. Three of the files form the basic HTML structure for each page, namely forming the header, footer and sidebar. The final file includes the MySQLi connection details. Because some PHP is executed within each page, my **.htaccess** file tells Apache to run .inc files as if they were PHP.

### Modules
**URI:** /modules/
The modules directory forms the hardcore workings of the app. It includes our configuration file (named "config.inc.php") and a series of object oriented classes encapsulated within seperate files so that they can be called only when neccessary, thus reducing processing times for each page.

### Pages
**URI:** /pages/
This directory handles the various different views, and each page is named in the format <pre>([a-z]+)\.page\.php</pre>. Most of them correspond to what is displayed in the "p" variable under the GET superglobal, with the exception to "main.page.php" which handles the home page.

### Styles
**URI:** /styles/
This final directory contains a total of two files, the first being called "beady.less" is a pre-compiled version of the stylesheet using the pre-processing language LESS. Since the HTML and CSS structure for much of this assignment has been taken from my previous Web Design Principles assignment, it is in fact a direct port of this document. The compiled version of this LESS stylesheet is entitled "beady.css" and this is the version which the compiled application looks for.

## User-Friendly URLs
For the purpose of this application, I have made extensive usage of Apache's configuration file, .htaccess. This file enables me to write user-friendly URLs, which hide the true file name from view. To an outsider, they would not see that everything is being routed through index.php with the page in the querystring, instead the querystring becomes the name of the page.

## Reusability
The system has been designed so that it can be applied to all of the given domains of the assignment brief. This was well demonstrated by the fact that this project started out using the art and craft supplier, although it was later switched to the organic fruit and vegetable store once it became obvious that it was a struggle inventing products for the arts and craft specialist. 

The original ER model was carefully designed so that the categories and products could be easily switched based on the domain being used. This is particuarly demonstrated well within the primary navgiation of the website, where it loops through each of the categories printing out a link to them along with their current name.

With regards to the basket system and authentication system, it has been designed to be as generic as possible, and to plug in to as many different domains as possible. This is clear in my entity relationship diagram, where it links the products to the basket through a "basket items" table, which includes the ID number of the basket, and the ID number of the product, combined with the quantity.

## Problems Encountered
Throughout the course of the project I encountered numerous issues. The majority of them being down to errors in code such as missing semi-colons, missing braces, e.t.c. However, I did have some on a larger scale.

### Session Corruptions
The biggest problem by far was encountered in the UWE environment. After considerable testing on my own machine and on my own server (named RS1), a working version of the application had been completed. When I deployed it to the UWE environment, I encountered an error that I could not get rid of. The issue involves my basket and PHP sessions. When a basket is initialised for the first time, it creates a basket row in the database, and sets the newly generated ID to a PHP session. However, on subsequent references to the basket, where it looks for the session and creates an instance of the object based on the given ID, the session is becomming corrupted and is unable to instanciate the basket properly. 

I examined the code nearly one hundered times, and a history of all the methods I took to fix the issue is documented in my git commit history. In the end, I was unable to resolve this issue, and have deployed a final copy of my application on my own private server (of which there is a link to above) which does work correctly. I would have loved to resolve this issue, but considering there was no problem with my code, it proved exceedingly difficult to solve an issue that did not exist.

### MySQL Issues
Given that my final working copy is not running on the UWE servers, and that my external server could not access UWE's database off campus, I have resorted to using my own MySQL server. There is an instance of the MySQL model located on UWE's MySQL server for reference. However, if you wish to see a populated version of the database (completed with baskets, orders, customers and basket items), you can check this out using the details given below:
**phpMyAdmin:** http://rs1.benargo.net/phpmyadmin/
**Username:** organica
**Password:** ZNgnGyu364r7xZo32FmAj$

### Entity Relationships
I am well aware that my entity relationship model is bordering on the verge of a logical model over a conceptional model. However, I was unable to make it any higher level due to the fact that my link tables have some other function within them. For example, my **basket_items** table contains a field called "quantity" in addition to the two foreign keys. This means that in order to display this representation I could not include a true many-to-many relationship, and instead had to display the lower-level alternative.